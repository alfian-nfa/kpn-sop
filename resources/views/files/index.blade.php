<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Management</title>
    <link rel="icon" type="image/ico" href="{{ asset('storage/app/public/img/favicon.ico') }}" />
    @vite(['resources/css/app.css'])
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-4">E-SOP</h2>
            @if ($uploadFile)
                <a class="btn btn-success mb-3" href="{{ route('files.create') }}">Upload New File</a>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table id="sopTable" class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>File Name</th>
                            <th>Size</th>
                            <th>Description</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $file->name }}</td>
                                <td><p class="mb-0">{{ number_format($file->file_size / 1048576, 2) }} MB</p></td>
                                <td>{{ $file->description }}</td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/app/public/' . $file->file_path) }}" class="btn btn-primary"><i class="fa fa-download"></i><span class="d-none d-md-inline ms-1">Download</span></a>
                                    @if ($file->created_by === Auth::user()->id)
                                        <form id="delete-form-{{ $file->id }}" class="d-inline" action="{{ route('files.delete', $file->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="javascript:void(0)" onclick="deleteFile('delete-form-{{ $file->id }}');" class="btn btn-danger me-1"><span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span><i class="fa fa-trash-can"></i><span class="d-none d-md-inline ms-1">Delete</span></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@vite(['resources/js/app.js'])
</body>
</html>
