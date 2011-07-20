<?php

class moswarBot extends moswarUtils{
    protected $username = '';
    protected $password = '';
    
    public function setLoginData( $username , $password )
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function setCookiesPath( $path )
    {
        define( "MOSWAR_S_CPATH" , $path );
    }
    
    public function setInterface( $interface )
    {
        define( 'MOSWAR_S_INTERFACE' , $interface );
    }
    
    public function setUserAgent( $uAgent )
    {
        define( 'MOSWAR_S_BROWSER' , $uAgent );
    }
    
    public function setMainUrl( $mUrl )
    {
        define( 'MOSWAR_S_MAINURL' , $mUrl );
    }
    
    public function loginToMoswar()
    { 
        $inputs = array(
            'action' => 'login',
            'email' => $this->username,
            'password' => $this->password,
            'remember' => 1
        );
        $this->sendPostData( '' , $inputs );
    }
    
    public function isLoged()
    {
        global $html;
        $html->load( $this->goToPage('player/') );
        if($html->find('a[href*=phone]',0))
            return true;
        else
            return false;        
    }
}
