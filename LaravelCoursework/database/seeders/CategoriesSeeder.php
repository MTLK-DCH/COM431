<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Categories::truncate();
  
            $report = fopen(base_path("database/data/Categories.csv"), "r");
    
            $dataRow = true;
            while (($data = fgetcsv($report, 4000, ",")) !== FALSE) {
                if ($dataRow) {
                    Categories::create([
                        "abbr" => $data['0'],
                        "fullname" => ($data['1']),
                        
                    ]);    
                }
                $dataRow = true;
            }
   
        fclose($report);
    }
}
