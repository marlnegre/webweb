<?php

namespace AppBundle\Util;

class DisplayTable
{
    public function printTable()
    {
        $meals = [
            ['id' => '1', 'meal_name' => 'burger with fries', 'price' => 2],
            ['id' => '2', 'meal_name' => 'grilled chicken with mashed potato', 'price' => 4],
            ['id' => '3', 'meal_name' => 'spaghetti with meatballs', 'price' => 2.50],
            ['id' => '4', 'meal_name' => 'chicken potato salad', 'price' => 3],
            ['id' => '5', 'meal_name' => 'green salad', 'price' => 2]
        ];

        $orders = [
            [
                '1' => 2,
                '2' => 4,
            ],
            [
                '1' => 3,
                '4' => 1,
            ],
            [
                '1' => 1,
                '2' => 1,
                '4' => 1,
            ],
            [
                '3' => 1,
                '4' => 2,
                '5' => 3,
            ],
            [
                '3' => 2,
                '4' => 1,
            ],
            [
                '1' => 1,
                '2' => 2,
                '3' => 1,
            ],
            [
                '1' => 1,
            ],
        ];

        $header = '<th>Orders</th>';
        $new_meals = [];
        $total = [];
        foreach ($meals as $meal) {
            $header .= "<th>{$meal['meal_name']}</th>";   
            $new_meals[$meal['id']] = $meal; 
            $total[$meal['id']] = 0;
        }
        $rows = '';
        foreach ($orders as $index => $order) {
            $cols = '';
            foreach ($new_meals as $meal_id => $meal) {
                $qty = isset($order[$meal_id]) ? $order[$meal_id] : 0;
                $cols .= "<td>{$qty}</td>";
                $total[$meal_id] += $qty * $meal['price']; 
            }
            $order_val = $index+1;
            $rows .= "
                <tr>
                    <td>{$order_val}</td>       
                    {$cols}
                </tr>
            ";
        }

        $sumrow = '';
        $max_min = $this->getMaxMin($total);
        foreach($total as $key => $total_price) {

            $background = 'none';
            if ($total_price == $max_min['max']) {
                $background = 'green';
            }
            else if ($total_price == $max_min['min']) {
                $background = 'red';
            }
            $sumrow .= "<td style=\"background-color:{$background};\">{$total_price}</td>";
        }

        $table = "
        <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">
        <table class=\"table table-striped\">

            <thead>
                <tr>
                    {$header}
                </tr> 
            </thead>
            <tbody>
                {$rows}
                <tr>
                    <td>Total Earned Amount</td>
                    {$sumrow}
                </tr>
            </tbody>
        </table>"; 

        echo $table;
    }

    public function getMaxMin (array $totals)
        {
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
