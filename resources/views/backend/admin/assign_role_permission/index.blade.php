<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .form-check{
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('assign.role.permission.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="PermissionAll">
                              <label class="form-check-label" for="PermissionAll">
                                Permission All
                              </label>
                            </div>
                        </div>
                    </div>
                    <hr>

                    @foreach ($permission_groups as $group)
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="PermissionGroup">
                                    <label class="form-check-label" for="PermissionGroup">
                                        {{ $group->group_name }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            @php
                            $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                            @endphp
                            @foreach ($permissions as $permission)
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission_id[]" value="{{ $permission->id }}" id="permission_id{{ $permission->id }}">
                                    <label class="form-check-label" for="permission_id{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    <button class="btn btn-info" type="submit">Store</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <caption>Role And Permissions Table</caption>
                        <tr>
                            <th>Sl No</th>
                            <th>Role Name</th>
                            <th>Permissions Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <th>{{ $key+1 }}</th>
                            <th>{{ $role->name }}</th>
                            <th>
                                @foreach ($role->permissions as $permission)
                                <span class="badge bg-info">{{ $permission->name }}</span>
                                @endforeach
                            </th>
                            <th>
                                <a class="btn btn-info btn-sm" href="{{ route('edit.role.permission', $role->id) }}">Edit</a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl No</th>
                            <th>Role Name</th>
                            <th>Permissions Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        $('#PermissionAll').click(function () {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true);
            }else{
                $('input[type=checkbox]').prop('checked', false);
            }
        });
    </script>

</body>
</html>
