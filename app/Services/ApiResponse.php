<?php

namespace App\Services;

use Illuminate\Http\Response;

class ApiResponse
{
    public string $payload;
    public int $errorCode;
    public string $errorModule;
    public string $errorText;

    public function __construct(string $jsonResponse)
    {
        $arResponse = json_decode($jsonResponse, true);

        $errorMessage = 'получен некорректный json-response';
        if (!is_array($arResponse)) {
            abort(500, $errorMessage);
        }

        $responseFields = ['payload', 'errorCode', 'errorModule', 'errorText'];

        if (array_keys($arResponse) != $responseFields) {
            abort(500, $errorMessage);
        }

        $this->payload = $arResponse['payload'];
        $this->errorCode = $arResponse['errorCode'];
        $this->errorModule = $arResponse['errorModule'];
        $this->errorText = $arResponse['errorText'];
    }

    public static function buildApiResponse(
        mixed $payload = '', int $errorCode = 0, string $errorModule = '', string $errorText = ''
    ): Response {

        $content = [
            'payload' => $payload,
            'errorCode' => $errorCode,
            'errorModule' => $errorModule,
            'errorText' => $errorText,
        ];

        $encodedContent = json_encode($content, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

        return \response($encodedContent)->header('content-type', 'application/json');
    }
}
