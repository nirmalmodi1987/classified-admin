<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Vehicles',
                'slug' => 'vehicles',
                'icon' => 'fas fa-car',
                'children' => [
                    ['name' => 'Cars', 'slug' => 'cars', 'icon' => 'fas fa-car-side'],
                    ['name' => 'Motorcycles', 'slug' => 'motorcycles', 'icon' => 'fas fa-motorcycle'],
                    ['name' => 'Auto Parts', 'slug' => 'auto-parts', 'icon' => 'fas fa-cog'],
                ],
            ],
            [
                'name' => 'Property',
                'slug' => 'property',
                'icon' => 'fas fa-home',
                'children' => [
                    ['name' => 'Apartments', 'slug' => 'apartments'],
                    ['name' => 'Houses', 'slug' => 'houses'],
                    ['name' => 'Land', 'slug' => 'land'],
                ],
            ],
            // Add more categories as needed
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);
            
            $category = Category::create($categoryData);
            
            foreach ($children as $childData) {
                Category::create(array_merge($childData, [
                    'parent_id' => $category->id,
                    'icon' => $childData['icon'] ?? $category->icon,
                ]));
            }
        }
    }
}