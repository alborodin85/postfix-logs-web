<?php

namespace App\Http\Controllers;

use App\Models\ModelArchiveEmail;
use App\Models\ModelArchiveListItem;
use App\Models\ModelArchiveLogRow;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArchiveLogsApiController extends Controller
{
    public function getLastArchive(): Response
    {
        /** @var ModelArchiveListItem $lastArchive */
        $lastArchive = ModelArchiveListItem::orderByDesc('id')->first();

        if ($lastArchive) {
            $lastArchiveFileName = $lastArchive->fileName;
        } else {
            $lastArchiveFileName = '';
        }

        return ApiResponse::buildApiResponse($lastArchiveFileName);
    }

    public function addArchivesNames(Request $request): Response
    {
        $archivesNames = $request->get('archivesNames', []);

        $archivesNames = array_map(fn(string $fileName) => ['fileName' => $fileName], $archivesNames);

        foreach ($archivesNames as $fileName) {
            ModelArchiveListItem::create($fileName);
        }

        return ApiResponse::buildApiResponse();
    }

    public function addArchiveEmails(Request $request): Response
    {
        $records = $request->get('records', '');

        foreach($records as $recordArray) {
            unset($recordArray['id']);
            ModelArchiveEmail::create($recordArray);
        }

        return ApiResponse::buildApiResponse();
    }

    public function addArchiveLogRows(Request $request): Response
    {
        $records = $request->get('records', '');

        foreach($records as $recordArray) {
            unset($recordArray['id']);
            ModelArchiveLogRow::create($recordArray);
        }

        return ApiResponse::buildApiResponse();
    }
}
