<?php

namespace TinkoffProvider\Services;

use TinkoffProvider\Builders\SubMerchantBuilder;
use TinkoffProvider\Requests\SmRegisterRequest;
use TinkoffProvider\Validators\SubMerchantValidator;

class SubMerchantRegister
{
    private string $baseUrl;

    private string $username;

    private string $password;

    public function __construct()
    {
        $this->baseUrl  = config('tinkoff.smRegisterBaseUrl');
        $this->username = config('tinkoff.smRegisterUsername');
        $this->password = config('tinkoff.smRegisterPassword');
    }

    public function validate(SubMerchantBuilder $merchant)
    {
        return $this->validateMerchant($merchant->toArray());
    }

    public function create(SubMerchantBuilder $merchant)
    {
        return $this->createMerchant($merchant->toArray());
    }

    private function validateMerchant(array $subMerchantParameters)
    {
        $smValidator = new SubMerchantValidator();

        return $smValidator($subMerchantParameters);
    }

    private function createMerchant(array $subMerchantParameters)
    {
        return (new SmRegisterRequest(
            $this->baseUrl,
            $this->username,
            $this->password,
            $subMerchantParameters)
        )->send();
    }
}
