<?php

namespace TinkoffProvider\Validators;

use Illuminate\Support\Facades\Validator;

class SubMerchantValidator
{
    public function __invoke($parameters)
    {
        return Validator::make($parameters, [
            'billingDescriptor' => 'required|regex:/^[A-z0-9.\-_]{1,14}$/',
            'fullName' => 'required|string',
            'name' => 'required|string|max:512',
            'email' => 'required|email',
            'siteUrl' => 'nullable|url',
            'inn' => 'required|regex:/^[0-9]{1,32}$/',
            'kpp' => 'nullable|regex:/^[0-9]+/',
            'ogrn' => 'required|integer',
            'ceo' => 'required|array',
            'ceo.firstName' => 'required|string',
            'ceo.lastName' => 'required|string',
            'ceo.middleName' => 'required|string',
            'ceo.birthDate' => 'required|date:Y-m-d',
            'addresses' => 'required|array',
            'addresses.0.type' => 'required|in:legal,actual,post,other',
            'addresses.0.zip' => 'required|regex:/^[0-9]{6}$/',
            'addresses.0.country' => 'required|regex:/^[A-Z]{3}$/',
            'addresses.0.city' => 'required|string|max:28',
            'addresses.0.street' => 'required|string',
            'bankAccount' => 'required|array',
            'bankAccount.account' =>  'required|regex:/^[0-9]{20}$/',
            'bankAccount.bankName' => 'required|string|max:64',
            'bankAccount.bik' => 'required|regex:/^[0-9]{9}$/',
            'bankAccount.details' => 'required|string',
            'bankAccount.tax' => 'required|numeric',
        ]);
    }
}
