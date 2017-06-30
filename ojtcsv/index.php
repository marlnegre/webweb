<?php

require_once("vendor/autoload.php");

$source = new Source\SourceOrder;
$render = new Renderrer\HTML($source);
$controller = new Controllers\OrderTable($render);
$controller->showTable();
Controllers\OrderTable::getDownloadLinks();

//$pdf = new Renderrer\PDF;

//$render->setMeals($source->getMeals());
//$render->setOrders($source->getOrders());
//$render->render();
//$pdf->render();
