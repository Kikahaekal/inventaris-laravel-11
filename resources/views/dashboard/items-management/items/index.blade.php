@extends('dashboard.layout')

@section('content')
    @include('components.dashboard.im-header', [
        "im_title" => "Items"
    ])
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="AddModalLabel">Add Item</h1>
                </div>
                <form action="/items" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control mb-2">
                        <label for="cost">Cost</label>
                        <input type="number" name="cost" id="cost" class="form-control mb-2">
                        <label for="categoriesAddModal">Categories</label>
                        <select name="categories[]" class="form-control" id="categoriesAddModal" multiple>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('components.items.table')
@endsection