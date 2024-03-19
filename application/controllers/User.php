<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
    }

    function getUserDetails()
    {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $this->load->model('address_model');
            $this->load->model('wishlist_model');
            $this->load->model('order_model');
            $this->data['userdetails'] = $this->user_model->getUserFullDetails($user_id);
            $this->data['address'] = $this->address_model->get_address($user_id);
            $this->data['wishlist_data'] = $this->wishlist_model->getuserwishlist(1, 1234567890, $user_id);
            $this->data['orders'] = $this->order_model->getOrderDetailsByUserId($user_id);

            $this->load->view("dashboard.php", $this->data);
        } else {
            return redirect(base_url('login'));
        }
    }

    // function get User account details
    function accountDetails()
    {
        $user_id = $this->session->userdata('user_id');

        if ($user_id) {
            $this->data['userdetails'] = $this->user_model->getUserFullDetails($user_id);
            if ($this->input->method() === 'get') {
                $this->load->view("accountdetails", $this->data);
            } elseif ($this->input->method() === 'post') {
                $this->load->library('form_validation');

                // Define validation rules
                $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[3]');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|exact_length[10]');

                // Run validation
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view("accountdetails", $this->data);
                } else {
                    $user_data = array(
                        'full_name' => $this->input->post('fullname'),
                        'email'    => $this->input->post('email'),
                        'phone_no'    => $this->input->post('phone'),
                        'display_name' => explode(' ', $this->input->post('fullname'))[0],
                    );

                    // Check if email and phone are unique before updating
                    $is_unique_email = $this->db->where('user_id !=', $user_id)
                        ->where('email', $user_data['email'])
                        ->get('user_profile')
                        ->num_rows() == 0;

                    $is_unique_phone = $this->db->where('user_id !=', $user_id)
                        ->where('phone_no', $user_data['phone'])
                        ->get('user_profile')
                        ->num_rows() == 0;

                    if ($is_unique_email && $is_unique_phone) {
                        // Update user details in the database
                        $this->db->where('user_id', $user_id)
                            ->update('user_profile', $user_data);

                        $newdata = array(
                            'user_id'  => $user_id,
                            'fullname'  => $user_data['full_name'],
                            'phone'  => $user_data['phone_no'],
                            'displayname'  => $user_data['display_name'],
                            'logged_in' => TRUE
                        );

                        $this->session->set_userdata($newdata);

                        $this->session->set_flashdata('msg', 'Profile is updated successfully');
                        $this->session->set_flashdata('msg_class', 'alert-success');
                        $this->session->set_flashdata('badge', 'fa-solid fa-circle-check');
                    } else {
                        // Email or phone is not unique, set flashdata with error message
                        $this->session->set_flashdata('msg', 'Email or phone is not unique');
                        $this->session->set_flashdata('msg_class', 'alert-danger');
                        $this->session->set_flashdata('badge', 'fa-solid fa-triangle-exclamation');
                    }
                    redirect(base_url('account-details'));
                }
            } else {
                show_404();
            }
        } else {
            redirect(base_url());
        }
    }


    // Reshamdhaage user profile page controller
    function userProfile2()
    {
        return $this->load->view('userprofile.php', $this->data);
    }

    function userProfilePage()
    {
        return $this->load->view('userprofilepage.php', $this->data);
    }

    function userPassword()
    {
        return $this->load->view('userpassword.php', $this->data);
    }

    function userAddresses()
    {
        return $this->load->view('useraddress.php', $this->data);
    }

    function userOrders()
    {
        return $this->load->view('userorders.php', $this->data);
    }

    function userWishlist()
    {
        return $this->load->view('userwishlist.php', $this->data);
    }

    function productFilterPage()
    {
        return $this->load->view('filterpage.php', $this->data);
    }

    function userOrderplaced()
    {
        return $this->load->view('userorderplaced.php', $this->data);
    }
}
