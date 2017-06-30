<?php
namespace Renderrer;
use Dompdf\Dompdf;
use Renderrer\HTML;
use Source\SourceOrder;

class PDF extends HTML implements TableInterface {

    public function __construct(SourceOrder $source)
    {
        $this->meals = $source->getMeals();
        $this->orders = $source->getOrders();
    }

    public function render()
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->getHTML());
        $dompdf->render();
        $dompdf->stream();
        $dompdf->setPaper('A4', 'landscape');
    }
}
