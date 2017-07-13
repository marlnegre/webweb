<?php
namespace AppBundle\Util\Source;

class SourceOrder{
    
    public function getMeals()
    {
        return [
    ['id' => '1', 'meal_name' => 'burger with fries', 'price' => 2],
    ['id' => '2', 'meal_name' => 'grilled chicken with mashed potato', 'price' => 4],
    ['id' => '3', 'meal_name' => 'spaghetti with meatballs', 'price' => 2.50],
    ['id' => '4', 'meal_name' => 'chicken potato salad', 'price' => 3],
    ['id' => '5', 'meal_name' => 'green salad', 'price' => 2]
        ];
    }
    
    public function getOrders()
    {
        return [
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
    }
}
