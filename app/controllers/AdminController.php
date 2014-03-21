<?php

class AdminController extends BaseController {
    
    public $layout = 'admin.layout';

    public function getIndex()
    {   
        $this->layout->title = 'Админка::Home';
     
        $this->layout->content = 'Home';
    }

    public function getConfig()
    {   
        $this->layout->title = 'Админка::Конфигурация';
     
        $this->layout->content = 'Конфигурация';
    }

}