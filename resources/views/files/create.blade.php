<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <link rel="icon" type="image/ico" href="{{ asset('storage/app/public/img/favicon.ico') }}" />
    @vite(['resources/css/app.css'])
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div class="col-md-6 align-self-center">
                <h2 class="mb-4">Upload File</h2>
                <a class="btn btn-warning mb-3" href="{{ route('files.index') }}">Back</a>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 align-self-center">
                    <div class="card">
                        <form id="submitForm" action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <input type="hidden" class="form-control" id="groupCompany" name="groupCompany" value="{{ $data->group_company }}" readonly>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Choose File</label>
                                    <input type="file" class="form-control" id="file" name="file" accept="application/pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fileName" class="form-label">File Name</label>
                                    <input type="text" class="form-control" id="fileName" name="fileName" placeholder="Enter File name.." value="{{ old('fileName') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">File Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description.." value="{{ old('description') }}" required></textarea>
                                </div>
                            </div>
                        </form>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" id="submitButton" class="btn btn-primary"><span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>Save</button>
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
