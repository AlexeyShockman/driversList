<?php

require_once('vendor/autoload.php');

class NewClass
{
   public function resultsOfTheDay($fileLocation)
    {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($fileLocation);

        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $row = 8;
        $drivers = [];

        while ($row <= $highestRow) {
            $cellFio = str_ireplace(" (Водитель)", "", $worksheet->getCellByColumnAndRow(1, $row)->getValue());;
            $cellSum = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
            if ($cellFio == 'Итого') break;
            $drivers[] = array("fio" => $cellFio, 'sum' => $cellSum);
            ++$row;

        }
        return $drivers;
    }
}



