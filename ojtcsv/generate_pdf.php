<?php

require_once("vendor/autoload.php");

$source = new Source\SourceOrder;
$render = new Renderrer\PDF($source);
$controller = new Controllers\OrderTable($render);
$controller->showTable();
