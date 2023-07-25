<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <form action="{{ route('admin.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" type="password" name="password"/>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" />
                        </div>
                        <div class="col-6">
                            <label for="password_confirmation">Role</label>
                            <select name="roles" id="" class="form-control">
                                <option value="">--Select Role--</option>
                                @foreach ($allRole as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-info mt-3">Register</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <caption>All Admin</caption>
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allAdmin as $key => $admin)
                        <tr>
                            <th>{{ $key+1 }}</th>
                            <th>{{ $admin->name }}</th>
                            <th>{{ $admin->email }}</th>
                            <th>
                                @foreach ($admin->roles as $role)
                                <span class="badge bg-info">{{ $role->name }}</span>
                                @endforeach
                            </th>
                            <th>
                                <a href="{{ route('admin.edit', $admin->id) }}">Edit</a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Email</th>
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

    </script>

</body>
</html>
