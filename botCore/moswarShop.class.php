<?php

class moswarShop extends moswarUtils{
    protected $key;


    function __construct() {
        $this->__getKey();
    }
    
    public function buyItem( $itemId , $count = 1 )
    {
        global $wb;
        $key = $this->getKey();
        $type = 'normal';
        $inputs = array(
            'key' => $key,
            'action' => 'buy',
            'item' => $itemId,
            //'amount' => $count,
            'return_url' => '/',
            //'type' => $type,
            'ajax_ext' => 1
        );
        $wb->sendPostData( 'shop/' , $inputs );
    }
   
    public function sendItem( $itemId , $toUser , $anonymous = true , $private = true , $comment = '' )
    {
        global $wb;
        $key = $this->getKey();
        $inputs = array(
            'action' => 'buy',
            'return_url' => '/shop/section/gifts/',
            'item' => $itemId,
            'playerid' => '',
            'key' => $key,
            'player' => $toUser,
            'comment' => $comment,
            'private' => ($private ? 'yes' : ''),
            'anonimous' => ($anonymous ? 'yes' : '')
        );
        
        $wb->sendPostData( 'shop/section/gifts/buy/'.$itemId.'/' , $inputs );
    }
    
    protected function getKey()
    {
        return $this->key;
    }

    protected function __getKey()
    {
        global $wb , $html;
        $html->load( $wb->goToPage('shop/') );
        $tmp = $html->find('span[data-return_url*=shop]',0)->{'data-key'};
        
        $this->key = $tmp;
    }
}
