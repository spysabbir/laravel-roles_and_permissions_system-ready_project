<form action="{{ route('role.store') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Role Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Role Name">
    </div>
    <button type="submit">Store</button>
</form>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-light">
            <caption>Role Table</caption>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $role->name }}</td>
                    <td>Action</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>

            </tfoot>
    </table>
</div>
