<?php

class moswarLife extends moswarUtils{
    
    public function buyLifeFromHome()
    {
        global $wb;
        $wb->goToPage( 'home/heal/' );
    }
}