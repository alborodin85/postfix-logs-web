<?php

namespace App\Http\Controllers;

use App\Models\ModelArchiveListItem;
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

        return ApiResponse::buildApiResponse('');
    }
}
