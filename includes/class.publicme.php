<?php

/**
 * PublicMe Class
 *
 * @author   Cosmin "Gecko" Gheorghita
 * @version  1.0
 * @licence  GPL
 */
class PublicMe
{
	/**
	 * Variables that hold the user data.
	 *
	 * @since 1.0
	 */
	public $ip;
	public $os;
	public $city;
	public $proxy;
	public $latlng;
	public $region;
	public $cookies;
	public $browser;
	public $referer;
	public $country;
	public $provider;
	public $timezone;
	public $user_agent;
	public $countryCode;
	public $remote_port;
	public $request_uri;
	public $accept_lang;
	public $query_string;
	public $page_req_type;
	public $page_req_time;

	/**
	 * Main function that's executed on class call.
	 *
	 * @since 1.0
	 */
	function __construct()
	{
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->os = htmlspecialchars($this->get_user_('os'));
		$this->city = htmlspecialchars($this->geo_location(null, 'city'));
		$this->proxy = $this->check_for_proxy();
		$this->browser = htmlspecialchars($this->get_user_('browser'));
		$this->referer = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '<abbr title="Not Available">N/A</abbr>';
		$this->latlng = htmlspecialchars($this->geo_location(null, 'lat') . ', ' . $this->geo_location(null, 'lon'));
		$this->latlng = strlen($this->latlng) > 2 ? $this->latlng : 'Unknown';
		$this->region = htmlspecialchars($this->geo_location(null, 'regionName'));
		$this->country = htmlspecialchars($this->geo_location(null, 'country'));
		$this->provider = htmlspecialchars($this->geo_location(null, 'isp'));
		$this->timezone = htmlspecialchars($this->geo_location(null, 'timezone'));
		$this->user_agent = htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
		$this->countryCode = htmlspecialchars($this->geo_location(null, 'countryCode'));
		$this->remote_port = intval($_SERVER['REMOTE_PORT']);
		$this->request_uri = htmlspecialchars($_SERVER['REQUEST_URI']);
		$this->accept_lang = htmlspecialchars($this->get_languages());
		$this->query_string	= !empty($_SERVER['QUERY_STRING']) ? htmlspecialchars($_SERVER['QUERY_STRING']) : '<abbr title="Not Available">N/A</abbr>';
		$this->page_req_type = htmlspecialchars($_SERVER['REQUEST_METHOD']);
		$this->page_req_time = date('r', $_SERVER['REQUEST_TIME']);

		if (count($_COOKIE) > 0) {
			$this->cookies = '';

			foreach ($_COOKIE as $key => $value) {
				$this->cookies .= htmlspecialchars($key) . ': "' . htmlspecialchars($value) . '", ';
			}

			$this->cookies = substr($this->cookies, 0, strlen($this->cookies) - 2);
		}
		else {
			$this->cookies = 'none';
		}
	}

	/**
	 * Get user browser and os from the user agent.
	 * Based on the includes/agents.ini file.
	 * You need to update its contents on a monthly
	 * basis if you want the best results out of it.
	 *
	 * @since 1.0
	 */
	public function get_user_($key)
	{
		$agents = dirname(__FILE__) . '/agents.ini';
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		if (empty($user_agent) || !file_exists($agents)) {
			echo 'error';
		}

		$uas = parse_ini_file($agents, true);
		$browser = array();

		foreach ($uas['browser_reg'] as $test) {
			if (preg_match($test[0], $user_agent, $info)) {
				$browser['id'] = $test[1];
				break;
			}
		}

		if (isset($browser['id'])) {
			if ($uas['browser_type'][$uas['browser'][$browser['id']][0]][0]) {
				$browser['type'] = $uas['browser_type'][$uas['browser'][$browser['id']][0]][0];
				$browser['name'] = $uas['browser'][$browser['id']][1] . ' ' . $info[1];
			}
		}

		foreach ($uas['os_reg'] as $test) {
			if (preg_match($test[0], $user_agent)) {
				$os = $test[1];
				break;
			}
		}

		if (isset($os)) {
			$browser['os'] = $uas['os'][$os][1];
		}

		if (!empty($browser)) {

			if ($key == 'os') {
				return $browser['os'];
			}
			else {
				return $browser['name'];
			}
		}

		return false;
	}

	/**
	 * Check to see if the user is behind a proxy.
	 *
	 * @since 1.0
	 */
	public function check_for_proxy()
	{
		$keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'HTTP_VIA');
		$proxy = 'No proxy detected';

		foreach ($keys as $key) {
			if (isset($_SERVER[$key])) {
				$proxy = 'Proxy detected';
			}
		}

		if ($proxy == 'No proxy detected' && @fsockopen($_SERVER['REMOTE_ADDR'], 80, $errno, $errstr, 2)) {
			$proxy = 'Proxy detected';
		}

		return $proxy;
	}

	/**
	 * Gather accepted languages from the
	 * $_SERVER['HTTP_ACCEPT_LANGUAGE'] variable.
	 *
	 * @since 1.0
	 */
	public function get_languages()
	{
		$results = array();

		foreach (explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']) as $lang) {

			$pattern = 	'/^(?P<primarytag>[a-zA-Z]{2,8})' .
						'(?:-(?P<subtag>[a-zA-Z]{2,8}))?(?:(?:;q=)' .
						'(?P<quantifier>\d\.\d))?$/';
			$splits = array();

			if (preg_match($pattern, $lang, $splits)) {

				if (isset($splits[1]) && !in_array($splits[1], $results)) {
					$results[] = $splits[1];
				}
			}
		}
		if (count($results) > 0) {
			$res = implode(", ", $results);
			return substr($res, 0, strlen($res));
		}
		else {
			return '<abbr title="Not Available">N/A</abbr>';
		}
	}

	/**
	 * Gather user geolocation info.
	 * Based on an external API provided by ip-api.com
	 *
	 * @since 1.0
	 * @param null $ip
	 * @param string $key
	 * @return null
	 */
	public function geo_location($ip = null, $key = 'ip')
	{
		if ($ip == null) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		$json = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"), true);

		return isset($json[$key]) && !empty($json[$key]) ? $json[$key] : null;
	}
}
// end class: PublicMe
