<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Shop;

class ShopSeeder extends Seeder
{

    public function readCSV(string $filename) {
        $headers = null;
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($headers === null) {
                    $headers = $data;
                } else {
                    $row = array_combine($headers, $data);
                    yield $row;
                }
            }
            fclose($handle);
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void {
        foreach(
            $this->readCSV(__DIR__ . '/../../negozi_casuali.csv') as $row) {
                Shop::create($row);
            }
    }
}
