<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CronJobs extends My_controller {
    
    function __construct() {
        parent::__construct();
        
        $this->CI = & get_instance();
        
    }
    
    public function index($time){
        if($time == "1"){
            // $this->reviewUpdate(); 
            // $this->removeOldVisitors();
            // $this->generateSiteMap();
        }
        
        if($time == "30"){
            $this->getStockUpdates();
        }
    }
    
    function removeOldVisitors(){
        $this->db->query("DELETE FROM app_visitor_logs WHERE created_date < DATE(NOW()) - INTERVAL 7 DAY");
        echo 'DONE';
    }
    
    
    
    function reviewUpdate(){
        $products = $this->db->query("SELECT * FROM app_products WHERE id IN (SELECT product_id from app_product_reviews WHERE approved = 1)")->result_array();
        foreach($products as $product){
            $five_star = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND rating = 5")->num_rows();
            $four_star = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND rating = 4")->num_rows();
            $three_star = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND rating = 3")->num_rows();
            $two_star = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND rating = 2")->num_rows();
            $one_star = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND rating = 1")->num_rows();
            
            $ratings = array(
                5 => $five_star,
                4 => $four_star,
                3 => $three_star,
                2 => $two_star,
                1 => $one_star
            );
            
            $rating = $this->calcAverageRating($ratings);
            
            $this->db->query("UPDATE app_products SET rating = '$rating' WHERE id = '{$product['id']}'");
        }
    }
    
    function calcAverageRating($ratings) {

        $totalWeight = 0;
        $totalReviews = 0;
        
        foreach ($ratings as $weight => $numberofReviews) {
            $WeightMultipliedByNumber = $weight * $numberofReviews;
            $totalWeight += $WeightMultipliedByNumber;
            $totalReviews += $numberofReviews;
        }
        
        //divide the total weight by total number of reviews
        $averageRating = $totalWeight / $totalReviews;
        
        return $averageRating;
    }
    
    function generateSiteMap(){
        $myfile = fopen("sitemap.xml", "w") or die("Unable to open file!");
        $txt = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
        $txt .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        $txt .='<url>' . PHP_EOL;
        $txt .= '<loc>'.base_url().'</loc>' . PHP_EOL;
        $txt .= ' <lastmod>2022-01-01</lastmod>' . PHP_EOL;
        $txt .= '<changefreq>daily</changefreq>' . PHP_EOL;
        $txt .= '</url>' . PHP_EOL;
        
        
        $categories = $this->db->query("SELECT * FROM app_categories")->result_array();
        foreach($categories as $category){
            $txt .= '<url>' . PHP_EOL;
            $txt .= '<loc>'.base_url() .'products/?category='. $category["slug"] .'</loc>' . PHP_EOL;
            $txt .= ' <lastmod>2022-01-01</lastmod>' . PHP_EOL;
            $txt .= '<changefreq>daily</changefreq>' . PHP_EOL;
            $txt .= '</url>' . PHP_EOL;
        }
        
        $products = $this->db->query("SELECT * FROM app_products where published = '1'")->result_array();
        foreach($products as $product){
            $txt .= '<url>' . PHP_EOL;
            $txt .= '<loc>'.base_url() .'products/view/'. $product["slug"] .'</loc>' . PHP_EOL;
            $txt .= ' <lastmod>'.date("Y-m-d", strtotime($product["updated_at"])).'</lastmod>' . PHP_EOL;
            $txt .= '<changefreq>daily</changefreq>' . PHP_EOL;
            $txt .= '</url>' . PHP_EOL;
        }
        
        $txt .= '</urlset>' . PHP_EOL;
        
        fwrite($myfile, $txt);
        fclose($myfile);
    }
    
    
  function getStockUpdates(){
      $skus = array();
      $sku_list = $this->db->query("SELECT * FROM app_product_stocks")->result_array();
      foreach($sku_list as $sku){
          array_push($skus, trim($sku['sku']));
      }
      
      
       
        //set POST variables
        $url = 'https://d-orders.co.uk/api?getLiveStock=1';
        $fields = array(
                    'sku_list' => $skus
                );
        
        //url-ify the data for the POST
        $fields_string = http_build_query($fields);
        
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        
        //execute post
        $result = curl_exec($ch);
        $skusDataList = json_decode($result, true);
        
      
        
        //close connection
        curl_close($ch);
        
        
        
        
        // foreach($skusDataList as $skuData){
        //     $price = ($skuData['price'] + 0.10);
            
        //     $this->db->query("update app_product_stocks SET qty = '{$skuData['qty']}' WHERE sku = '{$skuData['sku']}'");
        // }
  }
    
}
