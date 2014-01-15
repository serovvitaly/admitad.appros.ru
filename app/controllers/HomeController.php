<?php

class HomeController extends BaseController {
    
    public $layout = 'base.layout';

	public function getIndex()
	{   
        $this->layout->title = 'Поисковик одежды';
     
        $this->layout->content = View::make('base.search.index', array(
            'categories' => $this->getCategories()
        ));;
	}
    
    
    protected function getCategories()
    {
        if (!Cache::has('admitad_categories')) {
            
            $data = App::make('ApiController')->getUpdateCatalog(false);
            
            if (is_array($data['results']) AND count($data['results']) > 0) {
                
                $cat_1 = array();
                $cat_2 = array();
                $cat_3 = array();
                
                foreach ($data['results'] AS $cat) {
                    // level 1
                    if (!isset($cat['parent']) AND !isset($categories[$cat['id']])) {
                        $categories[$cat['id']] = array();
                    }
                    
                    // level 2
                    if (isset($cat['parent'])) {
                        //
                    }
                }
                
                Cache::add('admitad_categories', $categories, 100000000);
            } else {
                return false;
            } 
        }
        
        return Cache::get('admitad_categories');
    } 

}