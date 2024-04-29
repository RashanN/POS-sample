@extends('layouts.land')

@section('content')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Edit Child</title>
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
    <h1>Edit Child</h1>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('child.update', $child->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Child Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $child->name }}" required>
        </div>

        <div class="form-group">
            <label for="customer_name">Parent Name:</label>
            <select class="form-control" id="customer_id" name="customer_id" required>
                <option value="">Select Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $customer->id == $child->customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ $child->DOB }}" required>
        </div>

        <div class="form-group">
            <label for="school">School:</label>
            <input type="text" class="form-control" id="school" name="school" value="{{ $child->school }}">
        </div>
        <div class="form-group">
            <label for="relationship">Relationship to Parent:</label>
            <input type="text" class="form-control" id="relationship" name="relationship" value="{{$child->relationship}}">
        </div>

        <div class="form-group">
            <label for="profile_image">Profile Image:</label>
            <input type="file" class="form-control-file" id="profile_image" name="profile_image">
            @if ($child->profile_image)
                <img src="{{ asset('image/' . $child->profile_image) }}" alt="Profile Image" style="max-width: 100px;">
            @else
                <p>No image available</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

</div>
@endsection
