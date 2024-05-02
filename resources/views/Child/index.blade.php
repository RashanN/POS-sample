<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    @include('layouts.navigation1')

    <!DOCTYPE html>
    <html lang="en">
    <head>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>All Products</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<style>
    /* Additional custom styles */
    .container {
        margin-top: 50px;

    }
</style>
    </head>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>All Childern</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('child.create') }}" class="btn btn-success">Add New Child</a>
        </div>
    </div>
        <table class="table">
            <thead>
                <tr>

                    <th scope="col">Parent Name</th>
                    <th scope="col">Relationship to Parent</th>
                    <th scope="col">Child Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">School</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($children as $child)
                    <tr>

                        <td>{{ $child->customer->name }}</td>
                        <td>{{$child->relationship}}</td>
                        <td>{{ $child->name }}</td>
                        <td>{{ $child->DOB }}</td>
                        <td>{{ $child->school ?: 'N/A' }}</td>
                       
                        <td>
                            <a href="{{ route('child.edit', $child->id) }}" class="btn btn-primary">Edit</a> <!-- Edit button -->
                            <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button> <!-- Delete button -->
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
