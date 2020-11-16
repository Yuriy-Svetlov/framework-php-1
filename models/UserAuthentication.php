<?php
declare (strict_types = 1);
namespace app\models;

use approot\classes\authentication\user\login_middleware\LoginByAPI_KEY;

/**
 *
 *
 */
class UserAuthentication implements \approot\classes\authentication\interfaces\UserIdentity {

	/**
	 *
	 *
	 */
	public static function verifyBySessionCookie(string $id) {
		// [1] Find in database by user ID
		// [2] Check user access

		/*
		if($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']){
		// Remove session
		setcookie("PHPSESSID", "", time());
		$_SESSION = [];
		session_destroy();
		return false;
		}
		 */
		if ($id !== "123") {
			return false;
		}

		return [
			"id" => "123",
			"username" => "admin",
			//"password" => "admin",
			'ban' => '0',
			"auth_key" => "qwerty-123",
		];
	}

	/**
	 *
	 *
	 */
	public static function verifyByCookie(string $data_cookie) {
		// [1] Get from cookie user ID and find in database user ID
		// [2] Check user access (Check fingerprint + other)

		/*
		if($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']){
		// Remove session
		setcookie("PHPSESSID", "", time());
		$_SESSION = [];
		session_destroy();
		return false;
		}
		 */

		if ($data_cookie !== "gen_new_key-123") {
			return false;
		}

		return [
			"id" => "123",
			"username" => "admin",
			//"password" => "admin",
			'ban' => '0',
			"auth_key" => "gen_new_key-123",
		];
	}

	/**
	 *
	 *
	 */
	public static function verifybyapiKey(string $data_header_auth): bool{

		$api_key = str_replace('API_KEY ', '', $data_header_auth);

		if ($api_key !== "45%3rfh./,]!=-&FcvFRDVdvm,kl|z.>?") {

			LoginByAPI_KEY::responseData(null, "Invalid API_KEY", 401);
			return false;
		}

		return true;

	}

}
