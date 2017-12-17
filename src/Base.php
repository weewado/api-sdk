<?php

namespace weewado;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use weewado\Exceptions\ApiRequestException;
use weewado\Exceptions\ApiResponseException;

class Base
{

	const API_URL			 = "https://api.weewado.com/v1";
	const API_SANDBOX_URL	 = "https://sandbox.api.weewado.com/v1";

	protected $client;
	protected $token;
	protected $sandbox;

	/**
	 * __construct
	 */
	public function __construct ($sandbox = true)
	{
		$this->sandbox	 = $sandbox;
		$this->client	 = new \GuzzleHttp\Client();
	}

	/**
	 * setAuth
	 * 
	 * @param string $token
	 * @throws ApiRequestException
	 */
	public function setAuth ($token)
	{
		if (trim($token) == '')
		{
			throw new ApiRequestException("Please provide a token.");
		}

		$this->token = $token;
	}

	/**
	 * callAPI
	 * 
	 * @param string $method
	 * @param string $request
	 * @param array $post
	 * @return mixed Response of API
	 * @throws ApiRequestException
	 * @throws ApiResponseException
	 */
	protected function callAPI ($method, $request, $post = [], $params = [])
	{
		if (trim($this->token) == '')
		{
			throw new ApiRequestException("Please set token with setAuth() first.");
		}

		if (empty($params) == false)
		{
			$request .= '?' . http_build_query($params);
		}

		try
		{
			if ($this->sandbox == true)
			{
				$url = self::API_SANDBOX_URL . $request;
			}
			else
			{
				$url = self::API_URL . $request;
			}

			$options = [
				'headers'	 => [
					'User-Agent'	 => 'weewadoApiSdk/1.0',
					'Accept'		 => 'application/json',
					'X-weewado-Key'	 => $this->token
				],
				'json'		 => $post
			];

			$response = $this->client->request($method, $url, $options);

			return json_decode($response->getBody()->getContents());
		}
		catch (RequestException $e)
		{
			$result	 = json_decode($e->getResponse()->getBody(true)->getContents());
			$code	 = $e->getResponse()->getStatusCode();

			throw new ApiResponseException($code, $result, $e);
		}
	}

}
