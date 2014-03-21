<?php namespace Serovvitaly\Admitad;

class Admitad extends \Admitad\Api\Api {
    
    protected static $_api = NULL;
    
    protected static function _api()
    {
        if (self::$_api === NULL) {
            self::$_api = new self();
        }
        
        return self::$_api;
    }
    
    protected function _makeAccessToken($scope)
    {   
        $scope = trim($scope);
        
        $scopeHash = !empty($scope) ? md5($scope) : NULL;
        
        if (!$scopeHash) {
            return false;
        }
        
        $atKey = $this->_config('accessTokenCacheKey') . '_' . $scopeHash;
        
        if (\Cache::has($atKey) AND $resultCache = \Cache::get($atKey) AND !empty($resultCache) AND isset($resultCache->access_token)) {
            $this->accessToken = $resultCache->access_token;
            return;           
        }
        
        $response = $this->authorizeByPassword($this->_config('clientId'), $this->_config('clientSecret'), $scope, $this->_config('username'), $this->_config('password'));
        $result   = $response->getResult();
        
        \Cache::add($atKey, $result, floor($result->expires_in / 60));
        $this->accessToken = $result->access_token;
        
    }
    
    protected function _config($field = NULL)
    {
        $config = \Config::get('admitad');
        
        if (!empty($field)) {
            
            return isset($config[$field]) ? $config[$field] : NULL;
            
        } 
        
        return $config;
    }
    
    public static function _get($method, $scope, array $params = array(), $getResult = true)
    {   
        self::_api()->_makeAccessToken($scope);
        
        $method = '/' . trim($method, '/') . '/';
        
        $response = self::_api()->get($method, $params);
        
        return $getResult ? $response->getArrayResult() : $response;
    }

}