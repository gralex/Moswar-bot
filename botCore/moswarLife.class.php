<?php

class moswarLife extends moswarUtils{
    
    public function buyLifeFromHome()
    {
        $this->goToPage( 'home/heal/' );
    }
}