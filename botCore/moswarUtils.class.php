<?php

abstract class moswarUtils{
    
    public function getRequestInfo()
    {
        global $wb;
        return $wb->getRequestInfo();
    }
}