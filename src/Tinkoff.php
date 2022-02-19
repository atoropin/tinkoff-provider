<?php

namespace TinkoffProvider;

use TinkoffProvider\Builders\CancelBuilder;
use TinkoffProvider\Builders\ConfirmBuilder;
use TinkoffProvider\Builders\PaymentBuilder;
use TinkoffProvider\Builders\TokenBuilder;
use TinkoffProvider\Builders\TokenVerifier;
use TinkoffProvider\Requests\CancelRequest;
use TinkoffProvider\Requests\ConfirmRequest;
use TinkoffProvider\Requests\PaymentRequest;
use Illuminate\Support\Arr;

class Tinkoff
{
    private string $terminalKey;

    private string $password;

    private string $baseUrl;

    private string $notificationUrl;

    private string $successUrl;

    private string $failUrl;

    public function __construct(
        string $terminalKey,
        string $password,
        string $baseUrl,
        string $notificationUrl,
        string $successUrl,
        string $failUrl
    ) {
        $this->terminalKey     = $terminalKey;
        $this->password        = $password;
        $this->baseUrl         = $baseUrl;
        $this->notificationUrl = $notificationUrl;
        $this->successUrl      = $successUrl;
        $this->failUrl         = $failUrl;
    }

    public function process(PaymentBuilder $payment)
    {
        if (!$payment->getTerminalKey())
            $payment->setTerminalKey($this->terminalKey);
        if (!$payment->getNotificationUrl())
            $payment->setNotificationUrl($this->notificationUrl);
        if (!$payment->getSuccessUrl())
            $payment->setSuccessUrl($this->successUrl);
        if (!$payment->getFailUrl())
            $payment->setFailUrl($this->failUrl);

        return $this->createPayment($payment);
    }

    public function confirm(ConfirmBuilder $confirm)
    {
        $token = (new TokenBuilder())
            ->setTerminalKey($this->terminalKey)
            ->setAmount($confirm->getAmount())
            ->setPaymentId($confirm->getPaymentId())
            ->setPassword($this->password)
            ->create();

        return $this->confirmPayment($confirm->setTerminalKey($this->terminalKey)->setToken($token)->toArray());
    }

    public function cancel(CancelBuilder $cancel)
    {
        $token = (new TokenBuilder())
            ->setTerminalKey($this->terminalKey)
            ->setAmount($cancel->getAmount())
            ->setPaymentId($cancel->getPaymentId())
            ->setPassword($this->password)
            ->create();

        return $this->cancelPayment($cancel->setTerminalKey($this->terminalKey)->setToken($token)->toArray());
    }

    public function verify($requestPayload)
    {
        return $this->verifyNotificationRequest($requestPayload);
    }

    private function createPayment($payment)
    {
        $token = (new TokenBuilder())
            ->setTerminalKey($this->terminalKey)
            ->setAmount($payment->getAmount())
            ->setOrderId($payment->getOrderId())
            ->setPayType($payment->getPayType())
            ->setNotificationUrl($payment->getNotificationUrl())
            ->setSuccessUrl($payment->getSuccessUrl())
            ->setFailUrl($payment->getFailUrl())
            ->setPassword($this->password)
            ->create();

        $paymentParameters = $payment->setToken($token)->toArray();

        return $this->getPaymentResponse($paymentParameters);
    }

    private function getPaymentResponse(array $paymentParameters)
    {
        return (new PaymentRequest($this->baseUrl, $paymentParameters))->send();
    }

    private function confirmPayment(array $confirmParameters)
    {
        return (new ConfirmRequest($this->baseUrl, $confirmParameters))->send();
    }

    private function cancelPayment(array $cancelParameters)
    {
        return (new CancelRequest($this->baseUrl, $cancelParameters))->send();
    }

    /**
     * Verify token from notification/callback request.
     */
    private function verifyNotificationRequest(array $notificationParameters)
    {
        return (new TokenVerifier())
            ->setTerminalKey(Arr::get($notificationParameters, 'TerminalKey'))
            ->setOrderId(Arr::get($notificationParameters, 'OrderId'))
            ->setSuccess(Arr::get($notificationParameters, 'Success'))
            ->setStatus(Arr::get($notificationParameters, 'Status'))
            ->setPaymentId(Arr::get($notificationParameters, 'PaymentId'))
            ->setErrorCode(Arr::get($notificationParameters, 'ErrorCode'))
            ->setAmount(Arr::get($notificationParameters, 'Amount'))
            ->setRebillId(Arr::get($notificationParameters, 'RebillId'))
            ->setCardId(Arr::get($notificationParameters, 'CardId'))
            ->setPan(Arr::get($notificationParameters, 'Pan'))
            ->setExpDate(Arr::get($notificationParameters, 'ExpDate'))
            ->setPassword($this->password)
            ->verify(Arr::get($notificationParameters, 'Token'));
    }
}
