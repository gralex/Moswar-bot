<?php

class moswarAttack extends moswarUtils{
    
    public function attackByType( $type , $victimMinLvl = 0 , $victimMaxLvl = 0 )
    {
        global $html;
        $types = array('equal' , 'weak' , 'strong' , 'enemy' , 'victim');
        $t = in_array( $type , $types) ? $type : 'weak';
        
        $inputs = array(
            'werewolf' => 0,
            'type' => $t
        );
        
        $pageDo = $this->sendPostData( 'alley/search/type/' , $inputs , 1 );
        $html->load( $pageDo );
        
        if($victimMinLvl > 0 or $victimMaxLvl > 0)
        {
            while(TRUE)
            {
                $victimLvl = $html->find('div[class=fighter2] span[class=level]',0)->innertext;
                $victimLvl = str_replace( array('[',']'), array('','') , $victimLvl );
                
                if($victimLvl >= $victimMinLvl and $victimLvl <= $victimMaxLvl)
                    break;
                else
                    $html->load( $this->goToPage('alley/search/again/') );
            }
        }
        
        $tmp = $html->find('a[onclick*=alleyAttack]',0)->onclick;
        $tmp2 = explode(',' , $tmp);
        $victimId = str_replace( 'alleyAttack(' , '' ,  $tmp2[0] );
        $inputsAttack = array(
            'action' => 'attack',
            'player' => $victimId,
            'werewolf' => 0,
            'useitems' => 0
        );
        
        $this->sendPostData( 'alley/' , $inputsAttack );
    }
    
    public function attackByLvl( $victimMinLvl , $victimMaxLvl )
    {
        global $html;
        
        $inputs = array(
            'werewolf' => 0,
            'minlevel' => $victimMinLvl,
            'maxlevel' => $victimMaxLvl
        );
        
        $pageDo = $this->sendPostData( 'alley/search/type/' , $inputs , 1 );
        $html->load( $pageDo );
        
        $tmp = $html->find('a[onclick*=alleyAttack]',0)->onclick;
        $tmp2 = explode(',' , $tmp);
        $victimId = str_replace( 'alleyAttack(' , '' ,  $tmp2[0] );
        $inputsAttack = array(
            'action' => 'attack',
            'player' => $victimId,
            'werewolf' => 0,
            'useitems' => 0
        );
        
        $this->sendPostData( 'alley/' , $inputsAttack );
    }
    
    public function attackById( $playerId )
    {
        $inputsAttack = array(
            'action' => 'attack',
            'player' => $playerId,
            'werewolf' => '',
            'useitems' => 0
        );
        $this->sendPostData( 'alley/' , $inputsAttack );
    }
}
