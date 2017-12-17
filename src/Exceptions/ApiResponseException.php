<?php

namespace weewado\Exceptions;

class ApiResponseException extends \Exception
{

	private $httpResultCode;
	private $apiMessage;
	private $apiCode;

	/**
	 * __construct
	 * 
	 * @param int $httpStatusCode
	 * @param object $resultBody
	 * @param Exception $previous
	 */
	public function __construct ($httpStatusCode, $resultBody, $previous = null)
	{
		$this->httpResultCode	 = $httpStatusCode;
		$this->apiCode			 = $resultBody->status;
		$this->apiMessage		 = $resultBody->message;

		parent::__construct($this->apiMessage, $this->apiCode, $previous);
	}

	/**
	 * getHttpResultCode
	 * 
	 * @return int http return code of request
	 */
	public function getHttpResultCode ()
	{
		return $this->httpResultCode;
	}

	/**
	 * apiErrorMessage
	 * 
	 * @return string returned error message from API
	 */
	public function getApiMessage ()
	{
		return $this->apiMessage;
	}

	/**
	 * apiErrorCode
	 * 
	 * @return int more detailed error code from response body
	 */
	public function getApiCode ()
	{
		return $this->apiCode;
	}

}
