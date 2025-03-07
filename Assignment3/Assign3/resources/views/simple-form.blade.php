<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8e1f5; 
        }
        .container {
            border: 1px solid #e91e63; 
            border-radius: 10px;
        }
        h1 {
            color: #d81b60;
        }
        .form-label {
            color: #ad1457;
        }
        .btn-primary {
            background-color: #e91e63;
            border: none;
        }
        .btn-primary:hover {
            background-color: #d81b60;
        }
        .input-group-text {
            background-color: #f8e1f5;
            border: 1px solid #e91e63; 
        }
    </style>
</head>
<body>

    <div class="container py-5 bg-white p-4 rounded shadow-sm">
        <div class="text-center mb-4">
            <h1>Personal Information</h1>
            <p class="text-muted">Please fill out the form below</p>
        </div>
        
        <hr>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('simple-form') }}" method="POST">
            @csrf

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="FirstName" class="form-label">First Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" name="FirstName" id="FirstName" value="{{ old('FirstName') }}">
                    </div>
                    @error('FirstName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="LastName" class="form-label">Last Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" name="LastName" id="Lastname" value="{{ old('LastName') }}">
                    </div>
                    @error('LastName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Sex</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" value="male" {{ old('sex') == 'male' ? 'checked' : '' }}>
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" value="female" {{ old('sex') == 'female' ? 'checked' : '' }}>
                        <label class="form-check-label">Female</label>
                    </div>
                </div>
                @error('sex')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="MobilePhone" class="form-label">Mobile Phone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                        <input type="text" class="form-control" name="MobilePhone" id="MobilePhone" value="{{ old('MobilePhone') }}">
                    </div>
                    @error('MobilePhone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="TelNo" class="form-label">Tel No.</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                        <input type="text" class="form-control" name="TelNo" id="TelNo" value="{{ old('TelNo') }}">
                    </div>
                    @error('TelNo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="Birthdate" class="form-label">Birth Date</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-fill"></i></span>
                        <input type="date" class="form-control" name="Birthdate" id="Birthdate" value="{{ old('Birthdate') }}">
                    </div>
                    @error('Birthdate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="Address" class="form-label">Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-house-fill"></i></span>
                        <input type="text" class="form-control" name="Address" id="Address" value="{{ old('Address') }}">
                    </div>
                    @error('Address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="Email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control" name="Email" id="Email" value="{{ old('Email') }}">
                    </div>
                    @error('Email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="Website" class="form-label">Website</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-globe"></i></span>
                        <input type="text" class="form-control" name="Website" id="Website" value="{{ old('Website') }}">
                    </div>
                    @error('Website')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</body>
</html>