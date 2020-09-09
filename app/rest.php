<?php

include_once("autoload.php");

$app = new Application('/app/routes.php');
$app->start();


