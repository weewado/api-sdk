<?php

namespace weewado\Client;

class Products extends \weewado\Base
{

	/**
	 * getProducts
	 * 
	 * @return object Object with count and array of all prodcuts
	 */
	public function getProducts ()
	{
		$url		 = "/Products";
		$response	 = $this->callAPI("GET", $url);

		return $response->data;
	}

	/**
	 * getProduct
	 * 
	 * @return object Object with details of your product
	 * @throws ApiRequestException
	 */
	public function getProduct ($productId)
	{
		if (empty($productId) == true)
		{
			throw new ApiRequestException("Please provide ID of product.");
		}

		$url		 = "/Products/" . $productId;
		$response	 = $this->callAPI("GET", $url);

		return $response->data->products[0];
	}

	/**
	 * getMyProducts
	 * 
	 * @return object Object with count and array of all your prodcuts
	 */
	public function getMyProducts ()
	{
		$url		 = "/MyProducts";
		$response	 = $this->callAPI("GET", $url);

		return $response->data;
	}

	/**
	 * getMyProduct
	 * 
	 * @return object Object with details of your product
	 * @throws ApiRequestException
	 */
	public function getMyProduct ($productId)
	{
		if (empty($productId) == true)
		{
			throw new ApiRequestException("Please provide ID of your product.");
		}

		$url		 = "/MyProducts/" . $productId;
		$response	 = $this->callAPI("GET", $url);

		return $response->data->products[0];
	}

}
