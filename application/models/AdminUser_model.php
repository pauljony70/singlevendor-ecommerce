<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminUser_model extends CI_Model {

   public function __construct() {
        parent::__construct();
		
		$date = $this->date_time = date('Y-m-d H:i:s');
    }
   
   function insert_data($full_name,$phone_no,$role,$password)
   {
	$date = $this->date_time = date('Y-m-d H:i:s');
	$query=$this->db->query("select * from user_profile where (phone_no='".$phone_no."')");
		$row = $query->num_rows();
		if($row)
		{
		$data['message']="<h3 style='color:red'>This user already registered</h3>";
		}
		else
		{
		$query=$this->db->query("insert into user_profile set full_name='$full_name',phone_no='$phone_no',password='$password',user_id='0',role='$role',date='$date'");

		$data['message']="<h3 style='color:blue'>You are registered successfully</h3>";
		}

		$this->load->view('admin_user',@$data);
	}

	public function select()  
    {  
	 //data is retrive from this query  
	 $query = $this->db->get('user_profile');  
	 return $query;  
    }  

	public function get_data($id)  
    {  
	  $this->db->where('sno',$id);
	 $query = $this->db->get('user_profile'); 
	 return $query;  
    }  
	        

	
	public function editdata($full_name,$phone_no,$role,$password,$sno)
	{
		$update = array(
            'full_name' => $full_name,
            'phone_no' => $phone_no,
            'role' => $role,
            'password' => $password
            );
        $this->db->where('sno',$sno);
        $this->db->update('user_profile', $update);
		
	
	}

	public function delete_user($id)
    {
        $this->db->where('sno', $id);
        return $this->db->delete('user_profile');
    }
   
}
