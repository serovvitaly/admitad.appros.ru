<?php

class Offer extends Eloquent {
    
    protected $table = 'core_yml_offers';
    
    protected $fillable = array('id','available','url','price','currencyId','categoryId','picture','delivery','ordering','name','vendor','vendorCode','description','barcode','params');
    
    public function getParamsAttribute($value)
    {
        return json_decode($value);
    }
    
    public function getCurrencyIdAttribute($value)
    {
        return 'руб.';
    }

}