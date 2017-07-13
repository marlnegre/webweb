<?php 

namespace AppBundle\Util\PDF;

use AppBundle\Util\Order\IFileRenderer;
use Dompdf\Dompdf;

class PDFRenderer implements IFileRenderer
{
    public function render($content)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($content);
        $dompdf->render();
        $dompdf->stream();
        $dompdf->setPaper('A4', 'landscape');
    }    
}
