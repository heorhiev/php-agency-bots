<?php

namespace app\common\services\googleSheets;

use app\common\services\Service;


class UpdateService extends Service
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

    public function upload($spreadsheetId, $listName, array $rows)
    {
        $valueRange = new \Google_Service_Sheets_ValueRange();
        $valueRange->setValues(array_values($rows));
        $options = ['valueInputOption' => 'USER_ENTERED'];

        return $this->_sheetService->spreadsheets_values->append($spreadsheetId, $listName, $valueRange, $options);
    }
}