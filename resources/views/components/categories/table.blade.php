@if(session('success_edit'))
<script>
    Swal.fire({
        title: "Sucess!",
        text: "{{ session('success_edit') }}",
        icon: "success"
    });
</script>
@endif
@if(session('success_delete'))
<script>
    Swal.fire({
        title: "Sucess!",
        text: "{{ session('success_delete') }}",
        icon: "success"
    });
</script>
@endif
<table class="table table-responsive table-bordered">
    <thead>
        <tr class="text-center">
            <th class="w-number">No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $key => $item)
            <tr class="text-center">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <form action="/categories/{{ $item->id }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Edit Categories</h1>
                        </div>
                        <form action="/categories/{{ $item->id }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <tr>
                <td colspan="3" class="text-center">No data</td>
            </tr>
        @endforelse
    </tbody>
</table>
