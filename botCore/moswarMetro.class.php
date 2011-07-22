<?php

class moswarMetro extends moswarUtils{
    
    public function metroWork()
    {
        $inputs = array(
            'action' => 'work'
        ); 
        $this->sendPostData( 'metro/' , $inputs );
    }
    
    public function metroDig()
    {
        $inputs = array(
            'action' => 'dig'
        );
        $this->sendPostData( 'metro/' , $inputs );
    }
    
    public function metroNeedDig()
    {
        global $html;
        
        $ret = false;
        
        $html->load( $this->goToPage('metro/') );
        
        /* If rat */
        if($html->find('div[id=welcome-rat]',0)->style == 'display:block;')
                $ret = true;
        
        /* If find % */
        if(strpos($html->find('div[class=metro-branch]',0)->innertext,'%') !== false)
                $ret = true;
        
        /* If the timer link is to metro */
        if($html->find('a[id=timeout]' , 0)->href == '/metro/')
                $ret = false;
        
        return $ret;
    }
    
    public function playWithMony( $sumToPlay )
    {
        $this->goToPage( 'thimble/start/' );
        
        for($i = 0; $i < floor( $sumToPlay / 1500 ) ; $i++)
        {
            $this->goToPage( 'thimble/play/9/' );
            $this->goToPage( 'thimble/guess/0/' );  
            $this->goToPage( 'thimble/guess/4/' );
	    $this->goToPage( 'thimble/guess/8/' );
        }
        
        $this->goToPage( 'thimble/leave/' );
    }
}
