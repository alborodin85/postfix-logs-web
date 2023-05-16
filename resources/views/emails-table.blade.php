<?php
/**
 * @var \App\Models\ModelCurrentEmail[] $emails
 * @var string $title
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
?>
@extends('layouts.base')

@section('title', $title)

@section('main')
    <div id="emails-table-wrapper">
        <h2>{{ $title }}</h2>
        <table>
            <tr>
                <th>Дата/Время</th>
                <th>ID очереди</th>
                <th>От</th>
                <th>Кому</th>
                <th>Тема</th>
                <th>Статус (Код)</th>
                <th>Доп. сообщение</th>
            </tr>
            @foreach($emails as $emailItem)
                <tr>
                    <td>{{ $emailItem->dateTime }}</td>
                    <td>{{ $emailItem->queueId }}</td>
                    <td>{{ $emailItem->from }}</td>
                    <td>{{ $emailItem->to }}</td>
                    <td>{{ $emailItem->subject }}</td>
                    <td>{{ $emailItem->statusText }} ({{ $emailItem->statusCode }} / {{ $emailItem->statusName }})</td>
                    <td>{{ $emailItem->nonDeliveryNotificationId }}</td>
                </tr>
            @endforeach
        </table>
        {{ $emails->links() }}
        <div id="counter">
            Счетчик: @{{ counter }}
        </div>
    </div>
    <script>
        const Counter = {
            data() {
                return {
                    counter: 0
                }
            },
            mounted() {
                setInterval(() => this.counter++, 500);
            }
        }

        Vue.createApp(Counter).mount('#emails-table-wrapper');
    </script>
@endsection('main')
