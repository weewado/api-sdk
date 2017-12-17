<?php

namespace tests;

include_once("../../../autoload.php");

use weewado\Client\Orders;
use weewado\Client\Products;
use weewado\Exceptions\RequestException;
use weewado\Exceptions\ResponseException;

try
{
	$yourToken = '<yourToken>';

	$productsObj = new Products(false);
	$productsObj->setAuth($yourToken);
	print_r($productsObj->getMyProducts());
	#print_r($productsObj->getMyProduct(123));
	#print_r($productsObj->getProducts());
	exit;

	$orderObj	 = new Orders(false);
	$orderObj->setAuth($yourToken);
	#print_r($orderObj->getOrders());
	#print_r($orderObj->getOrder(1713));
	#exit;

	// create an order
	$orderData	 = [
		'reference'	 => '123',
		'delivery'	 => [
			'company'		 => 'Company',
			'forename'		 => 'Forename',
			'surename'		 => 'Surename',
			'street'		 => 'Street',
			'zip'			 => '12345',
			'city'			 => 'City',
			'countryCode'	 => 'GB',
			'phone'			 => '+441234567890',
			'email'			 => 'mail@mail.com',
		]
	];

	echo json_encode($orderData);
	$orderId = $orderObj->createOrder($orderData);

	// add item
	$yourItemId = '555';
	$productDetails = [
		'version'	 => $yourItemId,
		'variant'	 => '',
		'quantity'	 => 1
	];

	print_r($orderObj->addMyProduct($orderId, $productDetails));

	#print_r($orderObj->submitOrder($orderId));
}
catch (\weewado\Exceptions\ApiRequestException $ex)
{
	echo "\n";
	echo "### ERROR ###\n";
	echo "ErrorMessage: " . $ex->getMessage() . "\n";
	echo "ErrorCode: " . $ex->getCode() . "\n";
	echo "\n";
}
catch (\weewado\Exceptions\ApiResponseException $ex)
{
	echo "\n";
	echo "### ERROR ###\n";
	echo "ErrorMessage: " . $ex->getApiMessage() . "\n";
	echo "ErrorCode: " . $ex->getApiCode() . "\n";
	echo "httpResultCode: " . $ex->getHttpResultCode() . "\n";
	echo "\n";
}
