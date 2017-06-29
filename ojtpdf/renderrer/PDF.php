<?php
namespace Renderrer;
use Dompdf\Dompdf;
use Renderrer\HTML;
use Source\SourceOrder;

class PDF implements TableInterface {

    public function render()
    {
        $html = new HTML();
        $source = new SourceOrder();
        $html->setMeals($source->getMeals());
        $html->setOrders($source->getOrders());
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html->getHTML());
        $dompdf->render();
        $dompdf->stream();
        $dompdf->setPaper('A4', 'landscape');
    }
}
