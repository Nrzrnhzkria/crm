<?php

/***********************************************
;"Hery PHP Framework (HPF) v3";
;"Designed and Developed at Min September 2018";
;"Intelligent Hosting Pte. Ltd. (1158583-U)";
;"Master Hery (iamhery.com)";
************************************************/

define("HFA", true);
define("NONE_HTTP", true);
require_once((__DIR__) . "/HPFv3.2/init.php");



$app = new App("MIMS Chat Server", "mims_chat_server");
$app->run();

?>