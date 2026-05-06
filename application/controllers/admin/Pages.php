<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends My_controller {

    public $CI;

    function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
    }

    function flash_message() {
        $flash_message = '';
        if ($this->session->userdata('flash_message')) {
            $flash_message = $this->session->userdata('flash_message');
            $this->session->unset_userdata('flash_message');
        }
        return $flash_message;
    }

    /**
     * List all pages
     */
    public function index() {
        if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
        }

        $this->title = "Pages || " . $this->admintitle;

        $data['view_scripts'] = array(
            $this->Gen->get_admin_url('libs/datatables.net/js/jquery.dataTables.min.js'),
            $this->Gen->get_admin_url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'),
            $this->Gen->get_admin_url('libs/datatables.net-responsive/js/dataTables.responsive.min.js'),
            $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'),
        );
        $data['view_css'] = array(
            $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
            $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
        );

        $data['pages'] = $this->db->select('*')->from('app_pages')->order_by('id', 'ASC')->get()->result_array();

        $this->load_admin('pages/list', $data);
    }

    /**
     * Add new page
     */
    public function add() {
        if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
        }

        if ($this->input->post()) {
            $name    = trim($this->input->post('name'));
            $slug    = trim($this->input->post('slug'));
            $content = $this->input->post('content');

            // Validation
            if (empty($name)) {
                $this->set_message('error', 'Page name is required.');
                redirect('admin/pages/add');
                exit();
            }
            if (empty($slug)) {
                $this->set_message('error', 'Slug is required.');
                redirect('admin/pages/add');
                exit();
            }
            // Slug format check
            if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
                $this->set_message('error', 'Slug must be lowercase letters, numbers, and hyphens only (e.g. about-us).');
                redirect('admin/pages/add');
                exit();
            }
            // Unique slug check
            $exists = $this->db->select('id')->from('app_pages')->where('slug', $slug)->get()->num_rows();
            if ($exists > 0) {
                $this->set_message('error', 'A page with this slug already exists. Please use a different slug.');
                redirect('admin/pages/add');
                exit();
            }

            $insert = array(
                'name'    => $name,
                'slug'    => $slug,
                'content' => $content,
            );
            $this->db->insert('app_pages', $insert);

            $this->set_message('success', 'Page added successfully.');
            redirect('admin/pages');
            exit();
        }

        $this->title = "Add Page || " . $this->admintitle;

        $data['view_scripts'] = array(
            $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.js'),
            $this->Gen->get_admin_url('js/custom/pages.js'),
        );
        $data['view_css'] = array(
            $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.snow.css'),
        );

        $this->load_admin('pages/add', $data);
    }

    /**
     * Edit existing page
     */
    public function edit($id = null) {
        if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
        }

        $id = (int) $id;
        if (!$id) {
            redirect('admin/pages');
            exit();
        }

        $page = $this->db->select('*')->from('app_pages')->where('id', $id)->get()->row_array();
        if (!$page) {
            $this->set_message('error', 'Page not found.');
            redirect('admin/pages');
            exit();
        }

        if ($this->input->post()) {
            $name    = trim($this->input->post('name'));
            $slug    = trim($this->input->post('slug'));
            $content = $this->input->post('content');

            // Validation
            if (empty($name)) {
                $this->set_message('error', 'Page name is required.');
                redirect('admin/pages/edit/' . $id);
                exit();
            }
            if (empty($slug)) {
                $this->set_message('error', 'Slug is required.');
                redirect('admin/pages/edit/' . $id);
                exit();
            }
            if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
                $this->set_message('error', 'Slug must be lowercase letters, numbers, and hyphens only (e.g. about-us).');
                redirect('admin/pages/edit/' . $id);
                exit();
            }
            // Unique slug check (exclude current record)
            $exists = $this->db->select('id')->from('app_pages')->where('slug', $slug)->where('id !=', $id)->get()->num_rows();
            if ($exists > 0) {
                $this->set_message('error', 'A page with this slug already exists. Please use a different slug.');
                redirect('admin/pages/edit/' . $id);
                exit();
            }

            $update = array(
                'name'    => $name,
                'slug'    => $slug,
                'content' => $content,
            );
            $this->db->where('id', $id)->update('app_pages', $update);

            $this->set_message('success', 'Page updated successfully.');
            redirect('admin/pages');
            exit();
        }

        $this->title = "Edit Page || " . $this->admintitle;

        $data['page'] = $page;
        $data['view_scripts'] = array(
            $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.js'),
            $this->Gen->get_admin_url('js/custom/pages.js'),
        );
        $data['view_css'] = array(
            $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.snow.css'),
        );

        $this->load_admin('pages/edit', $data);
    }

    /**
     * Delete a page
     */
    public function delete($id = null) {
        if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
        }

        $id = (int) $id;
        if (!$id) {
            redirect('admin/pages');
            exit();
        }

        $page = $this->db->select('id')->from('app_pages')->where('id', $id)->get()->row_array();
        if (!$page) {
            $this->set_message('error', 'Page not found.');
            redirect('admin/pages');
            exit();
        }

        $this->db->delete('app_pages', array('id' => $id));
        $this->set_message('success', 'Page deleted successfully.');
        redirect('admin/pages');
        exit();
    }
}
