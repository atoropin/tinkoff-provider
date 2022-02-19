<?php

namespace TinkoffProvider\Controllers;

use TinkoffProvider\Events\TinkoffNotificationEvent;
use TinkoffProvider\Facades\TinkoffFacade as Tinkoff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class TinkoffController extends Controller
{
    public function notification(Request $request)
    {
        $requestPayload = $request->all();

        if (!Tinkoff::verify($requestPayload)) {
            Log::error('Tinkoff notification: Order ID ' . Arr::get($requestPayload, 'OrderId') . ' token mismatch.');
            return;
        }

        event(new TinkoffNotificationEvent($requestPayload));

        return response('OK', 200);
    }

    public function success(Request $request)
    {
        return response('Success', 200);
    }

    public function fail(Request $request)
    {
        return response('Fail', 200);
    }
}
