<?php

namespace app\common\services\googleSheets;

use app\common\services\Service;


class UploadService extends Service
{
    private $_client;
    private $_sheet;


    public function __construct(string $appName, string $credentialsPath)
    {
        $this->_client = new \Google_Client();
        $this->_client->setApplicationName($appName);
        $this->_client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $this->_client->setAccessType('offline');
        $this->_client->setAuthConfig($credentialsPath);

        $this->_sheetService = new \Google_Service_Sheets($this->_client);
    }


    public function save(string $spreadsheetId, string $listName, array $rows)
    {
        $currentIds = array_flip(array_column($this->getRows($spreadsheetId, $listName), 0));
        $newIds = array_flip(array_column($rows, 0));

        foreach ($newIds as $newId => $key) {
            if (isset($currentIds[$newId])) {
                $rowNumber = $currentIds[$newId] + 1;
                $this->update($spreadsheetId, $listName, $rowNumber, $rows[$key]);

                unset($rows[$key]);
            }
        }

        if ($rows) {
            $this->add($spreadsheetId, $listName, $rows);
        }

        return true;
    }


    public function add(string $spreadsheetId, string $listName, array $rows)
    {
        $valueRange = new \Google_Service_Sheets_ValueRange();
        $valueRange->setValues(array_values($rows));
        $options = ['valueInputOption' => 'USER_ENTERED'];

        return $this->_sheetService->spreadsheets_values->append($spreadsheetId, $listName, $valueRange, $options);
    }


    public function update(string $spreadsheetId, string $listName, $number, array $row)
    {
        $rows = [$row];
        $valueRange = new \Google_Service_Sheets_ValueRange();
        $valueRange->setValues($rows);
        $range = $listName . '!A' . $number;
        $options = ['valueInputOption' => 'USER_ENTERED'];
        $this->_sheetService->spreadsheets_values->update($spreadsheetId, $range, $valueRange, $options);
    }


    public function getRows(string $spreadsheetId, string $listName): array
    {
        $response = $this->_sheetService->spreadsheets_values->get($spreadsheetId, $listName);
        return $response->getValues();
    }
}