<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Cart extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('cart_model');
		$this->load->model('checkout_model');
	}

	public function index()
	{
		$this->load->database();
		$this->data['user_data'] = $this->home_model->select();
		$this->data['minordervalue'] = $this->cart_model->get_storedata();
		$user_id = $this->session->userdata('user_id');
		$this->data['cartdetails'] = $this->cart_model->get_cart_details(1, 1234567890, $user_id);
		$this->load->view('cart', $this->data);
	}

	function custom_image()
	{
		if (is_array($_FILES)) {
			if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
				$sourcePath = $_FILES['userImage']['tmp_name'];

				$ext = explode('.', $_FILES['userImage']['name']);
				$file_name = $ext[0];
				$file_ext = $ext[1];
				$new_file = $file_name . '_' . time() . '.' . $file_ext;

				$date = date("Y-m-d");
				mkdir("media/" . $date);


				$targetPath = "media/" . $date . '/' . $new_file;

				if (move_uploaded_file($sourcePath, $targetPath)) {
?>
					<div id="img_div" style="display:none;"><?php echo $targetPath; ?></div>
					<img style="height:200px;height:200px;" class="image-preview" src="<?php echo base_url() . $targetPath; ?>" class="upload-preview" />
<?php
				}
			}
		}
	}

	function add_to_cart()
	{
		$language = $_REQUEST['language'];
		$securecode = $_REQUEST['securecode'];
		$user_id = $_REQUEST['user_id'];
		$prod_id = $_REQUEST['prod_id'];
		$config_attr = $_REQUEST['config_attr'];
		$qty = $_REQUEST['qty'];

		$this->load->model('ProductDetail_model');
		$conf = $this->cart_model->check_product_conf($prod_id);
		$prod_data = $this->ProductDetail_model->getProductData($prod_id);

		if ($conf['status'] == 'yes') {
			if ($config_attr == '') {
				$response = array('status' => 0, 'msg' => 'Please choose the attribute');
			} else {
				$prod_config_data = $this->ProductDetail_model->get_product_price_request($prod_id, $config_attr);
				if ($prod_config_data['product_stock'] == 0) {
					$response = array('status' => 0, 'msg' => 'Product is out of stock');
				} elseif ($qty > $prod_config_data['product_stock']) {
					$response = array('status' => 0, 'msg' => 'Only ' . $prod_config_data['product_stock'] . ' product is available');
				} else {
					$cart = $this->cart_model->add_to_cart($user_id, $prod_id, $config_attr, $qty);
					$response = array('status' => 1, 'msg' => 'Product is succesfully added into cart', 'data' => $cart);
				}
			}
		} elseif ($conf['status'] == 'no') {
			if ($prod_data['prod_stock'] == 0) {
				$response = array('status' => 0, 'msg' => 'Product is out of stock');
			} elseif ($qty > $prod_data['prod_stock']) {
				$response = array('status' => 0, 'msg' => 'Only ' . $prod_data['prod_stock'] . ' product is available');
			} else {
				$cart = $this->cart_model->add_to_cart($user_id, $prod_id, $config_attr, $qty);
				$response = array('status' => 1, 'msg' => 'Product is succesfully added into cart', 'data' => $cart);
			}
		} else {
			$response = array('status' => 0, 'msg' => 'Product not found');
		}
		// $response = $this->cart_model->add_to_cart($language, $securecode, $user_id, $prod_id, $qty);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	function getusercartdetails()
	{
		$language = $_REQUEST['language'];
		$securecode = $_REQUEST['securecode'];
		$user_id = $_REQUEST['user_id'];


		if (isset($language)  && !empty($language) && isset($securecode)  && !empty($securecode)  && !empty($user_id)) {
			$cart_result = $this->cart_model->get_cart_details($language, $securecode, $user_id);
			if (!empty($cart_result)) {
				$response = array('status' => 1, 'msg' => 'Cart details is fetched succesfully', 'data' => $cart_result);
			} else {
				$response = array('status' => 0, 'msg' => 'Cart details is not found');
			}
		} else {
			$response = array('status' => 0, 'msg' => 'User is not logged in');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	function editcartitem()
	{
		$language = $_REQUEST['language'];
		$securecode = $_REQUEST['securecode'];
		$user_id = $_REQUEST['user_id'];
		$prod_id = $_REQUEST['prod_id'];
		$prod_qty = $_REQUEST['qty'];

		$response = $this->cart_model->update_cart_details($language, $securecode, $user_id, $prod_id, $prod_qty);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	function deletecartitem()
	{
		$language = $_REQUEST['language'];
		$securecode = $_REQUEST['securecode'];
		$user_id = $_REQUEST['user_id'];
		$prod_id = $_REQUEST['prod_id'];

		$response = $this->cart_model->delete_cart_details($language, $securecode, $user_id, $prod_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
