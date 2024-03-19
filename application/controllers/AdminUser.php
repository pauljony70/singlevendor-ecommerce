<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminUser extends CI_Controller {
	
	function __construct() {
        parent::__construct();

        $this->load->helper('url');
		$this->load->model('AdminUser_model');
		
    }

	public function index()
	{
		 $this->load->database();  
         $data['user_data']=$this->AdminUser_model->select();  
		 $this->load->view('admin_user', $data);
		//$this->load->view('admin_user');
	}
	public function add_user()
	{
			$full_name = $_POST['full_name'];
			$phone_no = $_POST['phone_no'];
			$role = $_POST['role'];
			$password = $_POST['password'];
			
			$this->AdminUser_model->insert_data($full_name,$phone_no,$role,$password);

			
	}
	
	public function edit($id)
	{
		$data['id'] = $id;
		$data['user_data']=$this->adminuser_model->get_data($id);
		$this->load->view('edit_admin_user',$data);
		
	}
	
	public function edit_data()
	{
        $full_name = $_POST['full_name'];
		$phone_no = $_POST['phone_no'];
		$role = $_POST['role'];
		$password = $_POST['password'];
		$sno = $_POST['sno'];
		
		$this->AdminUser_model->editdata($full_name,$phone_no,$role,$password,$sno);
		redirect('admin_user');

	}

	public function delete($id)
    {
        $id = $this->uri->segment(3);
        
        if($this->AdminUser_model->delete_user($id)){
			$this->session->set_flashdata('message', 'Deleted Sucessfully');
			redirect('admin_user');  
		}		
    }
	
}
