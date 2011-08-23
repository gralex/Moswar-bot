<?php

class moswarAutomobile extends moswarUtils{
    
    public function buyFuelForAutmobile( $vId )
    {
        global $wb;
        $wb->sendPostData( 'automobile/buypetrol/'.$vId.'/' , array() );
    }
    
    public function automobileAttack( $vId )
    {
        global $wb;        
        $inputs = array(
            'car' => $vId
        );
        $wb->sendPostData( 'automobile/bringup/' , $inputs );
    }
    
    public function getTimeToAttack()
    {
        global $wb , $html;
        $html->load( $wb->goToPage( 'arbat/' ) );
        $time = $html->find('span[class=ride-time]' , 0 )->innertext;
        $tmp = explode( ':' , $time );
        $timeToWait = $tmp[0] * 60 + $tmp[1];
         return $timeToWait;
    }
}