<?php 

include('moswarBot.php');

$m = new moswarBot;
$m->setCookiesPath( '/tmp/cookies.txt' );
$m->setMainUrl( 'http://www.moswar.ru/' );
$m->setLoginData( '' , '' );

if(!$m->isLoged())
        $m->loginToMoswar();

echo $m->goToPage('');