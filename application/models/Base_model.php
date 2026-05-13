<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model { 

    // Get All Records
    function getAll($tableName, $columnName='', $condition='', $toString='')
    {
        if (!$columnName) {
            $this->db->select('*');
        }else{
            $this->db->select($columnName);
        }

        $this->db->from($tableName);

        if ($condition){
            $this->db->where($condition);
        }

        $query = $this->db->get();

        if ($toString){
            $this->getQuery();
        }

        return $query->result_array();
    }
	function getRow($tableName, $columnName='', $condition='', $toString='')
    {
        if (!$columnName) {
            $this->db->select('*');
        }else{
            $this->db->select($columnName);
        }

        $this->db->from($tableName);

        if ($condition){
            $this->db->where($condition);
        }

        $query = $this->db->get();

        if ($toString){
            $this->getQuery();
        }

        return $query->row_array();
    }

    function insert($tableName, $data, $toString='')
    {
        foreach ($data as $key=>$val) {
            $this->db->set($key,$val);
        }

        $this->db->insert($tableName);

        if ($toString){
            $this->getQuery();
        }

        return $this->db->insert_id();
    }

    // Update Records
    function update($tableName, $data, $condition, $excludedField='', $toString='')
    {
        foreach ($data as $key=>$val) {
            if ($key != $excludedField) {
                $this->db->set($key, $val);
            }
        }

        $this->db->where($condition);

        return $this->db->update($tableName);

        if ($toString){
            $this->getQuery();
        }
    }

    // Delete Records
    function delete($tableName, $condition)
    {
        $this->db->where($condition);

        return $this->db->delete($tableName);
    }

    // Return query as a string
    function getQuery()
    {
        die($this->db->last_query());
    }
	
	// Truncate Table
    function truncate($tableName)
    {
        $this->db->truncate($tableName);
    }

    // Check if there is a file
    function hasFile($fieldName)
    {

    }

    function get_autoincrement_id($tableName,$toString='')
    {
        $this->db->select('AUTO_INCREMENT');

        $this->db->from('INFORMATION_SCHEMA.TABLES');

        $this->db->where('TABLE_SCHEMA',$this->db->database);

        $this->db->where('TABLE_NAME',$tableName);

        $query = $this->db->get();

        if ($toString){
            $this->getQuery();
        }

        $array = $query->result_array();

        return $array[0]['AUTO_INCREMENT'];
    }
    
    function check_valid_user($username, $password){
        return $this->db->select("*")->from('app_admins')->where(array('username'=>$username, 'password'=>md5($password), 'status=>100'))->get()->result_array();
    }
    
    function randomString($lenght) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $lenght; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    function sendEmail($email, $subject, $message, $attachment = ''){
                $this->load->library('phpmailer_lib');
                $mail = $this->phpmailer_lib->load();
    			
    			// SMTP configuration
    			$mail->isSMTP();
    			$mail->Host       = 'marlota.co.uk';
    			$mail->SMTPAuth   = true;
    			$mail->Username   = 'orders@marlota.co.uk';
    			$mail->Password   = 'Mancity.123';
    			$mail->SMTPSecure = 'ssl';
    			$mail->Port       = 465;
    			$mail->SMTPOptions = [
    			    'ssl' => [
    			        'verify_peer'       => false,
    			        'verify_peer_name'  => false,
    			        'allow_self_signed' => true,
    			    ],
    			];
    			
    			$mail->setFrom('orders@marlota.co.uk', $this->settings['site_title']);
    			
    			$mail->addAddress($email);	
    			$mail->Subject = $subject;
    			$mail->isHTML(true);
    			$mail->Body = $message;
    			
    			if($attachment!=''){
    			    $mail->AddAttachment($attachment);
    			}
    			// Send email
    			if($mail->send()){
    			    	$mail->clearAddresses();
    			    return 'DONE';
    			}else{
    			    	$mail->clearAddresses();
    			    return 'ERROR '.$mail->ErrorInfo;
    			}
    				
    		
    }
    public function plainText($text)
    {
        $text = strip_tags($text, '<br><p><li>');
        $text = preg_replace ('/<[^>]*>/', PHP_EOL, $text);
    
        return $text;
    }
    
    function remove_url_query($url, $key) {
        $url = preg_replace('/(?:&|(\?))' . $key . '=[^&]*(?(1)&|)?/i', "$1", $url);
        $url = rtrim($url, '?');
        $url = rtrim($url, '&');
        return $url;
    }
    
    
    
   
    
    function is_bot() {
               // User lowercase string for comparison.
          $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        
          // A list of some common words used only for bots and crawlers.
          $bot_identifiers = array(
            'bot',
            'slurp',
            'crawler',
            'spider',
            'curl',
            'facebook',
            'fetch',
          );
        
          // See if one of the identifiers is in the UA string.
          foreach ($bot_identifiers as $identifier) {
            if (strpos($user_agent, $identifier) !== FALSE) {
              return TRUE;
            }
          }
        
          return FALSE;
    }
    
    function visitor_logs(){
        
        if(!$this->is_bot()){
            if(!isset($_COOKIE['visitor_id'])) {
                $visitor_id = $this->randomString(64);
                setcookie('visitor_id', $visitor_id, time() + (7200), "/");
            }else{
                $visitor_id = $_COOKIE['visitor_id'];
            }
            
            
            // Get current page URL 
            $currentURL = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
             
            // Get server related info 
            $user_ip_address = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
            $referrer_url = !empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/'; 
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            
            $now = date('Y-m-d H:i:s');
            
            $this->db->query("INSERT INTO app_visitor_logs (visitor_id, page_url, referrer_url, user_ip_address, user_agent, created_date) VALUES ('$visitor_id', '$currentURL','$referrer_url','$user_ip_address','$user_agent','$now')");
        }
        
    }
    
    function formatNumber($phone){
        $phone = str_replace('+44', '0', $phone);
            
        if(substr($phone, 0, 1) != 0 && strlen($phone)==10){
		    $phone= "0".$phone;
		}
		
		if(substr($phone, 0, 4) == "0044"){
		    $phone= "0".substr($phone, 4, strlen($phone));
		}
		
		return $phone;
    }
    
    function resize_img($img, $path){
        // $whereToPut = 'uploads/white-background.png';
		 $whereToPut = FCPATH . 'uploads/white-background.png';
		 if (!file_exists($whereToPut)) {
				log_message('error', "Background image not found: " . $whereToPut);
				return false; // stop instead of error
			}
        $size = getimagesize($img);
        $ratio = $size[0] / $size[1]; // width/height
    
        $dst_y = 0;
        $dst_x = 0;
    
        if ($ratio > 1) {
            $width = 1000;
            $height = 1000 / $ratio;
            $dst_y = (1000 - $height) / 2;
        } else {
            $width = 1000 * $ratio;
            $height = 1000;
            $dst_x = (1000 - $width) / 2;
        }
        
        if (!@imagecreatefromstring(file_get_contents($img))) {
            return false;
        }else {
           $src = @imagecreatefromstring(file_get_contents($img));
            $dst = imagecreatetruecolor($width, $height);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
        
            
            $image1 = imagecreatefrompng($whereToPut);
        
            imagecopymerge($image1, $dst, $dst_x, $dst_y, 0, 0, imagesx($dst), imagesy($dst), 100);
            imagejpeg($image1, $path); 
            
            imagedestroy($image1);
            imagedestroy($src);
            return true;
        }
    
        
    }
}
