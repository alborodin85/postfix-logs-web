<?php

namespace App\Http\Controllers;

use App\Models\ModelCurrentEmail;
use App\Models\ModelCurrentLogRow;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurrentLogApiController
{
    public function clearCurrentEmails(): Response
    {
        ModelCurrentEmail::truncate();

        return ApiResponse::buildApiResponse();
    }

    public function clearCurrentLogRows(): Response
    {
        ModelCurrentLogRow::truncate();

        return ApiResponse::buildApiResponse();
    }

    public function addCurrentEmails(Request $request): Response
    {
        $records = $request->get('records', '');

        if (!$records) {
            return ApiResponse::buildApiResponse();
        }

        foreach($records as $recordArray) {
            unset($recordArray['id']);
            ModelCurrentEmail::create($recordArray);
        }

        return ApiResponse::buildApiResponse();
    }

    public function addCurrentLogRows(Request $request): Response
    {
        $records = $request->get('records', '');

        if (!$records) {
            return ApiResponse::buildApiResponse();
        }

        foreach($records as $recordArray) {
            unset($recordArray['id']);
            ModelCurrentLogRow::create($recordArray);
        }

        return ApiResponse::buildApiResponse();
    }
}
