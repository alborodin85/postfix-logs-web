<?php

use App\Models\ModelArchiveEmail;
use App\Models\ModelArchiveListItem;
use App\Models\ModelArchiveLogRow;
use App\Services\ApiResponse;
use Tests\TestCase;

class ArchiveLogsApiControllerTest extends TestCase
{
    public function testAddArchiveLogRows()
    {
        $logRows = [];
        $requestData = [
            'records' => $logRows,
            'endpoint_api_token' => config('auth.endpoint_api_token'),
        ];
        $response = $this->post(route('addArchiveLogRows'), $requestData);
        $response->assertOk();
        $countModels = ModelArchiveLogRow::count();
        $this->assertEquals(0, $countModels);

        $logRows = array(
            array(
                'id' => '0',
                'dateTime' => '2023-03-31 19:03:03',
                'hostName' => 'mx',
                'module' => 'postfix/smtpd',
                'procId' => '481829',
                'queueId' => null,
                'errorLevel' => 'warning',
                'rowText' => 'dict_nis_init: NIS domain name not set - NIS lookups disabled',
            ),
            array(
                'id' => '0',
                'dateTime' => '2023-03-31 19:03:03',
                'hostName' => 'mx',
                'module' => 'postfix/smtpd',
                'procId' => '481829',
                'queueId' => null,
                'errorLevel' => null,
                'rowText' => 'connect from unknown[194.180.49.114]',
            ),
            array(
                'id' => '0',
                'dateTime' => '2023-03-31 19:03:03',
                'hostName' => 'mx',
                'module' => 'postfix/smtpd',
                'procId' => '481829',
                'queueId' => null,
                'errorLevel' => 'warning',
                'rowText' => 'connect to Milter service unix:/run/opendkim/opendkim.sock: No such file or directory',
            ),
            array(
                'id' => '0',
                'dateTime' => '2023-03-31 19:03:03',
                'hostName' => 'mx',
                'module' => 'postfix/smtpd',
                'procId' => '481829',
                'queueId' => null,
                'errorLevel' => null,
                'rowText' => 'disconnect from unknown[194.180.49.114] ehlo=1 quit=1 commands=2',
            ),
            array(
                'id' => '0',
                'dateTime' => '2023-03-31 19:03:35',
                'hostName' => 'mx',
                'module' => 'postfix/postfix-script',
                'procId' => '482191',
                'queueId' => null,
                'errorLevel' => 'fatal',
                'rowText' => 'the Postfix mail system is already running',
            ),
            array(
                'id' => '0',
                'dateTime' => '2023-03-31 19:06:23',
                'hostName' => 'mx',
                'module' => 'postfix/anvil',
                'procId' => '481796',
                'queueId' => null,
                'errorLevel' => 'statistics',
                'rowText' => 'max connection rate 1/60s for (smtp:178.154.239.146) at Mar 31 22:01:06',
            ),
            array(
                'id' => '0',
                'dateTime' => '2023-03-31 19:06:23',
                'hostName' => 'mx',
                'module' => 'postfix/anvil',
                'procId' => '481796',
                'queueId' => null,
                'errorLevel' => 'statistics',
                'rowText' => 'max connection count 1 for (smtp:178.154.239.146) at Mar 31 22:01:06',
            ),
            array(
                'id' => '0',
                'dateTime' => '2023-03-31 19:06:23',
                'hostName' => 'mx',
                'module' => 'postfix/anvil',
                'procId' => '481796',
                'queueId' => null,
                'errorLevel' => 'statistics',
                'rowText' => 'max cache size 1 at Mar 31 22:01:06',
            ),
        );

        $requestData = [
            'records' => $logRows,
            'endpoint_api_token' => config('auth.endpoint_api_token'),
        ];
        $response = $this->post(route('addArchiveLogRows'), $requestData);
        $response->assertOk();

        $logsRowsModels = ModelArchiveLogRow::get();
        for ($i = 0; $i < count($logRows); $i++) {
            $expectedLogsRowsArray = $logRows[$i];
            unset($expectedLogsRowsArray['id']);
            foreach ($expectedLogsRowsArray as $columnName => $columnValue) {
                $this->assertEquals($columnValue, $logsRowsModels[$i]->$columnName);
            }
        }

    }

    public function testAddArchiveEmails()
    {
        $emails = [];
        $requestData = [
            'records' => $emails,
            'endpoint_api_token' => config('auth.endpoint_api_token'),
        ];

        $response = $this->post(route('addArchiveEmails'), $requestData);
        $response->assertOk();
        $countModels = ModelArchiveEmail::count();
        $this->assertEquals(0, $countModels);

        $emails = [
            [
                'id' => '0',
                'dateTime' => '2023-04-01 21:00:04',
                'queueId' => '59A5212076E',
                'from' => 'root@own.it5.su',
                'to' => 'root@own.it5.su',
                'subject' => 'Cron <root@mx> /usr/sbin/logrotate /etc/logrotate.conf',
                'statusText' => 'mail for own.it5.su loops back to myself',
                'statusCode' => '0',
                'statusName' => 'bounced',
                'nonDeliveryNotificationId' => '8B681120773',
            ],
            [
                'id' => '0',
                'dateTime' => '2023-04-03 05:30:18',
                'queueId' => '284B112078D',
                'from' => 'dmarc_support@corp.mail.ru',
                'to' => 'all@ml.it5.su',
                'subject' => 'Report Domain: ml.it5.su; Submitter: Mail.Ru; Report-ID: 74120183223942353421680393600',
                'statusText' => 'delivered via dovecot service',
                'statusCode' => '0',
                'statusName' => 'sent',
                'nonDeliveryNotificationId' => null,
            ],
            [
                'id' => '0',
                'dateTime' => '2023-04-25 12:43:41',
                'queueId' => '0515612082F',
                'from' => 'adm24s-evp-d1@smtp.it5.su',
                'to' => 'all@ml.it5.su',
                'subject' => 'Приглашение в Admin24 (EVP)',
                'statusText' => 'delivered via dovecot service',
                'statusCode' => '0',
                'statusName' => 'sent',
                'nonDeliveryNotificationId' => null,
            ],
            [
                'id' => '0',
                'dateTime' => '2023-04-25 12:43:41',
                'queueId' => '0515612082F',
                'from' => null,
                'to' => null,
                'subject' => null,
                'statusText' => 'delivered via dovecot service',
                'statusCode' => '0',
                'statusName' => 'sent',
                'nonDeliveryNotificationId' => null,
            ],
        ];
        $requestData = [
            'records' => $emails,
            'endpoint_api_token' => config('auth.endpoint_api_token'),
        ];

        $response = $this->post(route('addArchiveEmails'), $requestData);
        $response->assertOk();

        $emailsModels = ModelArchiveEmail::get();
        for ($i = 0; $i < count($emails); $i++) {
            $expectedEmailArray = $emails[$i];
            unset($expectedEmailArray['id']);
            foreach ($expectedEmailArray as $columnName => $columnValue) {
                $this->assertEquals($columnValue, $emailsModels[$i]->$columnName);
            }
        }
    }

    public function testAddArchiveNames()
    {
        $archivesNames = [
            '/home/it5_dev/sites/postfix-logs/test-logs/postfix/postfix.log.20230401-000001.gz',
            '/home/it5_dev/sites/postfix-logs/test-logs/postfix/postfix.log.20230412-000001.gz',
            '/home/it5_dev/sites/postfix-logs/test-logs/postfix/postfix.log.20230504-000002.gz',
        ];
        $requestData = [
            'archivesNames' => $archivesNames,
        ];

        $response = $this->post(route('addArchivesNames'), $requestData);
        $response->assertStatus(401);
        $fileNamesModelsCount = ModelArchiveListItem::count();
        $this->assertEquals(0, $fileNamesModelsCount);

        $requestData['endpoint_api_token'] = 'not correct token';
        $response = $this->post(route('addArchivesNames'), $requestData);
        $response->assertStatus(401);
        $fileNamesModelsCount = ModelArchiveListItem::count();
        $this->assertEquals(0, $fileNamesModelsCount);

        $requestData['endpoint_api_token'] = config('auth.endpoint_api_token');
        $response = $this->post(route('addArchivesNames'), $requestData);
        $response->assertOk();

        $fileNamesModels = ModelArchiveListItem::get();
        $filesNames = $fileNamesModels->map(fn(ModelArchiveListItem $item) => $item->fileName);

        $this->assertEquals($archivesNames, $filesNames->toArray());
    }

    public function testGetLastArchive()
    {
        $response = $this->post(route('getLastArchive'));
        $response->assertStatus(401);

        $requestData = [
            'endpoint_api_token' => config('auth.endpoint_api_token'),
        ];

        $response = $this->post(route('getLastArchive'), $requestData);
        $responseObject = new ApiResponse($response->content());

        $this->assertEquals('', $responseObject->payload);

        $archivesNames = [
            '/home/it5_dev/sites/postfix-logs/test-logs/postfix/postfix.log.20230401-000001.gz',
            '/home/it5_dev/sites/postfix-logs/test-logs/postfix/postfix.log.20230412-000001.gz',
            '/home/it5_dev/sites/postfix-logs/test-logs/postfix/postfix.log.20230504-000002.gz',
        ];
        $requestData = [
            'endpoint_api_token' => config('auth.endpoint_api_token'),
            'archivesNames' => $archivesNames,
        ];
        $this->post(route('addArchivesNames'), $requestData);

        $requestData = [
            'endpoint_api_token' => config('auth.endpoint_api_token'),
        ];
        $response = $this->post(route('getLastArchive'), $requestData);
        $responseObject = new ApiResponse($response->content());

        $this->assertEquals(end($archivesNames), $responseObject->payload);
    }
}
