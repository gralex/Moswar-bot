<?php

class moswarFactory extends moswarUtils{
    
    public function makeNanoPetriki()
    {
        global $wb;
        $inputs = array(
            'player' => PLAYER_ID,
        );
        $wb->sendPostData( 'factory/start-petriks/' , $inputs );
    }
}