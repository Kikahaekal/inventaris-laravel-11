<table class="table table-bordered">
    <tr class="text-center">
        <th class="w-number">No</th>
        <th>Name</th>
        <th>Cost</th>
        <th>Stock</th>
        <th>Category</th>
        <th>Action</th>
    </tr>
    @forelse ($items as $item)
        <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>Rp {{ number_format($item->cost, 2, ',', '.') }}</td>
            <td>{{ $item->stock }}</td>
            <td>
                {{ implode(', ', $item->categories->pluck('name')->toArray()) }}
            </td>
            <td class="d-flex justify-content-center gap-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                    <i class="fa-solid fa-pencil"></i>
                </button>
                <form action="/items/{{ $item->id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>

            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Edit Categories</h1>
                        </div>
                        <form action="/items/{{ $item->id }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control mb-2" value="{{ $item->name }}">
                                <label for="cost">Cost</label>
                                <input type="number" name="cost" id="cost" class="form-control mb-2" value="{{ $item->cost }}">
                                <label for="stock">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control mb-2" value="{{ $item->stock }}">
                                <label for="categoriesAddModal">Categories</label>
                                <select name="categories[]" class="form-control" id="categoriesEditModal" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ in_array($category->id, $item->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $category->name }}</option>
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
        </tr>
    @empty
        <td colspan="6" class="text-center">No data</td>
    @endforelse
</table>