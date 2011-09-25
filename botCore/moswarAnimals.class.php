<?php

class moswarAnimal extends moswarUtils{
    protected $quality;
    protected $animalId = 0;
    protected $sKey = null;
    protected $trainTime = 0;
    
    function __construct( $animalId ) {
        $this->animalId = $animalId;
        
        $this->sKey = $this->getPostVerifyKey();
    }
    
    public function trainFocus()
    {
        $this->quality = 'focus';
        
        $this->train();
    }
    
    public function trainLoyalty()
    {
        $this->quality = 'loyality';
        
        $this->train();
    }
    
    public function trainSolidity()
    {
        $this->quality = 'mass';
        
        $this->train();
    }
    
    protected function train()
    {
        global $wb;
        $inputs = array(
            'action' => 'train',
            'pet' => $this->animalId,
            'skill' => $this->quality,
            'ajax' => '1',
            'postkey' => $this->sKey
        );
        
        $tmpJson = $wb->sendPostData('petarena/train/'.$this->animalId.'/'.$this->quality.'/' , $inputs , 1);
        $sRes = json_decode( $tmpJson , TRUE );
        
        if($sRes['result'] == 1)
        {
            $this->trainTime = (int)$sRes['pet']['lasttrainduration'];
        }
        else
            $this->trainTime = 0;
    }
    
    public function getTrainTime()
    {
        return $this->trainTime;
    }
}