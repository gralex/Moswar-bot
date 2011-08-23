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
        global $wb;
        $wb->setCookiesPath( $path );
    }
    
    public function setInterface( $interface )
    {
        global $wb;
        $wb->setInterface( $interface );
    }
    
    public function setUserAgent( $uAgent )
    {
        global $wb;
        $wb->setBrowser( $uAgent );
    }
    
    public function setMainUrl( $mUrl )
    {
        global $wb;
        $wb->setMainUrl( $mUrl );
    }
    
    public function loginToMoswar()
    { 
        global $wb;
        $inputs = array(
            'action' => 'login',
            'email' => $this->username,
            'password' => $this->password,
            'remember' => 1
        );
        $wb->sendPostData( '' , $inputs );
    }
    
    public function isLoged()
    {
        global $wb , $html;
        $html->load( $wb->goToPage('player/') );
        if($html->find('a[href*=phone]',0))
            return true;
        else
            return false;        
    }
}
