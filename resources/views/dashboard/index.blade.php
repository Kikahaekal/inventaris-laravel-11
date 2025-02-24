@extends('dashboard.layout')

@section('content')
@if(session('success_login'))
<script>
    Swal.fire({
        title: "Sucess!",
        text: "{{ session('success_login') }}",
        icon: "success"
    });
</script>
@endif

<h1>Welcome, {{ Auth::user()->name }}!!!</h1>
<p class="fs-5 mt-2">Let's check out what you've got here.</p>
<div class="row">
    @include('components.dashboard.card', [
        "card_title" => "Total Items",
        "card_subtitle" => "Information about total items",
        "card_text" => "Total Items",
        "card_value" => $total_items
    ])
    @include('components.dashboard.card', [
        "card_title" => "Total Categories",
        "card_subtitle" => "Information about total categories",
        "card_text" => "Total Categories",
        "card_value" => $total_category
    ])
    @include('components.dashboard.card', [
        "card_title" => "Total Transactions",
        "card_subtitle" => "Information about total transactions",
        "card_text" => "Total Transactions",
        "card_value" => $total_transaction
    ])
    @php
        $formatted_profit = number_format($profit, 2, ',', '.');
    @endphp
    @include('components.dashboard.card', [
        "card_title" => "Profit",
        "card_subtitle" => "All transactions amount that you get",
        "card_text" => "Total Amount",
        "card_value" => "Rp $formatted_profit",
    ])
    @include('components.dashboard.card', [
        "card_title" => "Selled Item",
        "card_subtitle" => "Total of all the items you have sold",
        "card_text" => "Total Amount",
        "card_value" => $selled_item
    ])
</div>
@endsection