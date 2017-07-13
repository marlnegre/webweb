<?php

namespace AppBundle\Controller;

use AppBundle\Data\Orders;
use AppBundle\Util\Order\Calculator;
use AppBundle\Util\CSV\processCSV;
use AppBundle\Util\PDF\PDFRenderer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle::default/index.html.twig');
    } 
     /**
     * @Route("/orders", name="orderspage")
     */
    public function orderTableAction(Request $request)
    {
        $orders = new Orders(); 
        $calculator = new Calculator();
        $totals = $calculator->calculateTotals($orders);

        // replace this example code with whatever you need
        return $this->render(
            'AppBundle::default/orders.html.twig',
            [
                'meals' => $orders->getMeals(),
                'orders' => $orders->getOrders(),
                'totals' => $totals['totals'],
                'max_min' => $totals['max_min'],
            ]
        );
    }

    /**
     * @Route("/orders/pdf", name="generateOrdersPDF")
     */
    public function ordersPdfAction(Request $request)
    {
        $pdf_renderer = new PDFRenderer();

        $this->get('orders.file_renderer')->render($pdf_renderer);
    }

    /**
     * @Route("/orders/csv", name="generateOrderCSV")
     */
   public function generateCSVAction(Request $request)
    {
        $order = new Orders();
        $generate = new processCSV($order);
        $generate->render(); 
        
        
        // replace this example code with whatever you need
        return $this->render('AppBundle::default/order_csv.html.twig'); 
    }
    

}
