<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe_settings extends My_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Settings_model');
    }

    public function index() {
		if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		$data['view_scripts']=array();
		$data['view_css']=array();

        $data['stripe_pk'] = $this->Settings_model->get_value('stripe_pk');
        $data['stripe_sk'] = $this->Settings_model->get_value('stripe_sk');
        $this->load_admin('settings/stripe_settings', $data);
    }

    public function save() {
        $pk = $this->input->post('stripe_pk');
        $sk = $this->input->post('stripe_sk');

        $this->Settings_model->update_or_insert('stripe_pk', $pk);
        $this->Settings_model->update_or_insert('stripe_sk', $sk);

        echo json_encode(['status' => 'success', 'message' => 'Stripe keys saved successfully!']);
    }
}
