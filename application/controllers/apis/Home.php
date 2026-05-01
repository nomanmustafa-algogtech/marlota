<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Home extends REST_Controller
{
    public function __construct(){

     parent::__construct();

     // Load model
     $this->load->model('Base_model');
     // $this->load->library('gcm');
     
    }
    
    public function getSettings_get(){
        $data = array();
        $settings = $this->db->query("SELECT * FROM app_settings WHERE id IN (1,6,7,8,9,10,11,13,14,16,22,23)")->result_array();
        
        foreach($settings as $setting){
            $data[$setting['name']] = $setting['value'];
        }
        
        $status = REST_Controller::HTTP_OK;
        $msg = 'Data Returned';
        
        $response = ['status' => $status, 'msg' => $msg, 'data'=>$data];
        $this->set_response($response, $status);
        return;
    }
    
    public function getSliders_get(){
        $data = array();
        $sliders = $this->db->query("SELECT * FROM app_sliders ORDER BY sorting ASC")->result_array();
        
        $status = REST_Controller::HTTP_OK;
        $msg = 'Data Returned';
        
        $response = ['status' => $status, 'msg' => $msg, 'data'=>$sliders];
        $this->set_response($response, $status);
        return;
    }
    
    public function getHomeProducts_get(){
        $data = array();
        $featured = $this->db->query("SELECT a.id, a.thumbnail_img, a.name, (SELECT s.price from app_product_stocks as s WHERE s.product_id = a.id ORDER by s.price ASC LIMIT 0,1) as price, (SELECT s.discount from app_product_stocks as s WHERE s.product_id = a.id ORDER by s.price ASC LIMIT 0,1) as discount FROM app_products a WHERE a.published = '1' && a.approved = '1' && a.featured = '1' ORDER by a.id DESC LIMIT 0,30")->result_array();
        $new_arrivals = $this->db->query("SELECT a.id, a.thumbnail_img, a.name, (SELECT s.price from app_product_stocks as s WHERE s.product_id = a.id ORDER by s.price ASC LIMIT 0,1) as price, (SELECT s.discount from app_product_stocks as s WHERE s.product_id = a.id ORDER by s.price ASC LIMIT 0,1) as discount FROM app_products a WHERE a.published = '1' && a.approved = '1' ORDER by a.id DESC LIMIT 0,30")->result_array();
        $categories = $this->db->query("SELECT b.*, (SELECT COUNT(a.id) FROM app_categories as a where a.parent_id = b.id && a.level = 1) as count FROM app_categories as b where b.level = 0  ORDER BY `count`  DESC")->result_array();
        $categoriesList = array();
        foreach($categories as $category){
            $cat=array();
            $cat['name'] = $category['name'];
            $sub_categories = $this->db->query("SELECT * FROM app_categories where level = 1 && parent_id = '{$category['id']}' order by name asc")->result_array();
            $cat['sub_categories'] = $sub_categories;
            if(count($sub_categories) > 0){
               $categoriesList[] =  $cat;
            }
        }
        
        
        $sub_categories = $this->db->query("SELECT * FROM app_categories where level = 1 order by name asc")->result_array();
        $categories_home = $this->db->query("SELECT * FROM app_categories where id IN (25, 1, 5, 2, 3, 4, 14, 122, 7) && level = 0 order by name asc LIMIT 0,9")->result_array();
        
        $status = REST_Controller::HTTP_OK;
        $msg = 'Data Returned';
        
        $response = ['status' => $status, 'msg' => $msg, 'featured'=>$featured, 'new_arrivals'=>$new_arrivals, 'categories'=>$categoriesList, 'categories_home'=>$categories_home];
        $this->set_response($response, $status);
        return;
    }
    
    public function getCities_get(){
        $cities = array("Abbottabad","Adezai","Ali Bandar","Amir Chah","Attock", "Ayubia", "Bahawalpur", "Baden", "Bagh", "Bahawalnagar", "Burewala", "Banda Daud Shah", "Bannu district|Bannu", "Batagram", "Bazdar", "Bela", "Bellpat", "Bhag", "Bhakkar", "Bhalwal", "Bhimber", "Birote", "Buner", "Burj", "Chiniot", "Chachro", "Chagai", "Chah Sandan", "Chailianwala", "Chakdara", "Chakku", "Chakwal", "Chaman", "Charsadda", "Chhatr", "Chichawatni", "Chitral", "Dadu", "Dera Ghazi Khan", "Dera Ismail Khan", "Dalbandin", "Dargai", "Darya Khan", "Daska", "Dera Bugti", "Dhana Sar", "Digri", "Dina City|Dina", "Dinga", "Diplo", "Diwana", "Dokri", "Drosh", "Duki", "Dushi", "Duzab", "Faisalabad", "Fateh Jang", "Ghotki", "Gwadar", "Gujranwala", "Gujrat", "Gadra", "Gajar", "Gandava", "Garhi Khairo", "Garruck", "Ghakhar Mandi", "Ghanian", "Ghauspur", "Ghazluna", "Girdan", "Gulistan", "Gwash", "Hyderabad", "Hala", "Haripur", "Hab Chauki", "Hafizabad", "Hameedabad", "Hangu", "Harnai", "Hasilpur", "Haveli Lakha", "Hinglaj", "Hoshab", "Islamabad", "Islamkot", "Ispikan", "Jacobabad", "Jamshoro", "Jhang", "Jhelum", "Jamesabad", "Jampur", "Janghar", "Jati(Mughalbhin)", "Jauharabad", "Jhal", "Jhal Jhao", "Jhatpat", "Jhudo", "Jiwani", "Jungshahi", "Karachi", "Kotri", "Kalam", "Kalandi", "Kalat", "Kamalia", "Kamararod", "Kamber", "Kamokey", "Kanak", "Kandi", "Kandiaro", "Kanpur", "Kapip", "Kappar", "Karak City", "Karodi", "Kashmor", "Kasur", "Katuri", "Keti Bandar", "Khairpur", "Khanaspur", "Khanewal", "Kharan", "kharian", "Khokhropur", "Khora", "Khushab", "Khuzdar", "Kikki", "Klupro", "Kohan", "Kohat", "Kohistan", "Kohlu", "Korak", "Korangi", "Kot Sarae", "Kotli", "Lahore", "Larkana", "Lahri", "Lakki Marwat", "Lasbela", "Latamber", "Layyah", "Leiah", "Liari", "Lodhran", "Loralai", "Lower Dir", "Shadan Lund", "Multan", "Mandi Bahauddin", "Mansehra", "Mian Chanu", "Mirpur", ", Pakistan|Moro", "Mardan", "Mach", "Madyan", "Malakand", "Mand", "Manguchar", "Mashki Chah", "Maslti", "Mastuj", "Mastung", "Mathi", "Matiari", "Mehar", "Mekhtar", "Merui", "Mianwali", "Mianez", "Mirpur Batoro", "Mirpur Khas", "Mirpur Sakro", "Mithi", "Mongora", "Murgha Kibzai", "Muridke", "Musa Khel Bazar", "Muzaffar Garh", "Muzaffarabad", "Nawabshah", "Nazimabad", "Nowshera", "Nagar Parkar", "Nagha Kalat", "Nal", "Naokot", "Nasirabad", "Nauroz Kalat", "Naushara", "Nur Gamma", "Nushki", "Nuttal", "Okara", "Ormara", "Peshawar", "Panjgur", "Pasni City", "Paharpur", "Palantuk", "Pendoo", "Piharak", "Pirmahal", "Pishin", "Plandri", "Pokran", "Pounch", "Quetta", "Qambar", "Qamruddin Karez", "Qazi Ahmad", "Qila Abdullah", "Qila Ladgasht", "Qila Safed", "Qila Saifullah", "Rawalpindi", "Rabwah", "Rahim Yar Khan", "Rajan Pur", "Rakhni", "Ranipur", "Ratodero", "Rawalakot", "Renala Khurd", "Robat Thana", "Rodkhan", "Rohri", "Sialkot", "Sadiqabad", "Safdar Abad- (Dhaban Singh)", "Sahiwal", "Saidu Sharif", "Saindak", "Sakrand", "Sanjawi", "Sargodha", "Saruna", "Shabaz Kalat", "Shadadkhot", "Shahbandar", "Shahpur", "Shahpur Chakar", "Shakargarh", "Shangla", "Sharam Jogizai", "Sheikhupura", "Shikarpur", "Shingar", "Shorap", "Sibi", "Sohawa", "Sonmiani", "Sooianwala", "Spezand", "Spintangi", "Sui", "Sujawal", "Sukkur", "Suntsar", "Surab", "Swabi", "Swat", "Tando Adam", "Tando Bago", "Tangi", "Tank City", "Tar Ahamd Rind", "Thalo", "Thatta", "Toba Tek Singh", "Tordher", "Tujal", "Tump", "Turbat", "Umarao", "Umarkot", "Upper Dir", "Uthal", "Vehari", "Veirwaro", "Vitakri", "Wadh", "Wah Cantt", "Warah", "Washap", "Wasjuk", "Wazirabad", "Yakmach", "Zhob", "Other");
        $status = REST_Controller::HTTP_OK;
        $msg = 'Data Returned';
        
        $response = ['status' => $status, 'msg' => $msg, 'data'=>$cities];
        $this->set_response($response, $status);
        return;
        
    }
    
    
}