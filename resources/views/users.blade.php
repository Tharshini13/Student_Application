<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .heading{
            text-align:center;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 heading">Student Application</h5>
                <a href="/add/user" class="btn btn-light btn-sm">+ Add New</a>
            </div>
            <div class="card-body">
 
                <table class="table table-hover table-bordered mt-3">
                    <thead class="table-primary">
                        <tr>
                            <th>id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Gender</th>
                            <th>Course</th>
                            <th>File Upload</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($all_users) > 0)
                            @foreach ($all_users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->gender}}</td>
                                    <td>{{ $item->course}}</td>
                                    <td>
                                    @if($item->profile_picture)
                                        <a href="{{ asset('storage/' . $item->profile_picture) }}" download>Download File</a>
                                    @else
                                        No File Uploaded
                                    @endif
                                    </td>
                                    <td>
                                        <a href="/edit/{{ $item->id }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="/delete/{{ $item->id }}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No User Found!</td>
                            </tr>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Logout</button>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
