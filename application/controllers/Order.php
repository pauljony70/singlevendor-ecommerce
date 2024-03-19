<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('order_model');
	}

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		if ($user_id) {
			$this->data['orders'] = $this->order_model->getOrderDetailsByUserId($user_id);
			$this->load->view('order', $this->data);
		} else {
			redirect(base_url('login'));
		}
	}

	function getorderhistory()
	{
		$language = $_REQUEST['language'];
		$securecode = $_REQUEST['securecode'];
		$user_id = $_REQUEST['user_id'];


		$response = $this->order_model->getorderhistory($language, $securecode, $user_id);
		// print_r($response);
		echo json_encode($response);
	}

	function getorderhistorydetails($order_id)
	{
		$user_id = $this->session->userdata('user_id');
		if ($user_id) {
			$this->data['order'] = $this->order_model->getorderdetailsByOrderId($user_id, $order_id);
			if (!empty($this->data['order']['order_products'])) {
				// echo "<pre>";
				// print_r($this->data['order']);
				// exit;
				$this->load->view('order_data', $this->data);
			} else {
				show_404();
			}
		} else {
			redirect(base_url());
		}
	}

	function order_details($order_id, $prod_id)
	{
		$user_id = $this->session->userdata('user_id');
		if ($user_id) {
			$this->data['order'] = $this->order_model->getOrderHistoryDetails($user_id, $order_id, $prod_id);
			if (!empty($this->data['order']['order_details'])) {
				$this->load->view('order_details', $this->data);
			} else {
				show_404();
			}
		} else {
			redirect(base_url());
		}
	}
}
