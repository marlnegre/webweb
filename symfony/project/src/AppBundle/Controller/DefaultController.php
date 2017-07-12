<?php

namespace AppBundle\Controller;

use AppBundle\Util\DisplayTable;
use AppBundle\Util\DomPdf;
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
     * @Route("/test", name="testpage")
     */
    public function testAction(Request $request)
    {
        $dom_pdf = new DomPdf();
        $result  = $dom_pdf->printPdf();

        // replace this example code with whatever you need
        return $this->render(
            'AppBundle::default/test.html.twig',
            [
                'result' => $result,
            ]
        );

    }

    /**
     * @Route("/test2", name="test2page")
     */
    public function test2Action(Request $request)
    {
        // replace this example code with whatever you need
        $display = new DisplayTable();
        $result = $display->printTable();
        return $this->render(
            'AppBundle::default/test2.html.twig',
            [
                'result' => $result,
            ]
        );

    }
}
