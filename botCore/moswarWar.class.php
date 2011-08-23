<?php

class moswarWar extends moswarUtils{
    
    public function attackByType( $type , $victimMinLvl = 0 , $victimMaxLvl = 0 )
    {
        global $wb , $html;
        $types = array('equal' , 'weak' , 'strong' , 'enemy' , 'victim');
        $t = in_array( $type , $types) ? $type : 'weak';
        
        $inputs = array(
            'werewolf' => 0,
            'type' => $t
        );
        
        $pageDo = $wb->sendPostData( 'alley/search/type/' , $inputs , 1 );
        $html->load( $pageDo );
        
        if($victimMinLvl > 0 or $victimMaxLvl > 0)
        {
            $i = 0;
            while($i <= 25)
            {
                $i++;
                $victimLvl = $html->find('div[class=fighter2] span[class=level]',0)->innertext;
                $victimLvl = str_replace( array('[',']'), array('','') , $victimLvl );
                
                if($victimLvl >= $victimMinLvl and $victimLvl <= $victimMaxLvl)
                    break;
                else
                    $html->load( $wb->goToPage('alley/search/again/') );
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
        
        $wb->sendPostData( 'alley/' , $inputsAttack );
    }
    
    public function attackByLvl( $victimMinLvl , $victimMaxLvl )
    {
        global $wb , $html;
        
        $inputs = array(
            'werewolf' => 0,
            'minlevel' => $victimMinLvl,
            'maxlevel' => $victimMaxLvl
        );
        
        $pageDo = $wb->sendPostData( 'alley/search/type/' , $inputs , 1 );
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
        
        $wb->sendPostData( 'alley/' , $inputsAttack );
    }
    
    public function attackById( $playerId )
    {
        global $wb;
        $inputsAttack = array(
            'action' => 'attack',
            'player' => $playerId,
            'werewolf' => '',
            'useitems' => 0
        );
        $wb->sendPostData( 'alley/' , $inputsAttack );
    }
    
    public function attackForOil()
    {
        global $wb;
        $inputs = array(
            'now' => 'false',
            'action' => 'attack-npc3'
        );
        $wb->sendPostData( 'alley/' , $inputs );
    }
    
    public function attackNpc()
    {
        global $wb;
        $inputs = array();

        $wb->sendPostData( 'alley/search/npc/' , $inputs );
        $wb->goToPage('alley/attack-npc2/');
    }
    
    public function patrol( $time , $region )
    {
        global $wb;
        $inputs = array(
            'action' => 'patrol',
            'region' => $region,
            'time' => $time
        );
        $wb->sendPostData( 'alley/' , $inputs );
    }
   
}
