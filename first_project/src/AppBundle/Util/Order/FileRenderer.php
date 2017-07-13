<?php

namespace AppBundle\Util\Order;

use AppBundle\Data\Orders;
use AppBundle\Util\Order\Calculator;

class FileRenderer
{
    public function __construct($templating)
    {
        $this->templating = $templating;
    }

    public function render(IFileRenderer $renderer)
    {
        $orders = new Orders(); 
        $calculator = new Calculator();
        $totals = $calculator->calculateTotals($orders);

        // replace this example code with whatever you need
        $content = $this->templating->render(
            'AppBundle::default/orders_table.html.twig',
            [
                'meals' => $orders->getMeals(),
                'orders' => $orders->getOrders(),
                'totals' => $totals['totals'],
                'max_min' => $totals['max_min'],
            ]
        );

        $content = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dG    mJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">' . $content;

        $renderer->render($content);
    }
}
