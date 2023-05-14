<?php

use App\Services\ApiResponse;

class ApiResponseTest extends \Tests\TestCase
{
    public function testApiResponseCreate()
    {
        $responseArray = [
            'payload' => 'payload', 'errorCode' => 10, 'errorModule' => 'errorModule', 'errorText' => 'errorText'
        ];
        $responseJson = json_encode($responseArray);
        $apiResponse = new ApiResponse($responseJson);
        $this->assertEquals($responseArray, $apiResponse->toArray());
    }

    public function testEmptyJson()
    {
        $this->expectException(\Exception::class);
        new ApiResponse('');
    }

    public function testIncompleteResponse()
    {
        $responseArray = [
            'errorCode' => 10, 'errorModule' => 'errorModule', 'errorText' => 'errorText'
        ];
        $responseJson = json_encode($responseArray);
        $this->expectException(\Exception::class);
        new ApiResponse($responseJson);
    }

    public function testNonStringPayload()
    {
        $responseArray = [
            'payload' => ['payload'], 'errorCode' => 10, 'errorModule' => 'errorModule', 'errorText' => 'errorText'
        ];
        $responseJson = json_encode($responseArray);
        $apiResponse = new ApiResponse($responseJson);
        $result = $apiResponse->toArray();
        $result['payload'] = json_decode($result['payload'], true);
        $this->assertEquals($responseArray, $result);
    }
}
