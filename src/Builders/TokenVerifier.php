<?php

namespace TinkoffProvider\Builders;

use Illuminate\Contracts\Support\Arrayable;

class TokenVerifier implements Arrayable
{
    protected ?string $terminalKey = null;

    protected ?string $orderId = null;

    protected ?bool $success = null;

    protected ?string $status = null;

    protected ?int $paymentId = null;

    protected ?string $errorCode = null;

    protected ?int $amount = null;

    protected ?int $rebillId = null;

    protected ?int $cardId = null;

    protected ?string $pan = null;

    protected ?string $expDate = null;

    protected ?string $password = null;

    public function setTerminalKey(?string $terminalKey): object
    {
        $this->terminalKey = $terminalKey;

        return $this;
    }

    public function setOrderId(?string $orderId): object
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function setSuccess(?bool $success): object
    {
        $this->success = $success;

        return $this;
    }

    public function setStatus(?string $status): object
    {
        $this->status = $status;

        return $this;
    }

    public function setPaymentId(?int $paymentId): object
    {
        $this->paymentId = $paymentId;

        return $this;
    }

    public function setErrorCode(?string $errorCode): object
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    public function setAmount(?int $amount): object
    {
        $this->amount = $amount;

        return $this;
    }

    public function setRebillId(?int $rebillId): object
    {
        $this->rebillId = $rebillId;

        return $this;
    }

    public function setCardId(?int $cardId): object
    {
        $this->cardId = $cardId;

        return $this;
    }

    public function setPan(?string $pan): object
    {
        $this->pan = $pan;

        return $this;
    }

    public function setExpDate(?string $expDate): object
    {
        $this->expDate = $expDate;

        return $this;
    }

    public function setPassword(?string $password): object
    {
        $this->password = $password;

        return $this;
    }

    public function getTerminalKey(): ?string
    {
        return $this->terminalKey;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function getSuccess(): ?string
    {
        return var_export($this->success, true);
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getRebillId(): ?int
    {
        return $this->rebillId;
    }

    public function getCardId(): ?int
    {
        return $this->cardId;
    }

    public function getPan(): ?string
    {
        return $this->pan;
    }

    public function getExpDate(): ?string
    {
        return $this->expDate;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [
            'TerminalKey' => $this->getTerminalKey(),
            'OrderId'     => $this->getOrderId(),
            'Success'     => $this->getSuccess(),
            'Status'      => $this->getStatus(),
            'PaymentId'   => $this->getPaymentId(),
            'ErrorCode'   => $this->getErrorCode(),
            'Amount'      => $this->getAmount(),
            'RebillId'    => $this->getRebillId(),
            'CardId'      => $this->getCardId(),
            'Pan'         => $this->getPan(),
            'ExpDate'     => $this->getExpDate(),
            'Password'    => $this->getPassword()
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

    /**
     * Verify token
     *
     * @param string $token
     * @return bool
     */
    public function verify(string $token): bool
    {
        return $this->create() === $token;
    }
}
