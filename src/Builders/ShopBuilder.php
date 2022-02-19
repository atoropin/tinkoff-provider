<?php

namespace TinkoffProvider\Builders;

use Illuminate\Contracts\Support\Arrayable;

class ShopBuilder implements Arrayable
{
    /**
     * Код магазина.
     * Для параметра ShopСode необходимо использовать значение параметра Submerchant_ID, полученного при регистрации.
     */
    protected string $shopCode;

    /**
     * Сумма перечисления в копейках по реквизитам ShopCode за вычетом Fee
     */
    protected int $amount;

    /**
     * Наименование позиции
     */
    protected ?string $name = null;

    /**
     * Часть суммы Операции оплаты или % от суммы Операции оплаты.
     * Fee удерживается из возмещения третьего лица (ShopCode) в пользу Предприятия по операциям оплаты.
     */
    protected ?string $fee = null;

    public function setShopCode(string $shopCode): object
    {
        $this->shopCode = $shopCode;

        return $this;
    }

    public function setAmount(int $amount): object
    {
        $this->amount = $amount;

        return $this;
    }

    public function setName(?string $name): object
    {
        $this->name = $name;

        return $this;
    }

    public function setFee(?string $fee): object
    {
        $this->fee = $fee;

        return $this;
    }

    public function getShopCode(): string
    {
        return $this->shopCode;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getFee(): ?string
    {
        return $this->fee;
    }

    public function toArray()
    {
        return [
            'ShopCode' => $this->getShopCode(),
            'Amount'   => $this->getAmount(),
            'Name'     => $this->getName(),
            'Fee'      => $this->getFee()
        ];
    }
}
