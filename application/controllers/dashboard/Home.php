<?php
# @Author: Awan Tengah
# @Date:   2017-03-22T14:39:29+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-22T17:57:50+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Member_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->layout = 'template/dashboard';
        $this->page_title = 'Dashboard';
    }

    public function index() {
        redirect('dashboard/profile');
    }

}
