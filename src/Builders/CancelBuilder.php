<?php

namespace TinkoffProvider\Builders;

use Illuminate\Contracts\Support\Arrayable;

class CancelBuilder implements Arrayable
{
    /**
     * Идентификатор терминала, выдается Продавцу Банком
     * 20 символов (чувствительно к регистру)
     */
    protected ?string $terminalKey = null;

    /**
     * Сумма в копейках
     */
    protected ?int $amount = null;

    /**
     * Уникальный идентификатор транзакции в системе Банка
     */
    protected ?int $paymentId = null;

    /**
     * Параметр Shops используется для разбивки платежа по реквизитам.
     * Параметр используется в методах Init, Cancel и Confirm.
     */
    protected array $shops = [];

    /**
     * Подпись запроса
     */
    protected ?string $token = null;

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

    public function setPaymentId(?int $paymentId): object
    {
        $this->paymentId = $paymentId;

        return $this;
    }

    public function setShops(array $shops): object
    {
        $this->shops = $shops;

        return $this;
    }

    public function setToken(?string $token): object
    {
        $this->token = $token;

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

    public function getPaymentId(): ?int
    {
        return $this->paymentId;
    }

    public function getShops(): array
    {
        return $this->shops;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function toArray()
    {
        return [
            'TerminalKey' => $this->getTerminalKey(),
            'Amount'      => $this->getAmount(),
            'PaymentId'   => $this->getPaymentId(),
            'Shops'       => $this->getShops(),
            'Token'       => $this->getToken()
        ];
    }
}
