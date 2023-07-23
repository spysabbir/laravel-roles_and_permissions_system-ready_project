<form action="{{ route('permission.store') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Permission Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Permission Name">
    </div>
    <div class="mb-3">
        <label for="group_name" class="form-label">Permission Group Name</label>
        <input type="text" class="form-control" name="group_name" id="group_name" placeholder="Permission Group Name">
    </div>
    <button type="submit">Store</button>
</form>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-light">
            <caption>Permissions Table</caption>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Group Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->group_name }}</td>
                    <td>Action</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>

            </tfoot>
    </table>
</div>
