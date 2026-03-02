<?php

namespace App\Services;

class DefaultCategoryService
{
    public function createForColocation($colocation)
    {
        $defaultCategories = [
            'Rent',
            'Electricity',
            'Water',
            'Internet',
            'Groceries',
        ];

        foreach ($defaultCategories as $category) {
            $colocation->categories()->create([
                'name' => $category,
            ]);
        }
    }
}
