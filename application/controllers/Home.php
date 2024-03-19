<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
	}

	public function index()
	{
		$this->data['home_banners'] = $this->home_model->getHomeBanners();
		$this->load->view('index.php', $this->data);
	}

	public function home()
	{
		$this->load->model('ProductDetail_model');
		$this->data['home_banners'] = $this->home_model->getHomeBanners();
		$this->data['new_arrivals'] = $this->ProductDetail_model->getNewArrivals();
		$this->load->view('home.php', $this->data);
	}

	public function frame()
	{
		$this->load->view('product-details-iframe.php');
	}

	public function register()
	{
		$this->load->view('register.php');
	}

	public function about_us()
	{
		$this->load->view('about_us.php');
	}

	public function thankyou($order_id)
	{
		$this->load->model('order_model');
		$this->load->database();
		$user_id = $this->session->userdata('user_id');
		$this->data['order_id'] = $order_id;
		$this->data['order_details'] = $this->order_model->getorderdetailsByOrderId($user_id, $order_id)['order_details'];
		$this->load->view('thankyou.php', $this->data);
	}

	public function search_data($search)
	{
		$default_language = $this->session->userdata("default_language");
		$search = $_REQUEST['search'];
		$this->data['search_title'] = $search;
		$this->data['search_products'] = $this->home_model->get_search_product_request($default_language, $search)['product_array'];
		$filters = $this->home_model->get_search_product_filter($search);
		$this->data['product_filter'] =  $filters['attribute_array'];
		$this->data['price_filter'] = $filters['price_filter'];
		$this->load->view('search.php', $this->data);  // ye view/website folder hai
	}

	function getSearchProduct()
	{
		$language = $this->input->post('language');
		$search = $this->input->post('search');
		$pageno = $this->input->post('pageno');
		$sortby = $this->input->post('sortby');
		$min_price = $this->input->post('min_price');
		$max_price = $this->input->post('max_price');
		$rating = $this->input->post('rating');
		$devicetype = $this->input->post('devicetype');
		$config_attr = $this->input->post('config_attr');


		$products = $this->home_model->get_search_product_request($language,  $search, $pageno, $sortby, $min_price, $max_price, $rating, $devicetype, $config_attr);
		$response = array('status' => true, 'message' => 'Products are fetched successfully.', 'data' => $products);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function logout_data()
	{
		$this->session->sess_destroy();
		redirect('', 'refresh');
	}

	public function api_call()
	{
		$url = 'https://dbd4a3e7e70dff787a4069340884d5fd14a6f91657daf916:48fb1ed9148d343026c23d00cbeea191954ce96266ff2a71@api.exotel.com/v1/Accounts/blueappsoftware2/Calls/connect';
		$From = $_POST['From'];
		$To = $_POST['To'];
		$CallerId = $_POST['CallerId'];
		$csrfName = $_POST['csrfName'];

		// 1f47af2ae220a7dadc2c6a4f22f7057f
		$data = ['From' => $From, 'To' => $To, 'CallerId' => $CallerId, 'csrfName' => $csrfName];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		// execute!
		$response = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);

		// do anything you want with your response
		// var_dump($response);

		$xmldata = simplexml_load_string($response);

		// Encode this xml data into json 
		// using json_encoe function
		$jsondata = json_encode($xmldata);


		print_r($jsondata);
		//var_dump($jsondata);

		// die('dgdfgdfg');
	}

	public function api_call_recording()
	{
		$sid = $_POST['sid'];
		$csrfName = $_POST['csrfName'];

		$url = 'https://dbd4a3e7e70dff787a4069340884d5fd14a6f91657daf916:48fb1ed9148d343026c23d00cbeea191954ce96266ff2a71@api.exotel.com/v1/Accounts/blueappsoftware2/Calls/' . $sid;

		// 1f47af2ae220a7dadc2c6a4f22f7057f
		$data = ['csrfName' => $csrfName];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		// execute!
		$response = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);

		// do anything you want with your response
		//var_dump($response);

		$xmldata = simplexml_load_string($response);

		// Encode this xml data into json 
		// using json_encoe function
		$jsondata = json_encode($xmldata);


		print_r($jsondata);
		//var_dump($jsondata);

		// die('dgdfgdfg');
	}

	public function returnAndExchangePolicy()
	{
		$this->load->view('return-and-exchange-policy', $this->data);  // ye view/website folder hai
	}
	
	public function privacyPolicy()
	{
		$this->load->view('privacy-policy', $this->data);
	}
}
