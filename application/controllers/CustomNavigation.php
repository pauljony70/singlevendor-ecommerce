<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomNavigation extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('navigation_model');
    }

    public function index($navigation_id)
    {
        $default_language = $this->session->userdata("default_language");
        $this->data['navigation_id'] = $navigation_id;
        $this->data['navigation_products'] = $this->navigation_model->get_navigation_products($default_language, $navigation_id)['product_array'];
        $filters = $this->navigation_model->get_navigation_product_filter($navigation_id);
        $this->data['product_filter'] =  $filters['attribute_array'];
        $this->data['price_filter'] = $filters['price_filter'];
        $this->load->view('navigation-products.php', $this->data);
    }

    function getNavigationProduct()
	{
		$language = $this->input->post('language');
		$navigation_id = $this->input->post('navigation_id');
		$pageno = $this->input->post('pageno');
		$sortby = $this->input->post('sortby');
		$min_price = $this->input->post('min_price');
		$max_price = $this->input->post('max_price');
		$rating = $this->input->post('rating');
		$devicetype = $this->input->post('devicetype');
		$config_attr = $this->input->post('config_attr');

		$products = $this->navigation_model->get_navigation_products($language, $navigation_id, $pageno, $sortby, $min_price, $max_price, $rating, $devicetype, $config_attr);
		$response = array('status' => true, 'message' => 'Products are fetched successfully.', 'data' => $products);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
