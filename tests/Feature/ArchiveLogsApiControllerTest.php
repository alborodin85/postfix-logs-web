<?php

use App\Models\ModelArchiveListItem;
use App\Services\ApiResponse;
use Tests\TestCase;

class ArchiveLogsApiControllerTest extends TestCase
{
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
