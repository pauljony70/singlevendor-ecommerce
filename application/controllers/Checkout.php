<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('checkout_model');
    }

    public function index()
    {
        $this->checkout_data();
    }

    public function view()
    {
        $this->load->database();
        $this->load->model('cart_model');
        $this->load->model('address_model');
        $data['user_data'] = $this->home_model->select();
        $data['title']              = 'Checkout payment | Infovistar';
        $data['callback_url']       = base_url() . 'checkout/callback';
        $data['surl']               = base_url() . 'checkout/success';;
        $data['furl']               = base_url() . 'checkout/failed';;
        $data['currency_code']      = 'INR';

        // $data['plan_data']=$this->checkout_model->get_data($this->session->userdata('plan_id'));
        $user_id = $this->session->userdata('user_id');
        $data['cartdetails'] = $this->cart_model->get_cart_details(1, 1234567890, $user_id);
        if (!empty($data['cartdetails']['cart_result'])) {
            $data['address'] = json_decode($this->address_model->get_address($user_id)['addressarray'], true);
            // echo "<pre>";
            // print_r($data['address']);
            // exit;
            $this->load->view('checkout', $data);
        } else {
            redirect(base_url());
        }
    }

    public function address_view()
    {
        $this->load->database();
        $data['user_data'] = $this->home_model->select();
        $this->load->view('address_list', $data);
    }

    function update_defaultaddress()
    {
        $language = $_REQUEST['language'];
        $securecode = $_REQUEST['securecode'];
        $user_id = $_REQUEST['user_id'];
        $address_id = $_REQUEST['default_addressid'];


        $response = $this->checkout_model->update_defaultaddress($language, $securecode, $user_id, $address_id);
        echo json_encode($response);
    }

    function delete_address()
    {
        $language = $_REQUEST['language'];
        $securecode = $_REQUEST['securecode'];
        $user_id = $_REQUEST['user_id'];
        $address_id = $_REQUEST['address_id'];


        $response = $this->checkout_model->delete_address($language, $securecode, $user_id, $address_id);
    }

    function placeorder()
    {
        $language = $this->input->post('language');
        $user_id = $this->session->userdata('user_id');
        $customer_name = $this->input->post('fullname');
        $customer_email = $this->input->post('email');
        $customer_phone = $this->input->post('mobile');
        $customer_address = $this->input->post('fulladdress');
        $customer_city = $this->input->post('city');
        $customer_state = $this->input->post('state');
        $customer_pincode = $this->input->post('pincode');
        $payment_id = $this->input->post('payment_id');
        $payment_mode = $this->input->post('payment_mode');

        if ($language && $user_id && $customer_name && $customer_email && $customer_phone && $customer_address && $customer_city && $customer_state && $customer_pincode && $payment_id && $payment_mode) {
            $response = $this->checkout_model->placeorder($language, $user_id, $customer_name, $customer_email, $customer_phone, $customer_address, $customer_city, $customer_state, $customer_pincode, $payment_id, $payment_mode);
            if ($response['status']) {
                $response = array('status' => 1, 'msg' => 'Order is placed succesfully', 'data' => $response);
            } else {
                $response = array('status' => 0, 'msg' => $response['msg']);
            }
        } else {
            $response = array('status' => 0, 'msg' => 'Required parameters are missing');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }


    function add_address()
    {
        $language = $_REQUEST['language'];
        $securecode = $_REQUEST['securecode'];
        $fullname = $_REQUEST['fullname'];
        if ($_REQUEST['user_id'] == "") {
            $user_id = $this->session->userdata('user_id');
        } else {
            $user_id = $_REQUEST['user_id'];
        }
        $email = $_REQUEST['email'];
        $address1 = $_REQUEST['address1'];
        $address2 = $_REQUEST['address2'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $pincode = $_REQUEST['pincode'];
        $phone = $_REQUEST['phone'];

        $response = $this->checkout_model->add_address($language, $securecode, $fullname, $user_id, $email, $address1, $address2, $city, $state, $pincode, $phone);
        echo json_encode($response);
    }

    function getuseraddress()
    {
        $this->load->model('address_model');
        $user_id = $_POST['user_id'];
        $address_id = $_POST['address_id'];
        $response =  $this->address_model->getAddressById($user_id, $address_id);
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function get_shopi_data()
    {
        $email = $_REQUEST['email'];
        $language = 1;
        // $phone = $_REQUEST['phone'];

        $url = 'https://www.verifyshopi.com/get_score.php';
        $csrfName = $_POST['csrfName'];

        // 1f47af2ae220a7dadc2c6a4f22f7057f
        $data = ['language' => $language, 'trust_input' => $email, 'csrfName' => $csrfName];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        //var_dump($response);

        //$xmldata = simplexml_load_string($response);

        // Encode this xml data into json 
        // using json_encoe function
        //$jsondata = json_encode($response);


        print_r($response);
        die;
    }

    function getordersummery()
    {
        $language = $_REQUEST['language'];
        $securecode = $_REQUEST['securecode'];
        $user_id = $_REQUEST['user_id'];

        $response = $this->checkout_model->get_order_data($language, $securecode, $user_id);
        echo json_encode($response);
    }


    public function checkout_data()
    {
        $data['title']              = 'Checkout payment | Infovistar';
        $data['callback_url']       = base_url() . 'checkout/callback';
        $data['surl']               = base_url() . 'checkout/success';;
        $data['furl']               = base_url() . 'checkout/failed';;
        $data['currency_code']      = 'INR';
        $data['plan_data'] = $this->checkout_model->get_data($this->session->userdata('plan_id'));
        $this->load->view('checkout', $data);
    }

    // initialized cURL Request
    private function curl_handler($payment_id, $amount)
    {
        $url            = 'https://api.razorpay.com/v1/payments/' . $payment_id . '/capture';
        //$key_id         = "YOUR KEY ID";
        //$key_secret     = "YOUR KEY SECRET";
        $key_id = 'rzp_live_T6fvRlqyWh4Zuj';
        $key_secret = 'bCbqBiCA5fF9PN5L1CL8P6cI';
        $fields_string  = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        return $ch;
    }

    // callback method
    public function callback()
    {
        print_r($this->input->post());
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');

            $this->session->set_flashdata('razorpay_payment_id', $this->input->post('razorpay_payment_id'));
            $this->session->set_flashdata('merchant_order_id', $this->input->post('merchant_order_id'));
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';
            try {
                $ch = $this->curl_handler($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: ' . curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                    //Check success response
                    if ($http_status === 200 and isset($response_array['error']) === false) {
                        $success = true;
                    } else {
                        $success = false;
                        if (!empty($response_array['error']['code'])) {
                            $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
                        } else {
                            $error = 'RAZORPAY_ERROR:Invalid Response <br/>' . $result;
                        }
                    }
                }
                //close curl connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'Request to Razorpay Failed';
            }

            if ($success === true) {
                if (!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                }
                if (!$order_info['order_status_id']) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }
            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    }

    public function success()
    {
        $data['title'] = 'Razorpay Success | TechArise';
        echo "<h4>Your transaction is successful</h4>";
        echo "<br/>";
        echo "Transaction ID: " . $this->session->flashdata('razorpay_payment_id');
        echo "<br/>";
        echo "Order ID: " . $this->session->flashdata('merchant_order_id');
    }

    public function failed()
    {
        $data['title'] = 'Razorpay Failed | TechArise';
        echo "<h4>Your transaction got Failed</h4>";
        echo "<br/>";
        echo "Transaction ID: " . $this->session->flashdata('razorpay_payment_id');
        echo "<br/>";
        echo "Order ID: " . $this->session->flashdata('merchant_order_id');
    }
}
