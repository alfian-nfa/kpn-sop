<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-4">File Management (SOP)</h2>
            @if ($uploadFile)
                <a class="btn btn-success mb-3" href="{{ route('files.create') }}">Upload New File</a>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>File Name</th>
                    <th>Size</th>
                    <th>Description</th>
                    <th>Action</th>
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
                            <a href="{{ asset('storage/' . $file->file_path) }}" class="btn btn-primary">Download</a>
                            @if ($file->created_by === Auth::user()->id)
                                <form id="delete-form-{{ $file->id }}" class="d-inline" action="{{ route('files.delete', $file->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
