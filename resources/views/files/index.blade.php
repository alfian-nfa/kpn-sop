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
            <h2 class="mb-4">E-Forms</h2>
            @if ($uploadFile)
                <a class="btn btn-success mb-3" href="{{ route('files.create') }}">Upload New File</a>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-auto me-2">
                  <div class="input-group mb-3">
                        <span class="input-group-text" id="customsearch-addon"><i class="ri-search-line"></i></span>
                        <input type="text" name="customsearch" id="customsearch" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="customsearch-addon">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group mb-3">
                        <select name="category" id="category" class="form-select">
                            <option value="">- Select Category -</option>
                            @foreach ($fileCategories as $fileCategory)
                                <option value="{{ $fileCategory }}" {{ old('category') == $fileCategory ? 'selected' : '' }}>{{ $fileCategory }}</option>
                            @endforeach
                        </select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                                <table id="fileTable" class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>File Name</th>
                                        <th>Category</th>
                                        <th>Size</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $file->name }}
                                                @if ($file->description)
                                                    <span class="d-inline-block" data-bs-id="{{ $file->id }}" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-trigger="hover focus" data-bs-content="{{ $file->description }}">
                                                        <i class="ri-information-2-line"></i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $file->category }}</td>
                                            <td><p class="mb-0">{{ number_format($file->file_size / 1048576, 2) }} MB</p></td>
                                            <td class="text-center">
                                                <a href="{{ asset('storage/app/public/' . $file->file_path) }}" class="btn btn-sm btn-primary"><i class="ri-download-line"></i><span class="d-none d-md-inline ms-1">Download</span></a>
                                                @if ($file->created_by === Auth::user()->id)
                                                    <form id="{{ $file->id }}" class="d-inline" action="{{ route('files.delete', $file->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a href="#" data-form-id="{{ $file->id }}" class="btn btn-sm btn-danger delete-button">
                                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                        <i class="ri-delete-bin-line"></i>
                                                        <span class="d-none d-md-inline ms-1">Delete</span>
                                                    </a>
                                                    
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
    </div>
</div>
@vite(['resources/js/app.js'])
</body>
</html>
