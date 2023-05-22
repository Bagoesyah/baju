<?php
# @Author: Awan Tengah
# @Date:   2017-02-09T21:28:34+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-18T11:03:28+07:00




defined('BASEPATH') OR exit('No direct script access allowed');

class Create_pagination {

    protected $ci;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('pagination');
    }

    public function page($base_url, $total_rows, $per_page, $segment) {
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 7;

        $config['use_global_url_suffix'] = TRUE;
        $config['reuse_query_string'] = TRUE;

        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='current'><a>";
        $config['cur_tag_close'] = "</a></li>";
        $config['next_tag_open'] = "<li class='arrow'>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li class='arrow'>";
        $config['prev_tag_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tag_close'] = "</li>";

        $this->ci->pagination->initialize($config);
        if (($this->ci->uri->segment($segment))) {
            $page = ($this->ci->uri->segment($segment) - 1) * $config['per_page'];
        } else {
            $page = 0;
        }
        return $page;
    }

}
