<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymayaController extends Controller
{
	public function __construct()
	{
		PayMayaSDK::getInstance()->initCheckout("pk-nRO7clSfJrojuRmShqRbihKPLdGeCnb9wiIWF8meJE9", "sk-jZK0i8yZ30ph8xQSWlNsF9AMWfGOd3BaxJjQ2CDCCZb", "SANDBOX");
	}

	public function checkout(Request $request)
	{
		// Checkout
		$itemCheckout = new Checkout();
		$user = new User();
		$itemCheckout->buyer = $user->buyerInfo();

		// Item
		$itemAmountDetails = new ItemAmountDetails();
		$itemAmountDetails->shippingFee = "14.00";
		$itemAmountDetails->tax = "5.00";
		$itemAmountDetails->subtotal = "50.00";
		$itemAmount = new ItemAmount();
		$itemAmount->currency = "PHP";
		$itemAmount->value = "69.00";
		$itemAmount->details = $itemAmountDetails;
		$item = new Item();
		$item->name = "Leather Belt";
		$item->code = "pm_belt";
		$item->description = "Medium-sized belt made from authentic leather";
		$item->quantity = "1";
		$item->amount = $itemAmount;
		$item->totalAmount = $itemAmount;

		$itemCheckout->items = array($item);
		$itemCheckout->totalAmount = $itemAmount;
		$itemCheckout->requestReferenceNumber = "123456789";
		$itemCheckout->redirectUrl = array(
			"success" => "https://shop.com/success",
			"failure" => "https://shop.com/failure",
			"cancel" => "https://shop.com/cancel"
			);


		$itemCheckout->execute();
	}
}
