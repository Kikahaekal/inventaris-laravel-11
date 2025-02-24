<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Buyed Item</th>
        <th>Buyer Name</th>
        <th>Transaction Amount</th>
        <th>Action</th>
    </tr>
    @forelse ($transactions as $item)
    @foreach ($item->transactions as $transaction)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>

        <td>{{ $transaction->buyer_name }}</td>
        <td>Rp {{ number_format($transaction->transaction_amount, 2, ',', '.') }}</td>
        <td class="d-flex justify-content-center gap-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#editModal{{ $transaction->id }}">
                <i class="fa-solid fa-pencil"></i>
            </button>
            <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal"
                data-bs-target="#detailModal{{ $transaction->id }}">
                <i class="fa-solid fa-eye"></i>
            </button>
            <form action="/transactions/{{ $transaction->id }}" method="post">
                @method('DELETE')
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                <button class="btn btn-danger">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </td>

        <div class="modal fade" id="detailModal{{ $transaction->id }}" tabindex="-1"
            aria-labelledby="detailModalLabel{{ $transaction->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="detailModalLabel{{ $transaction->id }}">Detail Transaction</h1>
                    </div>
                    <div class="modal-body">
                        <code>Note: Transaction amount not updated immediately even if the price is changed because this is transaction history</code>
                        <div class="mt-2">
                            <p>Buyed item: {{ $item->name }}</p>
                            <p>Buyer Name: {{ $transaction->buyer_name }}</p>
                            <p>Buy Amount: {{ $transaction->buy_amount }}</p>
                            <p>Transaction Amount: {{ $transaction->transaction_amount }}</p>
                            <p>Transaction Detail: {{ $transaction->transaction_detail }}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal{{ $transaction->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $transaction->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel{{ $transaction->id }}">Edit Transaction</h1>
                    </div>
                    <form action="/transactions/{{ $transaction->id }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <label for="buy_amount">Buy Amount</label>
                            <input type="number" name="buy_amount" id="buy_amount" class="form-control mb-2"
                                value="{{ $transaction->buy_amount }}">
                            <label for="buyer_name">Buyer Name</label>
                            <input type="text" name="buyer_name" id="buyer_name" class="form-control mb-2"
                                value="{{ $transaction->buyer_name }}">
                            <label for="transaction_detail">Transaction Detail</label>
                            <textarea name="transaction_detail" id="transaction_detail" cols="30"
                                class="form-control mb-2" rows="3">{{ $transaction->transaction_detail }}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </tr>
    @endforeach
    @empty
    <td colspan="5" class="text-center">No data</td>
    @endforelse
</table>