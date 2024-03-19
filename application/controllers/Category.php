<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('category_model');
	}

	public function index($cat_name, $cat_id)
	{
		$this->load->database();
		$this->data['cat_name'] = $cat_name;
		$this->data['cat_id'] = $cat_id;
		$this->data['category_details'] = $this->category_model->getcategory_product(1, $cat_id)['product_array'];
		$this->data['category_tree'] = $this->category_model->getCategoryTree($cat_id);
		$filters = $this->category_model->get_product_filter($cat_id);
		$this->data['product_filter'] =  $filters['attribute_array'];
		$this->data['price_filter'] = $filters['price_filter'];
		$this->load->view('category', $this->data);
	}

	public function all_category()
	{
		$this->load->database();
		$data['category'] = $this->category_model->get_all_category();
		$this->load->view('all_category', $data);
	}

	public function sub_category($cat_id)
	{
		$this->load->database();
		$this->data['name_cat'] = $this->category_model->get_name_category($cat_id);
		$this->data['category'] = $this->category_model->get_sub_category($cat_id);
		$this->data['cat_id'] = $cat_id;
		$this->load->view('sub_category', $this->data);
	}


	function getcategory_product()
	{
		$language = $this->input->post('language');
		$catid = $this->input->post('catid');
		$pageno = $this->input->post('pageno');
		$sortby = $this->input->post('sortby');
		$min_price = $this->input->post('min_price');
		$max_price = $this->input->post('max_price');
		$rating = $this->input->post('rating');
		$devicetype = $this->input->post('devicetype');
		$config_attr = $this->input->post('config_attr');


		$products = $this->category_model->getcategory_product($language,  $catid, $pageno, $sortby, $min_price, $max_price, $rating, $devicetype, $config_attr);
		$response = array('status' => true, 'message' => 'Products are fetched successfully.', 'data' => $products);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
