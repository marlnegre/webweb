<?php
namespace Controllers;
use Renderrer\TableInterface;

class OrderTable {
    protected $table;
    
    public function __construct(TableInterface $table)
    {
        $this->table = $table;
    }
    
    public function showTable()
    {
        echo $this->table->render();
    }

    public static function getDownloadLinks()
    {
        echo '<a href="./generate_pdf.php" style="margin-right: 10px;">Download PDF</a>';
        echo '<a href="./generate_csv.php" style="margin-right: 10px;">Download CSV</a>';
    }
}
