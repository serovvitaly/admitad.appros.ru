<?php

class HomeController extends BaseController {
    
    public $layout = 'base.layout';

	public function getIndex()
	{   
        $this->layout->title = 'Поисковик одежды';
                   
        //print_r($this->_getCategories());
     
        $this->layout->content = View::make('base.search.index', array(
            'categories' => $this->_getCategories()
        ));
	}
    
    
    protected function _turnedParents($node, &$turne)
    {
        if (isset($node['parent']) AND isset($node['parent']['id']) AND $node['parent']['id'] > 0) {
            
            $this->_turnedParents($node['parent'], $turne);
            
            $node['parent_id'] = $node['parent']['id'];
            //$node['parent'] = NULL;
            //unset($node['parent']);
            $node['items'] = array();
            
            $turne['items'][] = $node;
        } else {
            
            $node['parent_id'] = 0;
            //$node['parent'] = NULL;
            //unset($node['parent']);
            $node['items'] = array();
            
            $turne = $node;
        }
        
        $itemsReference = &$node['items'];
    }
    
    
    protected function _getCategories()
    {   
        $necessaryCategories = array(
            312,
            1702,
            1848
        );
        
        if (!Cache::has('admitad categories')) {
            
            $data = App::make('ApiController')->getUpdateCatalog(false);
            
            if (is_array($data['results']) AND count($data['results']) > 0) {
                
                $parentControl = array();
                
                //print_r($data['results']);
                
                foreach ($data['results'] AS $node) {
                    $parentControl[$node['id']] = array();
                    $this->_turnedParents($node, $parentControl[$node['id']]);
                }
                                                               
                print_r($parentControl);
                //Cache::add('admitad_categories', json_encode($categories), 900000000);
            } else {
                return false;
            } 
        }
        
        //return json_decode(Cache::get('admitad_categories'));
    } 

}