<?php

namespace TinkoffProvider\Builders;

use Illuminate\Contracts\Support\Arrayable;

class PaymentBuilder implements Arrayable
{
    /**
     * Идентификатор терминала, выдается Продавцу Банком.
     * 20 символов (чувствительно к регистру)
     */
    protected ?string $terminalKey = null;

    /**
     * Сумма в копейках.
     */
    protected ?int $amount = null;

    /**
     * Номер заказа в системе Продавца.
     */
    protected ?string $orderId = null;

    /**
     * Подпись запроса.
     */
    protected ?string $token = null;

    /**
     * Определяет тип проведения платежа – двухстадийная или одностадийная оплата.
     * "О" - одностадийная оплата;
     * "T" - двухстадийная оплата;
     */
    protected ?string $payType = null;

    /**
     * Массив данных чека.
     */
    protected array $receipt;

    /**
     * Краткое описание
     */
    protected ?string $description = null;

    protected array $DATA;

    protected ?string $email = null;

    protected ?string $phone = null;

    /**
     * Параметр Shops используется для разбивки платежа по реквизитам.
     * Параметр используется в методах Init, Cancel и Confirm.
     */
    protected array $shops;

    /**
     * URL на веб-сайте продавца, куда будет отправлен POST запрос о статусе выполнения вызываемых методов (настраивается в Личном кабинете).
     * Если параметр передан – используется его значение.
     * Если нет – значение в настройках терминала.
     */
    protected ?string $notificationUrl = null;

    /**
     * URL на веб-сайте продавца, куда будет переведен покупатель в случае успешной оплаты (настраивается в Личном кабинете).
     * Если параметр передан – используется его значение.
     * Если нет – значение в настройках терминала.
     */
    protected ?string $successUrl = null;

    /**
     * URL на веб-сайте продавца, куда будет переведен покупатель в случае неуспешной оплаты (настраивается в Личном кабинете).
     * Если параметр передан – используется его значение.
     * Если нет – значение в настройках терминала.
     */
    protected ?string $failUrl = null;

    public function setTerminalKey(?string $terminalKey): object
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

    public function setToken(?string $token): object
    {
        $this->token = $token;

        return $this;
    }

    public function setPayType(?string $payType): object
    {
        $this->payType = $payType;

        return $this;
    }

    public function setReceipt(array $receipt): object
    {
        $this->receipt = $receipt;

        return $this;
    }

    public function setDescription(?string $description): object
    {
        $this->description = $description;

        return $this;
    }

    public function setDATA(array $DATA): object
    {
        $this->DATA = $DATA;

        return $this;
    }

    public function setEmail(?string $email): object
    {
        $this->email = $email;

        return $this;
    }

    public function setPhone(?string $phone): object
    {
        $this->phone = $phone;

        return $this;
    }

    public function setShops(array $shops): object
    {
        $this->shops = $shops;

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

    public function getTerminalKey(): ?string
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

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getPayType(): ?string
    {
        return $this->payType;
    }

    public function getReceipt(): array
    {
        return $this->receipt;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDATA(): array
    {
        return $this->DATA;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getShops(): array
    {
        return $this->shops;
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

    public function toArray(): array
    {
        return [
            'TerminalKey'     => $this->getTerminalKey(),
            'Amount'          => $this->getAmount(),
            'OrderId'         => $this->getOrderId(),
            'Token'           => $this->getToken(),
            'PayType'         => $this->getPayType(),
            'Receipt'         => $this->getReceipt(),
            'Shops'           => $this->getShops(),
            'NotificationURL' => $this->getNotificationUrl(),
            'SuccessURL'      => $this->getSuccessUrl(),
            'FailURL'         => $this->getFailUrl()
        ];
    }
}
