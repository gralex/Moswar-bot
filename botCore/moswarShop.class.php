<?php

class moswarShop extends moswarUtils{
    
    public function buyItem( $itemId , $count = 1 )
    {
        $key = $this->getKey();
        $type = 'normal';
        $inputs = array(
            'key' => $key,
            'action' => 'buy',
            'item' => $itemId,
            'amount' => $count,
            'return_url' => '/',
            'type' => $type
        );
        $this->sendPostData( 'shop/' , $inputs );
    }
    
    protected function getKey()
    {
        global $html;
        $html->load( $this->goToPage('shop/') );
        $tmp = $html->find('span[onclick*=shopBuyItem]',0)->onclick;
        $tmp2 = explode( "'" , $tmp );
         return $tmp2[1];
    }
}
