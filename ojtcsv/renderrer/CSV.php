<?php
namespace Renderrer;
use Source\SourceOrder;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class CSV implements TableInterface{

    protected $meals;
    protected $orders;    

    public function __construct(SourceOrder $source)
    {
        $this->meals = $source->getMeals();
        $this->orders = $source->getOrders();
    }

    public function render()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $total = [];
        $new_meals = [];
        $row_list = ['B','C','D','E','F','G','H'];
        $sheet->setCellValue('A1','Orders');
        foreach ($this->meals as $index =>  $meal) {
            $sheet->setCellValue($row_list[$index].'1',$meal['meal_name']);
            $new_meals[$meal['id']] = $meal;
            $total[$meal['id']] = 0;

        }
        $last_row = 1;
        foreach ($this->orders as $index => $order) {

            $sheet->setCellValue('A'.($index+2),$index+1);
            $num_col = 0;
            foreach ($new_meals as $meal_id => $meal) {
                $qty = isset($order[$meal_id]) ? $order[$meal_id] : 0;
                $sheet->setCellValue($row_list[$num_col].($index+2),$qty);
                $total[$meal_id] += $qty * $meal['price'];
                $num_col++;
            }
            $last_row++;
        }
        $sheet->setCellValue("A{$last_row}",'Total'); 

        $max_min = $this->getMaxMin($total);
        $col_num = 0;
        foreach($new_meals as $meal_id => $meal) {
            $background = 'ffffff';
            if ($total[$meal_id] == $max_min['max']) {
                $background = '19aa2c';
            }
            else if ($total[$meal_id] == $max_min['min']) {
                $background = 'e50b0b';
            }

            $sheet->getStyle(($row_list[$col_num]).($last_row))->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB($background);
            $sheet->setCellValue("{$row_list[$col_num]}{$last_row}",$total[$meal_id]);
            $col_num++;
        }
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="file.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    protected function getMaxMin(array $totals){
        $max_min = ['max' => 0, 'min' => 0];
        $i = 0;
        foreach($totals as $total){

            if($i == 0){
                $max_min['max'] = $total;
                $max_min['min'] = $total;
            }  
            else{
                if($total > $max_min['max']){
                    $max_min['max'] = $total;
                }

                if($total < $max_min['min']){
                    $max_min['min'] = $total;
                }
            }
            $i++;
        }

        return $max_min;
    }


}
