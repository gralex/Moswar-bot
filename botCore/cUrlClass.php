<?php
// Curl Class for navigate to sites

class cUrlClass{
    private $browser = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3';
    private $cookies_path = '';
    private $main_url = '';
    private $intf = '';
    protected $ch = null;
    protected $reqInfo = null;
    
    function __construct() {
        $this->ch = curl_init();
    }
    
    public function setCookiesPath( $path )
    {
        $this->cookies_path = $path;   
    }
    
    public function setMainUrl( $url )
    {
        $this->main_url = $url;
    }
    
    public function setInterface( $intf )
    {
        $this->intf = $intf;
    }
    
    public function setBrowser( $browser )
    {
        $this->browser = $browser;
    }
    
    private function checkSettings()
    {
        if(strlen($this->browser) == 0 or strlen($this->cookies_path) == 0)
        {
            echo "cUrl class settings error !";
            return;
        }
    }

    public function goToPage($url)
    {
        $this->checkSettings();
        
        if(BOT_DEBUG)
            echo "GET: ".$url."\n";
        
        curl_setopt($this->ch,CURLOPT_URL,$this->main_url.$url);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->ch,CURLOPT_USERAGENT,$this->browser);
        curl_setopt($this->ch,CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($this->ch,CURLOPT_COOKIEJAR,$this->cookies_path);
        curl_setopt($this->ch,CURLOPT_COOKIEFILE,$this->cookies_path);
        curl_setopt($this->ch,CURLOPT_CONNECTTIMEOUT, 15);
	if(strlen($this->intf) > 0)
        {
            curl_setopt($this->ch,CURLOPT_INTERFACE,$this->intf);
        }
          $tmpPage = curl_exec($this->ch);
          
          if(ENABLE_ANTI_CAPTCHA)
          {
              if(strpos( $tmpPage , 'showCaptcha' ))
              {
                $cName = $this->__saveCaptcha();
              
                /* Decode captcha */
                $this->__decodeCaptcha( $cName );
                return $this->goToPage($url);
              }
          }
          
          
          if(strpos( $tmpPage , 'А-а-а-а-а-а!!! Все сломалось!' ) === false)
          {
              return $tmpPage;
          }
          else
          {
              return $this->goToPage( $url );
          }
     }

    public function sendPostData($url,$data,$rt = 0)	 
    {
        $this->checkSettings();
	$post_data = http_build_query($data);
        
        if(BOT_DEBUG)
            echo "POST: ".$url."\n";

	curl_setopt($this->ch,CURLOPT_URL,$this->main_url.$url);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->ch,CURLOPT_USERAGENT,$this->browser);
	curl_setopt($this->ch,CURLOPT_FOLLOWLOCATION,true);
	curl_setopt($this->ch,CURLOPT_POST,true);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS,$post_data);
	curl_setopt($this->ch,CURLOPT_COOKIEJAR,$this->cookies_path);
	curl_setopt($this->ch,CURLOPT_COOKIEFILE,$this->cookies_path);
        curl_setopt($this->ch,CURLOPT_CONNECTTIMEOUT, 15);
	if(strlen($this->intf) > 0)
        {
           curl_setopt($this->ch,CURLOPT_INTERFACE,$this->intf);
        }
        
        $tmpPage = curl_exec($this->ch);
        
        if(ENABLE_ANTI_CAPTCHA)
          {
              if(strpos( $tmpPage , 'showCaptcha' ))
              {
                $cName = $this->__saveCaptcha();
              
                /* Decode captcha */
                $this->__decodeCaptcha( $cName );
                return $this->goToPage($url);
              }
          }
          
          if(strpos( $tmpPage , 'А-а-а-а-а-а!!! Все сломалось!' ) === false)
          {
              return $rt ? $tmpPage : null;
          }
          else
          {
              return $this->sendPostData($url , $data , $rt);
          }
    }
    
    public function saveCaptcha( $url , $captchaPath )
    {
        if(BOT_DEBUG)
            echo "SAVE: ".$url."\n";
        
        curl_setopt($this->ch,CURLOPT_URL,$this->main_url.$url);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->ch,CURLOPT_USERAGENT,$this->browser);
	curl_setopt($this->ch,CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($this->ch,CURLOPT_COOKIEJAR,$this->cookies_path);
	curl_setopt($this->ch,CURLOPT_COOKIEFILE,$this->cookies_path);
        curl_setopt($this->ch,CURLOPT_CONNECTTIMEOUT, 15);
        if(strlen($this->intf) > 0)
        {
           curl_setopt($this->ch,CURLOPT_INTERFACE,$this->intf);
        }
        
        $rawData = curl_exec( $this->ch );
        
        if(strpos( $rawData , 'А-а-а-а-а-а!!! Все сломалось!' ) !== false)
          {
              $rawData = $this->saveCaptcha($url, $captchaPath);
          }
        
        $f = fopen( $captchaPath , 'w+' );
        fwrite($f , $rawData);
        fclose( $f );
    }
    
    private function __saveCaptcha()
    {
        $captchaUrl = 'captcha/'.rand(1000, 99999).'/';
        $savePath = CAPTCHA_PIC_PATH.md5($captchaUrl.time()).'.png';
        $this->saveCaptcha( $captchaUrl , $savePath );
         return $savePath;
    }
    
    private function __decodeCaptcha( $path )
    {
        global $antiCaptcha;
        $code = $antiCaptcha->decodeCaptcha( $path );
        $this->sendPostData( 'captcha/' , array( 'action' => 'check_captcha' , 'code' => $code ) );
    }
    
    public function getRequestInfo()
    {
        return curl_getinfo($this->ch);
    }
}

?>
