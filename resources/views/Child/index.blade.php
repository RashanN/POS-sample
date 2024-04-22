@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Children List</div>

                <div class="card-body">
                    <a href="{{ route('children.create') }}" class="btn btn-primary mb-3">Add New Child</a>

                    {{-- @if ($children->isEmpty())
                        <p>No children found.</p>
                    @else --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Parent Name</th>
                                    <th>Date of Birth</th>
                                    <th>Profile Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($children as $child)
                                    <tr>
                                        <td>{{ $child->parent->name }}</td>
                                        <td>{{ $child->dob }}</td>
                                        <td>
                                            @if ($child->profile_image)
                                                <img src="{{ asset('storage/' . $child->profile_image) }}" alt="Profile Image" style="max-width: 100px;">
                                            @else
                                                No image
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('children.edit', $child->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <!-- Add delete button and form here -->
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
