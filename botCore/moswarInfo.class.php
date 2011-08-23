<?php

class moswarInfo extends moswarUtils{
    
    public function getTimer()
    {
        global $wb , $html;
        $time = 0;
        $html->load( $wb->goToPage('player/') );
        if($html->find('a[id=timeout]',0))
                $time = $html->find('a[id=timeout]',0)->timer;
         return $time;
    }
    
    public function getInfo()
    {
        global $wb , $html;
        $res = array();
        
        $html->load( $wb->goToPage('player/') );
        
        $res['currentHp'] = $html->find('span[id=currenthp]',0)->innertext;
        $res['maxHp'] = $html->find('span[id=maxhp]',0)->innertext;
        
        $playerIdTmp = str_replace( '/' , '' , $html->find('h3[class=curves clear] a[href*=player]',0)->href );
        $res['playerId'] = str_replace( 'player' , '' , $playerIdTmp );
        
        $res['money'] = str_replace(',' , '' , $html->find('span[rel=money]',0)->innertext );
        $res['ore'] = str_replace(',' , '' , $html->find('span[rel=ore]',0)->innertext );
        $res['oil'] = str_replace(',' , '' , $html->find('span[rel=oil]',0) ? $html->find('span[rel=oil]',0)->innertext : 0 );
         return $res;
    }
    
    public function getPoliceAttention()
    {
        global $wb , $html;
        $html->load( $wb->goToPage('police/') );
        
        $txt = trim( $html->find('div[class=wanted]',1)->innertext );
        $tmp1 = explode('<' , $txt);
        $tmp2 = explode(':' , $tmp1[0]);
        $res = (int)$tmp2[1];
         return $res;
    }
    
    public function kirkaNeed()
    {
        global $wb , $html;
        $html->load( $wb->goToPage( 'player/' ) );
        if($html->find('img[src*=underground2]' , 0))
            return false;
        else
            return true;
    }
    
    public function getAutomobileFuel( $vId )
    {
        global $wb , $html;
        $html->load( $wb->goToPage( 'automobile/car/'.$vId.'/' ) );
        
        $tmp = $html->find('div[class=fuel] span[class=neft]' , 0)->plaintext;
        $tmp2 = explode( ':' , $tmp );
        $tmp3 = explode( '/' , $tmp2[1] );
        $fuel = trim( $tmp3[0] );
         return $fuel;
    }
}
