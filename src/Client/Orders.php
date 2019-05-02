<?php

namespace weewado\Client;

class Orders extends \weewado\Base
{

	/**
	 * createOrder
	 * 
	 * @param array $orderData
	 * @return int Unique ID of created new order
	 * @throws ApiRequestException
	 */
	public function createOrder ($orderData)
	{
		if (empty($orderData) == true)
		{
			throw new ApiRequestException("Please provide array of order data.");
		}

		$url		 = "/Orders";
		$response	 = $this->callAPI("POST", $url, $orderData);

		return $response->data->id;
	}

	/**
	 * addProduct
	 * 
	 * @param int $orderId ID of order you want to add a product for
	 * @param array $productDetails Array with product details
	 * @return int Unique ID of added item
	 * @throws ApiRequestException
	 */
	public function addProduct ($orderId, $productDetails)
	{
		if (trim($orderId) == '')
		{
			throw new ApiRequestException("Please provide an order id you want to add a product for.");
		}

		if (empty($productDetails) == true)
		{
			throw new ApiRequestException("Please provide an array of product data");
		}

		$url		 = "/Orders/" . $orderId . "/AddProduct";
		$response	 = $this->callAPI("POST", $url, $productDetails);

		return $response->data->id;
	}

	/**
	 * addMyProduct
	 * 
	 * @param int $orderId ID of order you want to add a product for
	 * @param array $productDetails Array with product details
	 * @return int Unique ID of added item
	 * @throws ApiRequestException
	 */
	public function addMyProduct ($orderId, $productDetails)
	{
		if (trim($orderId) == '')
		{
			throw new ApiRequestException("Please provide an order id you want to add a product for.");
		}

		if (empty($productDetails) == true)
		{
			throw new ApiRequestException("Please provide an array of product data");
		}

		$url		 = "/Orders/" . $orderId . "/AddMyProduct";
		$response	 = $this->callAPI("POST", $url, $productDetails);

		return $response->data->id;
	}

	/**
	 * addConfiguration
	 * 
	 * @param int $orderId ID of order you want to add a product for
	 * @param array $configurationDetails Array with details
	 * @return int Unique ID of added item
	 * @throws ApiRequestException
	 */
	public function addConfiguration ($orderId, $configurationDetails)
	{
		if (trim($orderId) == '')
		{
			throw new ApiRequestException("Please provide an order id you want to add a configuration for.");
		}

		if (empty($configurationDetails) == true)
		{
			throw new ApiRequestException("Please provide an array of configuration data");
		}

		$url		 = "/Orders/" . $orderId . "/AddConfiguration";
		$response	 = $this->callAPI("POST", $url, $configurationDetails);

		return $response->data->id;
	}

	/**
	 * submitOrder
	 * 
	 * @param int $orderId ID of order you want to submit/close
	 * @return bool Returns true on a successful submit
	 * @throws ApiRequestException
	 */
	public function submitOrder ($orderId)
	{
		if (trim($orderId) == '')
		{
			throw new ApiRequestException("Please provide an order id you want to submit.");
		}

		$url		 = "/Orders/" . $orderId . "/Submit";
		$response	 = $this->callAPI("POST", $url);

		return true;
	}

	/**
	 * getOrders
	 * 
	 * @return object Object with count and an array of orders
	 */
	public function getOrders ()
	{
		$url		 = "/Orders";
		$response	 = $this->callAPI("GET", $url);

		return $response->data;
	}

	/**
	 * getOrder
	 * 
	 * @param int $orderId ID of order you want to have details for
	 * @return object Object with details of your requested order 
	 * @throws ApiRequestException
	 */
	public function getOrder ($orderId)
	{
		if (trim($orderId) == '')
		{
			throw new ApiRequestException("Please provide an order id.");
		}

		$url		 = "/Orders/" . $orderId;
		$response	 = $this->callAPI("GET", $url);

		return $response->data;
	}

}
