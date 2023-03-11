<?php /** @var \App\Models\Bb $bb */ ?>
@extends('layouts.base')

@section('title', 'Удаление объявления :: Мои объявления')

@section('main')
    <h2>{{ $bb->title }}</h2>
    <p>{{ $bb->content }}</p>
    <p>{{ $bb->price }} руб.</p>
    <p>Автор: {{ $bb->user->name }}</p>
    <form action="{{ route('bb.destroy', ['bb' => $bb->id]) }}" method="post">
        @csrf
        @method('delete')
        <input type="submit" class="btn btn-danger" value="Удалить">
        <a href="{{ route('home') }}" class="btn btn-secondary ml-3">Назад</a>
    </form>
@endsection('main')
