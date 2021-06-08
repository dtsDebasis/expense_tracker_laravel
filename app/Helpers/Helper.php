<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Helper
{
	/**
	 * Response Json
	 * 200 OK
	 * 201 Created
	 * 202 Accepted
	 * 203 Non-Authoritative Information
	 * 204 No Content
	 * 205 Reset Content
	 * 206 Partial Content
	 * 207 Multi-Status
	 * 208 Already Reported
	 * 226 IM Used
	 *
	 * 400 Bad Request
	 * 401 Unauthorized
	 * 402 Payment Required
	 * 403 Forbidden
	 * 404 Not Found
	 * 405 Method Not Allowed
	 * 406 Not Acceptable
	 * 407 Proxy Authentication Required
	 * 408 Request Timeout
	 *
	 * 500 Internal Server Error
	 * 501 Not Implemented
	 * 502 Bad Gateway
	 */
	public static function rj($message = '', $headerStatus = 200, $data = null)
	{
		$data = self::resp($message, $headerStatus, $data);

		return response()->json($data, $headerStatus);
	}

	public static function resp($message = '', $status = 200, $data = [])
	{
		return [
			'status'  => $status,
			'message' => $message,
			'data'    => $data,
		];
	}
}
