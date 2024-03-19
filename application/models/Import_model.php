<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_model extends CI_Model {

   public function __construct() {
        parent::__construct();
		
		$date = $this->date_time = date('Y-m-d H:i:s');
    }

	function insert_data($order_id,$name,$email,$phone,$state,$order_status,$telecallerid,$date)
    {
	    $date = $this->date_time = date('Y-m-d H:i:s');
		$query=$this->db->query("insert into order_data set order_id='$order_id',name='$name',email='$email',phone='$phone',state='$state',order_status='$order_status',telecallerid='$telecallerid',add_date='$date'");
	}


}
