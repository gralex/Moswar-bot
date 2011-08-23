<?php
/* Moswar bot
 * Author: x00bit (x00bit@gmail.com)
 */
error_reporting (E_ALL | E_STRICT);
ini_set("display_errors", 1); 

define("BOT_DEBUG" , 0);

include('botCore/cUrlClass.php');
include('botCore/simple_html_dom.php');
include('botCore/moswarUtils.class.php');
include('botCore/moswarBot.class.php');
include('botCore/moswarInfo.class.php');
include('botCore/moswarWar.class.php');
include('botCore/moswarMetro.class.php');
include('botCore/moswarLife.class.php');
include('botCore/moswarShop.class.php');
include('botCore/moswarFactory.class.php');
include('botCore/moswarPolice.class.php');
include('botCore/moswarAutomobile.class.php');

$html = new simple_html_dom;

$wb = new cUrlClass;
$wb->setCookiesPath( '' );
$wb->setInterface( '' );
$wb->setMainUrl( '' );
