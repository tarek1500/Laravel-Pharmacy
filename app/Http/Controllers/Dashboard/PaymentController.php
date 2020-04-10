<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
	public function charge(PaymentRequest $request)
	{
		$user = $this->getCurrentUser();
		$paymentMethod = $request->payment_method;
		$amount = $request->amount;
		$name = $request->name;

		$user->addPaymentMethod($paymentMethod);
		$user->charge($amount * 100, $paymentMethod, [
			'description' => "Pay charge for an order for user $name, for $$amount"
		]);

		return response('');
	}

	private function getCurrentUser()
	{
		$user = null;

		if (Auth::guard('admin')->check())
			$user = Auth::guard('admin')->user('admin');
		else if (Auth::guard('pharmacy')->check())
			$user = Auth::guard('pharmacy')->user('pharmacy');
		else if (Auth::guard('doctor')->check())
			$user = Auth::guard('doctor')->user('doctor');

		return $user;
	}
}