<?php

namespace TinkoffProvider\Builders;

use Illuminate\Contracts\Support\Arrayable;

class ReceiptBuilder implements Arrayable
{
    /**
     * Электронная почта покупателя
     */
    protected ?string $email = null;

    /**
     * Телефон покупателя
     */
    protected ?string $phone = null;

    /**
     * Система налогообложения:
     * osn — общая
     * usn_income — упрощенная (доходы)
     * usn_income_outcome — упрощенная (доходы минус расходы)
     * patent — патентная
     * envd — единый налог на вмененный доход
     * esn — единый сельскохозяйственный налог
     */
    protected ?string $taxation = null;

    /**
     * Массив данных чека.
     */
    protected array $agentData;

    /**
     * Данные поставщика платежного агента.
     */
    protected array $supplierInfo;

    /**
     * Массив позиций чека с информацией о товарах.
     */
    protected array $items;

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

    public function setTaxation(?string $taxation): object
    {
        $this->taxation = $taxation;

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

    public function setItems(array $items): object
    {
        $this->items = $items;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getTaxation(): ?string
    {
        return $this->taxation;
    }

    public function getAgentData(): array
    {
        return $this->agentData;
    }

    public function getSupplierInfo(): array
    {
        return $this->supplierInfo;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function toArray()
    {
        return [
            'Email'        => $this->getEmail(),
            'Phone'        => $this->getPhone(),
            'Taxation'     => $this->getTaxation(),
            'AgentData'    => $this->getAgentData(),
            'SupplierInfo' => $this->getSupplierInfo(),
            'Items'        => $this->getItems()
        ];
    }
}
