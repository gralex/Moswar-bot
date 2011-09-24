<?php

abstract class moswarUtils{
    
    public function getRequestInfo()
    {
        global $wb;
        return $wb->getRequestInfo();
    }
    
    public function extractLinkFromJs( $onclickCode )
    {
        $tmp = explode( "'" , $onclickCode );
        return $tmp[1];
    }
}