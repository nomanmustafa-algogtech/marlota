<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function get_value($name) {
        $query = $this->db->get_where('app_settings', ['name' => $name], 1);
        if ($query->num_rows() > 0) {
            return $query->row()->value;
        }
        return '';
    }

    public function update_or_insert($name, $value) {
        $exists = $this->db->get_where('app_settings', ['name' => $name], 1);
        if ($exists->num_rows() > 0) {
            $this->db->where('name', $name)->update('app_settings', ['value' => $value]);
        } else {
            $this->db->insert('app_settings', ['name' => $name, 'value' => $value]);
        }
    }
}
