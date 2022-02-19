<?php

namespace TinkoffProvider\Builders;

use Illuminate\Contracts\Support\Arrayable;

class SubMerchantBuilder implements Arrayable
{
    protected string $billingDescriptor;

    protected string $fullName;

    protected string $name;

    protected string $email;

    protected string $siteUrl;

    protected int $inn;

    protected int $kpp;

    protected int $ogrn;

    protected array $ceo;

    protected array $addresses;

    protected array $bankAccount;

    public function setBillingDescriptor(string $billingDescriptor): object
    {
        $this->billingDescriptor = $billingDescriptor;

        return $this;
    }

    public function setFullName(string $fullName): object
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function setName(string $name): object
    {
        $this->name = $name;

        return $this;
    }

    public function setEmail(string $email): object
    {
        $this->email = $email;

        return $this;
    }

    public function setSiteUrl(string $siteUrl): object
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    public function setInn(int $inn): object
    {
        $this->inn = $inn;

        return $this;
    }

    public function setKpp(int $kpp): object
    {
        $this->kpp = $kpp;

        return $this;
    }

    public function setOgrn(int $ogrn): object
    {
        $this->ogrn = $ogrn;

        return $this;
    }

    public function setCeo(array $ceo): object
    {
        $this->ceo = $ceo;

        return $this;
    }

    public function setAddresses(array $addresses): object
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function setBankAccount(array $bankAccount): object
    {
        $this->bankAccount = $bankAccount;

        return $this;
    }

    public function getBillingDescriptor(): string
    {
        return $this->billingDescriptor;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    public function getInn(): int
    {
        return $this->inn;
    }

    public function getKpp(): int
    {
        return $this->kpp;
    }

    public function getOgrn(): int
    {
        return $this->ogrn;
    }

    public function getCeo(): array
    {
        return $this->ceo;
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }

    public function getBankAccount(): array
    {
        return $this->bankAccount;
    }

    public function toArray(): array
    {
        return [
            'billingDescriptor' => $this->getBillingDescriptor(),
            'fullName'          => $this->getFullName(),
            'name'              => $this->getName(),
            'email'             => $this->getEmail(),
            'siteUrl'           => $this->getSiteUrl(),
            'inn'               => $this->getInn(),
            'kpp'               => $this->getKpp(),
            'ogrn'              => $this->getOgrn(),
            'ceo'               => $this->getCeo(),
            'addresses'         => $this->getAddresses(),
            'bankAccount'       => $this->getBankAccount()
        ];
    }
}
