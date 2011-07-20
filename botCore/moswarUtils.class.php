<?php

abstract class moswarUtils{
    
    protected function goToPage( $pageUrl )
    {
        $wb = new cUrlClass();
        
        if( defined('MOSWAR_S_BROWSER') )
            $wb->setBrowser ( MOSWAR_S_BROWSER );
        
        $wb->setCookiesPath( defined('MOSWAR_S_CPATH') ? MOSWAR_S_CPATH : '' );
        $wb->setInterface( defined('MOSWAR_S_INTERFACE') ? MOSWAR_S_INTERFACE : '' );
        $wb->setMainUrl( defined('MOSWAR_S_MAINURL') ? MOSWAR_S_MAINURL : '' );
        
        return $wb->goToPage( $pageUrl );
    }
    
    protected function sendPostData( $formAction , $formInputs , $returnPage = false )
    {
        $wb = new cUrlClass();
        
        if( defined('MOSWAR_S_BROWSER') )
            $wb->setBrowser ( MOSWAR_S_BROWSER );
        
        $wb->setCookiesPath( defined('MOSWAR_S_CPATH') ? MOSWAR_S_CPATH : '' );
        $wb->setInterface( defined('MOSWAR_S_INTERFACE') ? MOSWAR_S_INTERFACE : '' );
        $wb->setMainUrl( defined('MOSWAR_S_MAINURL') ? MOSWAR_S_MAINURL : '' );
        
        if($returnPage)
            return $wb->sendPostData ( $formAction , $formInputs , true );
        else
            $wb->sendPostData ( $formAction , $formInputs , false );
    }
}