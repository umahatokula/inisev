<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\Subscription\StoreSubscriptionRequest;

class SubscriptionController extends Controller
{
    public function store(StoreSubscriptionRequest $request)
    {
        $subscription = Subscription::create($request->all());

        return response()->json($subscription, 201);
    }
}
