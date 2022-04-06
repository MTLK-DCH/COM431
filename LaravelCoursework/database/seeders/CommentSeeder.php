<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();
  
            $report = fopen(base_path("database/data/Comment Bank.csv"), "r");
    
            $dataRow = true;
            while (($data = fgetcsv($report, 4000, ",")) !== FALSE) {
                if (!$dataRow) {
                    Comment::create([
                        "comment_id" => $data['0'],
                        "kind" => ($data['0'][0]. $data['0'][1]),
                        "text" => $data['1'],
                        "forename" => $data['2'],
                        "surname" => $data['3'],
                        "email" => $data['4'],
                        "validated" => $data['5'],
                        "style" => 0,
                    ]);    
                }
                $dataRow = false;
            }
   
        fclose($report);
    }
    
}
