<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginmaterController extends BaseController {
	/**
	 * Register api
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required',
			'c_password' => 'required|same:password',
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', 422, $validator->errors());
		}
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		try {
			$user = User::create($input);
			$success['token'] = $user->createToken('MyApp')->accessToken;
			$success['name'] = $user->name;
			return $this->sendResponse($success, 'User register successfully.');
		} catch (Exception $e) {
			return $this->sendError($e->getmessage(), 300);

		}

	}

	public function login(Request $request) {
		$credentials = [
			'email' => $request->email,
			'password' => $request->password,
		];

		if (auth()->attempt($credentials)) {
			/* remove old tokens */
			$tokens = auth()->user()->tokens;
			foreach ($tokens as $tKey => $token) {
				$token->delete();
			}
			/* end create old token */
			$success['token'] = auth()->user()->createToken('MyApp')->accessToken;
			$success['email'] = $request->email;
			return $this->sendResponse($success, 'User Login successfully.');

		} else {
			$msg = 'User Name Password Does Not Match';
			return $this->sendError($msg, 401);
		}
	}

	/**
	 * Returns Authenticated User Details
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function details() {
		return response()->json(['user' => auth()->user()], 200);
	}
	/**
	 * invalid token token
	 *
	 * @return json
	 * @author
	 **/
	public function invalidToken(Request $request) {
		$msg = 'Token is Not Valid Or Expired';
		return $this->sendError($msg, 401);
	}
}