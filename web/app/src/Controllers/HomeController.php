<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class HomeController
{
    public const AMAUNT_MIN = 3001;
    public const AMAUNT_MAX = 6000;

    public function index()
    {
        ini_set('memory_limit', '1024M');
        set_time_limit(60);
//        $inputFileType = 'Xls';
        $inputFileType = 'Xlsx';

        $source = $_SERVER['DOCUMENT_ROOT'] . "/resources/word.docx";
        $inputFileName = $_SERVER['DOCUMENT_ROOT'] . "/resources/xlsx.xlsx";

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        $worksheet = $spreadsheet->getActiveSheet();
// Get the highest row and column numbers referenced in the worksheet
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

        $newXlsx = new Spreadsheet();
        $currRow = 1;

        for ($row = 1; $row <= $highestRow; ++$row) {
            $name = '';
            $address = '';
            $schet = '';
            $amount = '';
            $city = '';
            $onlyAddress = '';

            $value = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
            if ($row === 1 || (int) $value < $this::AMAUNT_MIN) {
                continue;
            }

            if ($row === 1 || (int) $value > $this::AMAUNT_MAX) {
                continue;
            }

            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();

                if ($col === 2) {
                    $address .= mb_substr($value, 0, 1) . '. ';
                    $city .= mb_substr($value, 0, 1) . '. ';
                }

                if ($col === 3) {
                    $city .= $value . ', ';
                }

                if ($col === 4) {
                    $onlyAddress .= $value . ' ';
                }

                if ($col === 5) {
                    $onlyAddress .= $value;
                }

                if ($col === 6 && !empty($value)) {
                    $onlyAddress .= ' буд.' . (int)$value;
                }

                if ($col === 7 && !empty($value)) {
                    $onlyAddress .= ' кв.' . (int)$value;
                }

                if ($col === 8) {
                    $schet = $value;
                }

                if ($col === 9 && !empty($value)) {
                    $name = $value;
                }

                if ($col === 10 && !empty($value)) {
                    $name .= ' ' . $value;
                }

                if ($col === 11 && !empty($value)) {
                    $name .= ' ' . $value;
                }

                if ($col === 12) {
                    $amount = $value;
                }
            }
//dd($address, $onlyAddress);
            if (!empty($amount)) {
                // готовим в xlsx
                $newXlsx->getActiveSheet()->setCellValue('A' . $currRow,
                $name . PHP_EOL .
                    $onlyAddress . PHP_EOL .
                    $city . PHP_EOL .
                    'Луганської області,' . PHP_EOL .
                    'інд.93408');

                // Создаём docx
                $templateProcessor = new TemplateProcessor($source);
                $templateProcessor->setValue('name', $name);
                $templateProcessor->setValue('address', $onlyAddress);
                $templateProcessor->setValue('city', $city);
                $templateProcessor->setValue('schet', $schet);
                $templateProcessor->setValue('amount', $amount);

                $templateProcessor->saveAs("result/" . $schet . ".docx");
            }
            
//dd('only one');
            $currRow++;
        }

        // Создаём xlsx
        $writer = new Xlsx($newXlsx);
	    $writer->save("result/" . 'address' . ".xlsx");

        echo 'end';
    }
}
