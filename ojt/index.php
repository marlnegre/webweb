<?php

require_once("vendor/autoload.php");

$source = new Source\SourceOrder;
$render = new Renderrer\HTML;

$render->setMeals($source->getMeals());
$render->setOrders($source->getOrders());
$render->orderTable();
