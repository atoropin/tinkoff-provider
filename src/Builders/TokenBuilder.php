<?php

namespace TinkoffProvider\Builders;

use Illuminate\Contracts\Support\Arrayable;

class TokenBuilder implements Arrayable
{
    protected string $terminalKey;

    protected ?int $amount = null;

    protected ?string $orderId = null;

    protected ?string $payType = null;

    protected ?int $paymentId = null;

    protected ?string $notificationUrl = null;

    protected ?string $successUrl = null;

    protected ?string $failUrl = null;

    protected string $password;

    public function setTerminalKey(string $terminalKey): object
    {
        $this->terminalKey = $terminalKey;

        return $this;
    }

    public function setAmount(?int $amount): object
    {
        $this->amount = $amount;

        return $this;
    }

    public function setOrderId(?string $orderId): object
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function setPayType(?string $payType): object
    {
        $this->payType = $payType;

        return $this;
    }

    public function setPaymentId(?int $paymentId): object
    {
        $this->paymentId = $paymentId;

        return $this;
    }

    public function setNotificationUrl(?string $notificationUrl): object
    {
        $this->notificationUrl = $notificationUrl;

        return $this;
    }

    public function setSuccessUrl(?string $successUrl): object
    {
        $this->successUrl = $successUrl;

        return $this;
    }

    public function setFailUrl(?string $failUrl): object
    {
        $this->failUrl = $failUrl;

        return $this;
    }

    public function setPassword(string $password): object
    {
        $this->password = $password;

        return $this;
    }

    public function getTerminalKey(): string
    {
        return $this->terminalKey;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function getPayType(): ?string
    {
        return $this->payType;
    }

    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    public function getNotificationUrl(): ?string
    {
        return $this->notificationUrl;
    }

    public function getSuccessUrl(): ?string
    {
        return $this->successUrl;
    }

    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [
            'TerminalKey'     => $this->getTerminalKey(),
            'Amount'          => $this->getAmount(),
            'OrderId'         => $this->getOrderId(),
            'PayType'         => $this->getPayType(),
            'PaymentId'       => $this->getPaymentId(),
            'NotificationURL' => $this->getNotificationUrl(),
            'SuccessURL'      => $this->getSuccessUrl(),
            'FailURL'         => $this->getFailUrl(),
            'Password'        => $this->getPassword()
        ];
    }

    /**
     * Create token
     */
    public function create(): string
    {
        $array = $this->toArray();

        ksort($array);

        $string = join('', array_map(function ($item) {
            return $item;
        }, $array));

        return hash('sha256', $string);
    }
}
