
@extends('layouts.land')

@section('content')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Create Product</title>
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Playtime Prices</div>
                <div class="card-body">
                    <a href="{{ route('playtimeprices.create') }}" class="btn btn-primary mb-3">Create New Playtime Price</a>

                    @if ($playtimePrices->isEmpty())
                        <p>No playtime prices found.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($playtimePrices as $playtimePrice)
                                    <tr>
                                        <td>{{ $playtimePrice->name }}</td>
                                        <td>{{ $playtimePrice->price }}</td>
                                        <td>
                                            <a href="{{ route('playtimeprices.update', $playtimePrice->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <!-- Add delete button and form here -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
