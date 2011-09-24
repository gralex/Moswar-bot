<?php

class moswarInvetory extends moswarUtils{
    
    public function getInvetoryItems()
    {
        global $html , $wb;
        $html->load( $wb->goToPage('player/') );
        
        $result = new stdClass;
        $result->withAction = array();
        $result->withoutAction = array();
        foreach($html->find('dd[htab=htabs] div[class=object-thumbs] div[class=object-thumb]') as $iObject)
        {
            if($iObject->find('div[class=action]',0))
            {
                $actionLink = $this->extractLinkFromJs( $iObject->find('div[class=action]',0)->onclick );
                $result->withAction[ $actionLink ] = $iObject->find('img',0)->src;
            }
            else
            {
                $result->withoutAction[] = $iObject->find('img',0)->src;
            }
        }
        
        return $result;
    }
}