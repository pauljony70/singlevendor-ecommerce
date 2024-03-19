<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/third_party/encryptfun.php';

class Plan extends CI_Controller {

	function __construct() {
        parent::__construct();

        $this->load->helper('url');
		$this->load->model('plan_model');
		
    }

	public function register_plan($id)
	{
		$data['plan_id'] = $id;
		$data['country_data']=$this->plan_model->get_data();
		$this->load->view('register_plan',$data);
	}
	
	public function login_user()
	{
		$requiredparameters = array('email','Password');
		
		$email = $_POST['email'];
	 	$Password  = $_POST['Password'];

		$publickey_server = $this->config->item("encryption_key");
        $encruptfun = new encryptfun();
        $encryptedpassword = $encruptfun->encrypt($publickey_server,$Password);
		$password  = $encryptedpassword;

		
	 			
		if($email!='' && $Password != '') {
			$validate_user = $this->plan_model->user_login($email,$password);
			if($validate_user){
				//print_r($validate_user);
					if($validate_user['status'] == 'active'){
						if(empty($this->session->userdata('user_id')))
						{
							
							$newdata = array(
											   'user_id'  => $validate_user['sno'],
											   'user_name'  => $validate_user['fullname'],
											   'type'  => 'subscriber',
											   'logged_in' => TRUE
										   );
							 $set_data = $this->session->set_userdata($newdata);
						}
					
						//$this->responses(1,get_phrase('login_successfully',$language_code),$validate_user);
						redirect(base_url());
					}
					else
					{
						$data['message']="<h5 style='color:blue'>Invalid Login Details.</h5>";
						$this->load->view('login_view',@$data);
					}
			}
		}

	}
	
	
	public function login_plan()
	{
		$this->load->view('login_plan');
	}
	
	
	public function signup(){
	
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$country_code = $_POST['country_code'];
	 	$phone  = $_POST['phone'];
	 	$password  = $_POST['password'];
	 	//$role  = $_POST['role'];
	 	$plan_id  = $_POST['plan_id'];
	 	
	 	/*$check_email = $this->plan_model->check_data($email);
	    if($check_email['status'] == '1')
	    {
	        $data['message']="<h3 style='color:red'>This user already registered</h3>";
	        $data['country_data']=$this->plan_model->get_data();
	        $this->load->view('register_plan',$data);
	    }*/
        $otp = random_int(100000, 999999);
		$message = $otp.' is your OTP.';
		$to = $email;
		$subject = "Subscription Plan Verification";

		$message = "
		<html>
		<head>
		<title>OTP Details</title>
		</head>
		<body>
		<p>Your OTP is :".$otp."</p>
		</body>
		</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers .= 'From: <info@example.com>' . "\r\n";
		
		//if(empty($this->session->userdata('plan_id')))
		//{
			
			$newdata = array(
			   'fullname'  => $fullname,
			   'email'  => $email,
			   'country_code'  => $country_code,
			   'phone'  => $phone,
			   'password'  => $password,
			   'plan_id'  => $plan_id,
			   'logged_in' => TRUE
		   );
			 $set_data = $this->session->set_userdata($newdata);
		//}

		//mail($to,$subject,$message,$headers);

		//$sms_sent = $this->plan_model->send_sms($message, $mobile_number);
		//$data['otp'] = $otp;
		//$this->load->view('register_plan',$data);
		echo $otp;	
		return $otp;
        //}
	}
	public function verify_otp(){

		
		$email = $_POST['email'];
		$fullname = $_POST['fullname'];
		$country_code = $_POST['country_code'];
	 	$phone  = $_POST['phone'];
	 	$password  = $_POST['password'];
	 //	$role  = $_POST['role'];
	 	$plan_id  = $_POST['plan_id'];
		
		$publickey_server = $this->config->item("encryption_key");
        $encruptfun = new encryptfun();
        $encryptedpassword = $encruptfun->encrypt($publickey_server,$password);
		$password  = $encryptedpassword;
	 	
	 	
		
		if($email!='' && $password != '') {
			$validate_user = $this->plan_model->register_user($email,$fullname,$country_code,$phone,$password,$plan_id);
			if($validate_user){
				$this->session->unset_userdata('email');
				 $this->session->unset_userdata('fullname');
				 $this->session->unset_userdata('country_code');
				 $this->session->unset_userdata('phone');
				 $this->session->unset_userdata('password');
				 $this->session->unset_userdata('plan_id');
				if(empty($this->session->userdata('user_id')))
						{
							
							$newdata = array(
											   'user_id'  => $validate_user['user_id'],
											   'type'  => 'subscriber',
											   'logged_in' => TRUE
										   );
							 $set_data = $this->session->set_userdata($newdata);
							 

						}
				//redirect("Login");  
				//redirect(base_url());
				//header('Location :'.base_url());
			}
			//redirect(base_url);
			//header('Location:'.base_url);
		}
		

	}

}
