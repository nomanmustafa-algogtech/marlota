<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {
    //Login....
    public function login($username,$password)
    {
        $CI =& get_instance();
        $CI->load->model('Base_model');
        $result = $CI->Base_model->check_valid_user($username,$password);
        if ($result)
        {
            $key = md5(time());
            $key = str_replace("1", "z", $key);
            $key = str_replace("2", "J", $key);
            $key = str_replace("3", "y", $key);
            $key = str_replace("4", "R", $key);
            $key = str_replace("5", "Kd", $key);
            $key = str_replace("6", "jX", $key);
            $key = str_replace("7", "dH", $key);
            $key = str_replace("8", "p", $key);
            $key = str_replace("9", "Uf", $key);
            $key = str_replace("0", "eXnyiKFj", $key);
            $sid_web = substr($key, rand(0, 3), rand(28, 32));
            
            if($result[0]['id']==1){
                $permissions_allow = $CI->Base_model->getRow('app_permissions','GROUP_CONCAT(id) as permissions')['permissions'];
                $permissions_allow = explode(',', $permissions_allow);
            }else{
                $role = $CI->Base_model->getRow('app_roles','*', "id='".$result[0]['role_id']."'");
                $permissions_allow = explode(',', $role['permissions']);
            }
            
            // codeigniter session stored data          
            $user_data = array(
                'sid_web'           => $sid_web,
                'isLogIn'           => true,
                'isAdmin'           => true,
                'admin_id'           => $result[0]['id'],
                'admin_name'        => $result[0]['fullname'],
                'admin_username'         => $result[0]['username'],
                'admin_email'         => $result[0]['email'],
                'permissions_allow' => $permissions_allow
            );

            $CI->session->set_userdata($user_data);
          
            return TRUE;
        }else{
            return FALSE;
        }
    }
    //Check if is logged....
    public function is_logged()
    {
        $CI =& get_instance();
        if($CI->session->userdata('sid_web'))
        {
            $admin=$CI->db->query("select * from app_admins where id = '{$_SESSION['admin_id']}'")->row_array();
            if($CI->session->userdata('admin_password')!=$admin['password']){
                 $user_data = array(
                'sid_web'           => '',
                'isLogIn'           => false,
                'isAdmin'           => false,
                'admin_id'           => '',
                'admin_name'        => '',
                'admin_username'         => '',
                'admin_password'         => '',
                'admin_email'         => '',
            );
        $CI->session->sess_destroy($user_data);
                return false;
            }else{
            return true;
            }
        }
        return false;
    }
    //Logout....
    public function logout()
    {
        $CI =& get_instance();
         $user_data = array(
                'sid_web'           => '',
                'isLogIn'           => false,
                'isAdmin'           => false,
                'admin_id'           => '',
                'admin_name'        => '',
                'admin_username'         => '',
                'admin_email'         => '',
            );
        $CI->session->sess_destroy($user_data);
        return true;
    }
    //Check for logged in user is Admin or not.
    
    
    //This function is used to Generate Key
    public function generator($lenth)
    {
        $number=array("A","B","C","D","E","F","G","H","I","J","K","L","N","M","O","P","Q","R","S","U","V","T","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
    
        for($i=0; $i<$lenth; $i++)
        {
            $rand_value=rand(0,34);
            $rand_number=$number["$rand_value"];
        
            if(empty($con))
            { 
            $con=$rand_number;
            }
            else
            {
            $con="$con"."$rand_number";}
        }
        return $con;
    }

}



?>