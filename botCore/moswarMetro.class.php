<?php

class moswarMetro extends moswarUtils{
    
    public function metroWork()
    {
        global $wb;
        $inputs = array(
            'action' => 'work'
        ); 
        $wb->sendPostData( 'metro/' , $inputs );
    }
    
    public function metroDig()
    {
        global $wb;
        $inputs = array(
            'action' => 'dig'
        );
        $wb->sendPostData( 'metro/' , $inputs );
    }
    
    public function metroNeedDig()
    {
        global $wb , $html;
        
        $ret = false;
        
        $html->load( $wb->goToPage('metro/') );
        
        /* If rat */
        if($html->find('div[id=welcome-rat]',0)->style == 'display:block;')
                $ret = true;
        
        /* If find % */
        if(strpos(@$html->find('div[class=metro-branch]',0)->innertext,'%') !== false)
                $ret = true;
        
        /* If the timer link is to metro */
        if($html->find('a[id=timeout]' , 0)->href == '/metro/')
                $ret = false;
        
        return $ret;
    }
    
    public function ratAviable()
    {
        global $wb , $html;
        $html->load( $wb->goToPage('metro/') );
        if($html->find('div[id=welcome-rat]',0)->style == 'display:block;')
            return true;
        else
            return false;
    }
    
    public function attackRat()
    {
        global $wb;
        $inputs = array(
            'player' => PLAYER_ID
        );
        $wb->sendPostData( 'alley/attack-npc/1/' , $inputs );
    }
    
    public function playWithMony( $sumToPlay )
    {
        global $wb , $html;
        $pageStartMoney = $wb->goToPage( 'thimble/start/' );
        
        if(strpos( $pageStartMoney , 'thimble/play/9/' ) === false)
                return false;
        
        for($i = 0; $i < floor( $sumToPlay / 1500 ) ; $i++)
        {
            $wb->goToPage( 'thimble/play/9/' );
            $wb->goToPage( 'thimble/guess/0/' );  
            $wb->goToPage( 'thimble/guess/4/' );
	    $wb->goToPage( 'thimble/guess/8/' );
        }
        
        $wb->goToPage( 'thimble/leave/' );
        return true;
    }
}
