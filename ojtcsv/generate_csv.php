<?php

require_once("vendor/autoload.php");

$source = new Source\SourceOrder;
$render = new Renderrer\CSV($source);
$controller = new Controllers\OrderTable($render);
$controller->showTable();
