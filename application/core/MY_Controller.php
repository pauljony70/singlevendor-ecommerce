<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your common code or initialization can go here

        $this->load->model('home_model');
        $this->data['header_cat'] = $this->home_model->get_category();
        $this->data['custom_navigations'] = $this->home_model->getCustomNavigations();
        $this->data['topbar'] = $this->home_model->getTopbarDetails();
    }
}
