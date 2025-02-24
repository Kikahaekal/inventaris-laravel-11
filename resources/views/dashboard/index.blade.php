@extends('dashboard.layout')

@section('content')
<h1>Welcome, {{ Auth::user()->name }}!!!</h1>
<p class="fs-5 mt-2">Let's check out what you've got here.</p>
<div class="row">
    @include('components.dashboard.card', [
        "card_title" => "Total Items",
        "card_subtitle" => "Information about total items",
        "card_text" => "Total Items: 0"
    ])
    @include('components.dashboard.card', [
        "card_title" => "Total Categories",
        "card_subtitle" => "Information about total categories",
        "card_text" => "Total Categories: 0"
    ])
    @include('components.dashboard.card', [
        "card_title" => "Total Transactions",
        "card_subtitle" => "Information about total transactions",
        "card_text" => "Total Transactions: 0"
    ])
</div>
@endsection