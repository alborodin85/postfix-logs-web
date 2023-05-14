<?php
/**
 * @var array<\App\Models\ModelCurrentLogRow> $logRows
 * @var string $title
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
?>
@extends('layouts.base')

@section('title', $title)

@section('main')
    <h2>{{ $title }}</h2>
    <table>
        <tr>
            <th>Дата/время</th>
            <th>Модуль</th>
            <th>ID процесса</th>
            <th>ID очереди</th>
            <th>Error Level</th>
            <th>Сообщение</th>
        </tr>
        @foreach($logRows as $record)
            <tr>
                <td>{{ $record->dateTime }}</td>
                <td>{{ $record->module }}</td>
                <td>{{ $record->procId }}</td>
                <td>{{ $record->queueId }}</td>
                <td>{{ $record->errorLevel }}</td>
                <td>{{ $record->rowText }}</td>
            </tr>
        @endforeach
    </table>
    {{ $logRows->links() }}
@endsection('main')
