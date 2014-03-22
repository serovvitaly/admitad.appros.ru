<?php

class ApiController extends Controller {
    
    protected $_websiteId = '147349'; 

    public function getCategories()
    {
        $parent = Input::get('parent', '');
        $depth  = Input::get('depth', 1);
        
        $data = AdmAPI::_get('products/categories/' . $parent, 'public_data', array(
            'limit'  => Input::get('limit', 50),
            'offset' => Input::get('offset', 0)
        ));
        
        return Response::json($data);
    }
    
    
    public function getUpdateCatalog($json = true)
    {        
        $cats1 = AdmAPI::_get('products/categories', 'public_data', array(
            'limit'  => 500,
            'offset' => 0
        ));
    /*    $cats2 = AdmAPI::_get('products/categories', 'public_data', array(
            'limit'  => 500,
            'offset' => 500
        ));
        $cats3 = AdmAPI::_get('products/categories', 'public_data', array(
            'limit'  => 500,
            'offset' => 1000
        ));     */
        
        //$data = array_merge_recursive($cats1, $cats2, $cats3);
        $data = array_merge_recursive($cats1);
        
        return $json ? Response::json($data) : $data;
    }
    
    
    public function getWebsites()
    {
        $data = AdmAPI::_get('websites', 'websites');
        
        return Response::json($data);
    }
    
    
    public function getVendors()
    {
        $data = AdmAPI::_get('products/vendors', 'public_data');
        
        return Response::json($data);
    }
    
    
    public function getProducts()
    {        
        $data['results'] = json_decode( Offer::take(30)->get()->toJSON() ); 
        
        return Response::json($data);
    }
    
    
    public function getProduct()
    {   
        $url = 'products/' . Input::get('pid') . '/website/147349';
         
        $data = AdmAPI::_get($url, 'products_for_website');
        
        return Response::json($data);
    }

}