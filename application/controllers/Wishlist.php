<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wishlist extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('wishlist_model');
	}

	public function index()
	{
		if (!empty($this->session->userdata('user_id'))) {

			$language = $_REQUEST['language'];
			$securecode = $_REQUEST['securecode'];
			$user_id = $this->session->userdata('user_id');

			$this->data['wishlist_data'] = $this->wishlist_model->getuserwishlist($language, $securecode, $user_id);
			// echo "<pre>";
			// print_r($this->data['wishlist_data']);
			// exit;

			$this->load->view('wishlist', $this->data);
		} else {
			redirect(base_url());
		}
	}

	function getuserwishlist()
	{
		$language = $_REQUEST['language'];
		$securecode = $_REQUEST['securecode'];
		$user_id = $_REQUEST['user_id'];
		if (isset($language)  && !empty($language) && isset($securecode)  && !empty($securecode)  && !empty($user_id)) {
			$wishlist_result = $this->wishlist_model->getuserwishlist($language, $securecode, $user_id);
			if (!empty($wishlist_result)) {
				$response = array('status' => 1, 'msg' => 'Wishlist details is fetched succesfully', 'data' => $wishlist_result);
			} else {
				$response = array('status' => 0, 'msg' => 'Wishlist details is not found');
			}
		} else {
			$response = array('status' => 0, 'msg' => 'User is not logged in');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	function getcategory()
	{
		$language = $_REQUEST['language'];
		$securecode = $_REQUEST['securecode'];


		$response = $this->wishlist_model->getcategory($language, $securecode);
		// echo "<pre>";
		// print_r($response);
		// exit;
		echo json_encode($response);
	}

	function deletewishlistitem()
	{
		$language = $_REQUEST['language'];
		$securecode = $_REQUEST['securecode'];
		$user_id = $_REQUEST['user_id'];
		$prod_id = $_REQUEST['prod_id'];


		$response = $this->wishlist_model->deletewishlistitem($language, $securecode, $user_id, $prod_id);
		echo json_encode($response);
	}

	function add_prod_into_wishlist()
	{
		$language = $_REQUEST['language'];
		$securecode = $_REQUEST['securecode'];
		$user_id = $_REQUEST['user_id'];
		$prod_id = $_REQUEST['prod_id'];

		$response = $this->wishlist_model->add_prod_into_wishlist($language, $securecode, $user_id, $prod_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
