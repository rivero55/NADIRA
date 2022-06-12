<?php

namespace Database\Seeders;

use App\Models\ReportCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertData("Covid 19","/web_files/category/1619931180.png");
        $this->insertData("Kebakaran","/web_files/category/1619373875.png");
        $this->insertData("Vandalisme","/web_files/category/1619373967.png");
        $this->insertData("Banjir","/web_files/category/1619373099.png");
        $this->insertData("Keamanan","/web_files/category/1619372587.png");
        $this->insertData("Fasilitas Publik","/web_files/category/1619931774.png");
        $this->insertData("Kebersihan","/web_files/category/1619931921.png");
        $this->insertData("Kerusakan Jalan","/web_files/category/1619935896.png");
        $this->insertData("Pendidikan","/web_files/category/1619936044.png");
        $this->insertData("Pertamanan","/web_files/category/1619936054.png");
        $this->insertData("Kendaraan Umum","/web_files/category/1619931851.png");
    }

    function insertData($category_name,$photo_path){
        $data = new ReportCategory();
        $data->category_name = $category_name;
        $data->photo_path = $photo_path;
        $data->save();
    }


}
