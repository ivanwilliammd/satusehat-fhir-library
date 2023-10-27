<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Satusehat\Integration\Models\Icd10;

class Icd10Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Icd10::truncate();

        $csvFile = fopen(database_path("/seeders/csv/icd10.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                Icd10::create([
                    "icd10_code" => $data['0'],
                    "icd10_en" => $data['1'],
                    "icd10_id" => $data['2']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
