<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            [
                'name' => 'India',
                'slug' => 'india',
                'children' => [
                    [
                        'name' => 'Maharashtra',
                        'slug' => 'maharashtra',
                        'children' => [
                            ['name' => 'Mumbai', 'slug' => 'mumbai'],
                            ['name' => 'Pune', 'slug' => 'pune'],
                        ],
                    ],
                    [
                        'name' => 'Delhi',
                        'slug' => 'delhi',
                        'children' => [
                            ['name' => 'New Delhi', 'slug' => 'new-delhi'],
                            ['name' => 'Gurgaon', 'slug' => 'gurgaon'],
                        ],
                    ],
                ],
            ],
            // Add more locations as needed
        ];

        $this->createLocations($locations);
    }

    private function createLocations($locations, $parentId = null)
    {
        foreach ($locations as $locationData) {
            $children = $locationData['children'] ?? [];
            unset($locationData['children']);

            $location = Location::create(array_merge($locationData, [
                'parent_id' => $parentId,
            ]));

            if (!empty($children)) {
                $this->createLocations($children, $location->id);
            }
        }
    }
}
