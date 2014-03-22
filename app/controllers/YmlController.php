<?php

class YmlController extends Controller {
    
    protected $_uriList = array(
        //'http://static.ozone.ru/multimedia/yml/facet/facecare.xml',
        //'http://static.ozone.ru/multimedia/yml/facet/perfum.xml',
        //'http://static.ozone.ru/multimedia/yml/facet/decorcosmetics.xml',
        //'http://static.ozone.ru/multimedia/yml/facet/hygiene.xml',
        //'http://static.ozone.ru/multimedia/yml/facet/haircare.xml',
    ); 

    
    /**
    * Синхронизация каталога с сервером OZON.RU
    * 
    */
    public function anySync()
    {        
        $data = array();
        
        $offers = array();
        
        if (count($this->_uriList) > 0) {
            foreach ($this->_uriList AS $uri) {
                $xml = new SimpleXMLElement( file_get_contents($uri) );
                
                if (isset($xml->shop) AND isset($xml->shop->offers) AND isset($xml->shop->offers->offer)) {
                    if (count($xml->shop->offers->offer) > 0) {
                        foreach ($xml->shop->offers->offer AS $_offer) {
                            
                            $params = array();
                            if (isset($_offer->param) AND count($_offer->param) > 0) {
                                foreach ($_offer->param AS $_param) {
                                    $_paramAttrs = $_param->attributes();
                                    $_paramName  = (string) $_paramAttrs['name'];
                                    $params[$_paramName] = (string) $_param;
                                }
                            }
                            
                            $_attributes = $_offer->attributes();
                            
                            $offer = array(
                                'id'           => (double) $_attributes['id'],
                                'available'    => (bool)   $_attributes['available'],
                                'url'          => (string) $_offer->url,
                                'price'        => (float)  $_offer->price,
                                'currencyId'   => (string) $_offer->currencyId,
                                'categoryId'   => (double) $_offer->categoryId,
                                'picture'      => (string) $_offer->picture,
                                'delivery'     => (bool)   $_offer->delivery,
                                'orderingTime' => (string) $_offer->orderingTime->ordering,
                                'name'         => (string) $_offer->name,
                                'vendor'       => (string) $_offer->vendor,
                                'vendorCode'   => (double) $_offer->vendorCode,
                                'description'  => (string) $_offer->description,
                                'barcode'      => (double) $_offer->barcode,
                                'params'       => $params
                            );
                            
                            $offers[] = $offer;
                            
                            $offer['params'] = json_encode($offer['params']);
                            
                            $offerInstance = new Offer($offer);
                            
                            $offerInstance->save();
                            
                        }
                    }
                }
            }
        }
        
        return Response::json($offers);
    }
    
}