<?php

class moswarPolice extends moswarUtils{
    
    public function bribePolice()
    {
        global $wb;
        $wb->goToPage( 'police/fine/' );
    }
}