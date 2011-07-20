<?php 

include('moswarBot.php');

$m = new moswarBot;
$m->setCookiesPath( '/tmp/cookies.txt' );
$m->setMainUrl( 'http://www.moswar.ru/' );
$m->setLoginData( '' , '' );

if(!$m->isLoged())
        $m->loginToMoswar();

$a = new moswarAttack;
$a->attackByType( 'weak' , 10,11 );