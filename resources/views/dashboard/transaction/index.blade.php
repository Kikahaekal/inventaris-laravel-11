@extends('dashboard.layout')

@section('content')
@include('components.dashboard.im-header', [
    "im_title" => "Transactions"
])
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddModalLabel">Add Transactions</h1>
            </div>
            <form action="/transactions" method="post">
                @csrf
                <div class="modal-body">
                    <label for="item">Buyed Item</label>
                    <select name="item" id="item" class="form-control mb-2">
                        <option hidden></option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <label for="buy_amount">Buy Amount</label>
                    <input type="number" name="buy_amount" id="buy_amount" class="form-control mb-2">
                    <label for="buyer_name">Buyer Name</label>
                    <input type="text" name="buyer_name" id="buyer_name" class="form-control mb-2">
                    <label for="transaction_detail">Transaction Detail</label>
                    <textarea name="transaction_detail" id="transaction_detail" cols="30" class="form-control mb-2" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
    @include('components.transactions.table')
@endsection