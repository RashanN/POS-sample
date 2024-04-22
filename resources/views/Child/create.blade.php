@extends('layouts.land')

@section('content')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Create Customer</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<style>
    /* Additional custom styles */
    .container {
        margin-top: 50px;
    }
</style>
<div class="container">
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Child</div>

                <div class="card-body">
                    <form method="POST" action="{{route('child.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="parent_id">Parent Name:</label>
                            <select class="form-control" id="parent_id" name="parent_id" required>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Child Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>

                        <div class="form-group">
                            <label for="profile_image">Profile Image:</label>
                            <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
