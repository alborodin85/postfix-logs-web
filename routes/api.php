<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::any('/return-response', function (Request $request) {
    if ($request->get('throwEmpty')) {
        return \response('');
    } elseif ($request->get('throwHtml')) {
        return \response('<!DOCTYPE html><html lang="en"><head><title>Title</title></head></html>');
    }

    $payload = $request->all();

    $content = [
        'payload' => $payload,
        'errorCode' => 0,
        'errorModule' => '',
        'errorText' => '',
    ];

    return \response(json_encode($content, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES))->header('content-type', 'application/json');
});
