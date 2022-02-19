<?php

namespace TinkoffProvider\Builders;

use Illuminate\Contracts\Support\Arrayable;

class ReceiptItemBuilder implements Arrayable
{
    /**
     * Наименование товара
     */
    protected ?string $name = null;

    /**
     * Количество или вес товара
     */
    protected ?int $quantity = null;

    /**
     * Стоимость товара в копейках
     * Произведение Quantity и Price
     */
    protected ?int $amount = null;

    /**
     * Цена за единицу товара в копейках
     */
    protected ?int $price = null;

    /**
     * Признак предмета расчета:
     * commodity — товар
     * excise — подакцизный товар
     * job — работа
     * service — услуга
     * gambling_bet — ставка азартной игры
     * gambling_prize — выигрыш азартной игры
     * lottery — лотерейный билет
     * lottery_prize — выигрыш лотереи
     * intellectual_activity — предоставление результатов интеллектуальной деятельности
     * payment — платеж
     * agent_commission — агентское вознаграждение
     * composite — составной предмет расчета
     * another — иной предмет расчета
     */
    protected ?string $paymentObject = null;

    /**
     * Ставка НДС:
     * none — без НДС
     * vat0 — 0%
     * vat10 — 10%
     * vat20 — 20%
     * vat110 — 10/110
     * vat120 — 20/120
     */
    protected ?string $tax = null;

    /**
     * Массив данных чека.
     */
    protected array $agentData;

    /**
     * Данные поставщика платежного агента.
     */
    protected array $supplierInfo;

    public function setName(?string $name): object
    {
        $this->name = $name;

        return $this;
    }

    public function setQuantity(?int $quantity): object
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function setAmount(?int $amount): object
    {
        $this->amount = $amount;

        return $this;
    }

    public function setPrice(?int $price): object
    {
        $this->price = $price;

        return $this;
    }

    public function setPaymentObject(?string $paymentObject): object
    {
        $this->paymentObject = $paymentObject;

        return $this;
    }

    public function setTax(?string $tax): object
    {
        $this->tax = $tax;

        return $this;
    }

    public function setAgentData(array $agentData): object
    {
        $this->agentData = $agentData;

        return $this;
    }

    public function setSupplierInfo(array $supplierInfo): object
    {
        $this->supplierInfo = $supplierInfo;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getPaymentObject(): ?string
    {
        return $this->paymentObject;
    }

    public function getTax(): ?string
    {
        return $this->tax;
    }

    public function getAgentData(): array
    {
        return $this->agentData;
    }

    public function getSupplierInfo(): array
    {
        return $this->supplierInfo;
    }

    public function toArray()
    {
        return [
            'Name'          => $this->getName(),
            'Quantity'      => $this->getQuantity(),
            'Amount'        => $this->getAmount(),
            'Price'         => $this->getPrice(),
            'PaymentObject' => $this->getPaymentObject(),
            'Tax'           => $this->getTax(),
            'AgentData'     => $this->getAgentData(),
            'SupplierInfo'  => $this->getSupplierInfo()
        ];
    }
}
