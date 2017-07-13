<?php

namespace AppBundle\Util\Order;

use AppBundle\Data\Orders;

class Calculator
{
    public function calculateTotals(Orders $orders)
    {
        $list   = $orders->getOrders();
        $meals  = $orders->getMealsById();
        $totals = [];
        foreach ($list as $index => $order) {
            foreach ($order as $meal_id => $meal_count) {
                if (! isset($totals[$meal_id])) {
                    $totals[$meal_id] = 0; 
                }
                $price = $meal_count * $meals[$meal_id]['price'];
                $totals[$meal_id] += $price; 
            }
        }

        $max_min = $this->getMaxMin($totals);

        return [
            'totals' => $totals,
            'max_min' => $max_min,
        ];
    }

    public function getMaxMin(array $totals)
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
