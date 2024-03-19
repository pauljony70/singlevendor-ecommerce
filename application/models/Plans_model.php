<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plans_model extends CI_Model {

   public function __construct() {
        parent::__construct();
		
		$date = $this->date_time = date('Y-m-d H:i:s');
    }
	
   
   function insert_data($plan_name,$price,$sort_desc,$full_desc)
   {
	$date = $this->date_time = date('Y-m-d H:i:s');
	/*$query=$this->db->query("select * from plan where (plan_name='".$plan_name."')");
		$row = $query->num_rows();
		if($row)
		{
		$data['message']="<h3 style='color:red'>This Plan already registered</h3>";
		}
		else
		{*/
		$query=$this->db->query("insert into plan set plan_name='$plan_name',price='$price',sort_desc='$sort_desc',full_desc='$full_desc'");

		$data['message']="<h3 style='color:blue'>You are Add successfully</h3>";
		//}

	    //	$this->load->view('plans',@$data);
	   return $data; 
	}

	public function select()  
    {  
	 //data is retrive from this query  
	 $query = $this->db->get('plan');  
	 return $query;  
    }  

	public function get_data($id)  
    {  
	  $this->db->where('plan_id',$id);
	 $query = $this->db->get('plan'); 
	 return $query;  
    }  
	        

	
	public function editdata($plan_name,$price,$sort_desc,$full_desc,$plan_id)
	{
		$update = array(
            'plan_name' => $plan_name,
            'price' => $price,
            'sort_desc' => $sort_desc,
            'full_desc' => $full_desc
            );
        $this->db->where('plan_id',$plan_id);
        $this->db->update('plan', $update);
		
	
	}

	public function delete_user($id)
    {
        $this->db->where('plan_id', $id);
        return $this->db->delete('plan');
    }
   
}
