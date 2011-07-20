<?php
/* Moswar bot
 * Author: x00bit (x00bit@gmail.com)
 */
error_reporting (E_ALL | E_STRICT);
ini_set("display_errors", 1); 

include('./botCore/cUrlClass.php');
include('./botCore/simple_html_dom.php');
include('./botCore/moswarUtils.class.php');
include('./botCore/moswarBot.class.php');

$html = new simple_html_dom;