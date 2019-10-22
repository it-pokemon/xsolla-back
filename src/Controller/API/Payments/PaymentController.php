<?php
declare(strict_types=1);

namespace App\Controller\API\Payments;

use App\Payments\Model\Payment;
use App\Payments\Service\PaymentServiceInterface;
use App\Payments\Validator\PaymentValidatorInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use PhpParser\Node\Expr\Cast\Object_;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class PaymentController
 * @package App\Controller\API\Payments
 */
class PaymentController extends AbstractController
{
    private $service;
    private $validator;

    public function __construct(PaymentServiceInterface $service, PaymentValidatorInterface $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @Route("api/payments/", methods="GET")
     * @return JsonResponse
     */
    public function all() : JsonResponse
    {
        $payments = $this->service->all();
        return $this->json($payments);
    }

    /**
     * @Route("api/payments/create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request) : JsonResponse
    {
        $data = json_decode($request->getContent(),true);

        $validData = $this->validator->PaymentValidator($data);

        $errors = $validData["errors"];
        if (count($errors) > 0) {
            throw new BadRequestHttpException(json_encode($errors, JSON_UNESCAPED_UNICODE));
        }

        $data = $validData["data"];
        $payment = $this->service->create(
            $data['orderNumber'],
            $data['cost'],
            $data['currency'],
            $data['cardNumber'],
            $data['cardHolder'],
            $data['expireMonth'],
            $data['expireYear'],
            $data['cardCvv']
        );

        return $this->json($payment);
    }

    /**
     * @Route("api/payments/update/{id}", methods="PUT")
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request) : JsonResponse
    {
        $data = json_decode($request->getContent(),true);

        $validData = $this->validator->PaymentValidator($data);

        $errors = $validData["errors"];
        if (count($errors) > 0) {
            throw new BadRequestHttpException(json_encode($errors, JSON_UNESCAPED_UNICODE));
        }

        $data = $validData["data"];

        try{
            $payment = $this->service->one($id);

            if (!is_null($payment)) {
                unset($data['id']);

                foreach ($data as $key => $value) {
                    $payment->{'set' . ucwords($key)}($value);
                }

                $payment = $this->service->update($payment);

                return $this->json($payment);

            } else {
                throw new NotFoundHttpException("Запись с id {$id} не найдена.");
            }
        } catch (Exception $e) {};

    }

    /**
     * @Route("api/payments/delete/{id}", methods={"DELETE"})
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(int $id, Request $request) : JsonResponse
    {
        try{
            $payment = $this->service->one($id);
            if (!is_null($payment)) {
                $this->service->delete($payment);
                return $this->json(["Запись с {$id} успешно удалена."]);
            } else {
                throw new NotFoundHttpException("Запись с id {$id} не найдена.");
            }
        } catch (Exception $e) {}
    }
}