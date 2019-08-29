<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller {
	/**
	 * success response method.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function sendResponse($result, $message, $code = 200) {
		$response = [
			'success' => true,
			'data' => $result,
			'message' => $message,
			'status' => $code,
		];

		return response()->json($response, 200);
	}

	/**
	 * return error response.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function sendError($error, $code = 404, $errorMessages = []) {
		$response = [
			'success' => false,
			'message' => $error,
			'status' => $code,
		];

		if (!empty($errorMessages)) {
			$response['data'] = $errorMessages;
		}

		return response()->json($response, 200);
	}
}