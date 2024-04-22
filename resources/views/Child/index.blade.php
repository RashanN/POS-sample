@extends('layouts.land')

@section('content')
    <div class="container">
        <h1>All Children</h1>
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Parent Name</th>
                    <th scope="col">Child Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Profile Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($children as $child)
                    <tr>
                        <td>{{ $child->id }}</td>
                        <td></td>
                        <td>{{ $child->name }}</td>
                        <td>{{ $child->DOB }}</td>
                        <td>
                            @if ($child->profile_image)
                                <img src="{{ asset('image/' . $child->profile_image) }}" alt="Profile Image" style="max-width: 100px;">
                            @else
                                No Image
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
