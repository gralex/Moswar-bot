<?php

class moswarInfo extends moswarUtils{
    
    public function getTimer()
    {
        global $html;
        $time = 0;
        $html->load( $this->goToPage('player/') );
        if($html->find('a[id=timeout]',0))
                $time = $html->find('a[id=timeout]',0)->timer;
         return $time;
    }
    
    public function getInfo()
    {
        global $html;
        $res = array();
        
        $html->load( $this->goToPage('player/') );
        
        $res['currentHp'] = $html->find('span[id=currenthp]',0)->innertext;
        $res['maxHp'] = $html->find('span[id=maxhp]',0)->innertext;
        
        $res['money'] = str_replace(',' , '' , $html->find('span[rel=money]',0)->innertext );
        $res['ore'] = str_replace(',' , '' , $html->find('span[rel=ore]',0)->innertext );
        $res['oil'] = str_replace(',' , '' , $html->find('span[rel=oil]',0)->innertext );
         return $res;
    }
    
    public function getPoliceAttention()
    {
        global $html;
        $html->load( $this->goToPage('police/') );
        
        $txt = trim( $html->find('div[class=wanted]',1)->innertext );
        $tmp1 = explode('<' , $txt);
        $tmp2 = explode(':' , $tmp1[0]);
        $res = (int)$tmp2[1];
         return $res;
    }
}
