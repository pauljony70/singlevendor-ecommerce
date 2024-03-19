<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends CI_Controller {

	function __construct() {
        parent::__construct();

        $this->load->helper('url');
		$this->load->model('plans_model');
		
    }

	public function index()
	{
		$data['plan_data']=$this->plans_model->select(); 
		$this->load->view('plans',$data);
	}

	public function add_data()
	{
			$plan_name = $_POST['plan_name'];
			$price = $_POST['price'];
			$sort_desc = $_POST['sort_desc'];
			$full_desc = $_POST['full_desc'];
			
			$this->plans_model->insert_data($plan_name,$price,$sort_desc,$full_desc);

			redirect('plans');
	}

	public function edit($id)
	{
		$data['id'] = $id;
		$data['plan_data']=$this->plans_model->get_data($id);
		$this->load->view('edit_plans',$data);
		
	}
	
	public function edit_data()
	{
		$plan_name = $_POST['plan_name'];
		$price = $_POST['price'];
		$sort_desc = $_POST['sort_desc'];
		$full_desc = $_POST['full_desc'];
		$plan_id = $_POST['plan_id'];
		
		$this->plans_model->editdata($plan_name,$price,$sort_desc,$full_desc,$plan_id);
		redirect('plans');

	}
	
	public function delete($id)
    {
        $id = $this->uri->segment(3);
        
        if($this->plans_model->delete_user($id)){
			$this->session->set_flashdata('message', 'Deleted Sucessfully');
			redirect('plans');  
		}		
    }
}
