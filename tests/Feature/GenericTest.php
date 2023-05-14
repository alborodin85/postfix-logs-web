<?php

use App\Services\ApiResponse;
use Tests\TestCase;

class GenericTest extends TestCase
{
    public function testScheduler()
    {
        $this->artisan('schedule:run')->assertExitCode(0);
    }

    public function testMigrations()
    {
        $this->artisan('migrate:rollback')->assertExitCode(0);
        $this->artisan('migrate --seed')->assertExitCode(0);
    }

    public function testInspire()
    {
        $this->artisan('inspire')->assertExitCode(0);
    }

    public function testReturnResponse()
    {
        $requestData = [
            'endpoint_api_token' => config('auth.endpoint_api_token'),
            'parameterName' => 'parameterValue'
        ];
        $response = $this->post(route('returnResponse'), $requestData);
        $response->assertOk();
        $responseObject = new ApiResponse($response->content());
        $result = json_decode($responseObject->payload, true);
        $this->assertEquals($requestData, $result);

        $requestData = [
            'endpoint_api_token' => config('auth.endpoint_api_token'),
            'throwEmpty' => true
        ];
        $response = $this->post(route('returnResponse'), $requestData);
        $response->assertStatus(204);
        $this->assertEquals('', $response->content());

        $requestData = [
            'endpoint_api_token' => config('auth.endpoint_api_token'),
            'throwHtml' => true
        ];
        $response = $this->post(route('returnResponse'), $requestData);
        $response->assertStatus(200);
        $expected = '<!DOCTYPE html><html lang="en"><head><title>Title</title></head></html>';
        $this->assertEquals($expected, $response->content());
    }
}
