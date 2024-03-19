<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('removeSpecialCharacters')) {

	function removeSpecialCharacters($value)
	{
		if (is_string($value)) {
			if (!is_JSON($value)) {

				$value = str_replace('"', '&quot;', $value);
				$value = str_replace("'", '&#039;', $value);
				$value = str_replace("\\", '', $value);
				$value = str_replace("<", '&lt;', $value);
				$value = str_replace(">", '&gt;', $value);
			} else {
				$value = str_replace("<", '&lt;', $value);
				$value = str_replace(">", '&gt;', $value);
			}
		}
		return trim($value);
	}
}

if (!function_exists('is_JSON')) {

	function is_JSON()
	{
		call_user_func_array("json_decode", func_get_args());
		return (json_last_error() === JSON_ERROR_NONE);
	}
}

if (!function_exists('price_format')) {

	function price_format($price)
	{
		$new_price = 0;

		$currency = get_settings('system_currency_symbol');
		if ($price > 0) {
			if (strpos($price, '.') !== false) {
				$new_price = $currency . '' . number_format($price, 2);
			} else {
				$new_price = $currency . '' . number_format($price, 2);
			}
		}
		return $new_price;
	}
}

if (!function_exists('get_settings')) {

	function get_settings($type)
	{

		$CI = get_instance();
		$CI->load->database();
		$des = $CI->db->get_where('settings', array('type' => $type))->row('description');

		return $des;
	}
}

if (!function_exists('get_store_settings')) {

	function get_store_settings($type)
	{

		$CI = get_instance();
		$CI->load->database();
		$des = $CI->db->get('store_setting',)->row($type);

		return $des;
	}
}

function hexToRgb($hex)
{
	// Remove the "#" symbol
	$hex = str_replace("#", "", $hex);
	// Convert to RGB
	$r = hexdec(substr($hex, 0, 2));
	$g = hexdec(substr($hex, 2, 2));
	$b = hexdec(substr($hex, 4, 2));

	return array("r" => $r, "g" => $g, "b" => $b);
}


function getDarkColorStyle($color)
{
	$rgb = hexToRgb($color);
	$dark_color = "rgb(" . $rgb['r'] * 0.8 . "," . $rgb['g'] * 0.8 . ',' . $rgb['b'] * 0.8 . ")";
	return 'background-color:' . $color . '; border: 1px solid ' . $dark_color . ';';
}

if (!function_exists('send_email')) {

	function send_email($to, $subject, $message)
	{
		$ci = &get_instance();
		$ci->load->library('email');

		// Configure SMTP settings
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => get_settings('smtp_host'),
			'smtp_port' => get_settings('smtp_port'),
			'smtp_user' => get_settings('smtp_user'),
			'smtp_pass' => get_settings('smtp_password'),
			'mailtype' => 'html',
			'charset' => 'utf-8'
		);

		$ci->email->initialize($config);
		$ci->email->set_newline("\r\n");

		// Set email parameters
		$ci->email->from($config['smtp_user'], strtolower(get_store_settings('store_name')));
		$ci->email->to($to);
		$ci->email->subject($subject);
		$ci->email->message($message);

		// Send email
		if ($ci->email->send()) {
			return true;
		} else {
			log_message('error', 'Email sending failed. Error: ' . $ci->email->print_debugger());
			return false;
		}
	}
}
