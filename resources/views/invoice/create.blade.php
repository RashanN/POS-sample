@extends('layouts.land')

@section('content')
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


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Invoice</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf

                            <!-- Customer ID -->
                            <div class="form-group row">
                                <label for="customer_id" class="col-md-4 col-form-label text-md-right">Customer</label>
                                <div class="col-md-6">
                                    <select id="customer_id" class="form-control" name="customer_id" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- In Time -->
                            <div class="form-group row">
                                <label for="intime" class="col-md-4 col-form-label text-md-right">In Time</label>
                                <div class="col-md-6">
                                    <input id="intime" type="time" class="form-control" name="intime" required>
                                </div>
                            </div>

                            <!-- Out Time -->
                            <div class="form-group row">
                                <label for="outtime" class="col-md-4 col-form-label text-md-right">Out Time</label>
                                <div class="col-md-6">
                                    <input id="outtime" type="time" class="form-control" name="outtime"  required>
                                </div>
                            </div>

                            <!-- Playtime Price -->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <h3>Playtime Price</h3>
                                    <table id="playtime-table" class="table">
                                        <!-- Table header -->
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Played Time </th>

                                            </tr>
                                        </thead>
                                        <!-- Table body (data should come from controller) -->
                                        <tbody>
                                            <tr id="time-row">
                                                <td id="date"></td>
                                                <td id="start-time">-</td>
                                                <td id="end-time">-</td>
                                                <td id="played-time">-</td>



                                            </tr>
                                        </tbody>
                                    </table>
                                       <a href="" class="btn btn-success generate-btn">Generate</a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <script>
        document.getElementById('intime').addEventListener('change', function() {
            var inputTime = this.value;
            document.getElementById('start-time').innerText = inputTime;
        });
        document.getElementById('outtime').addEventListener('change', function() {
        var outputTime = this.value;
        document.getElementById('end-time').innerText = outputTime;
        updatePlayedTime();
        });
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;
        document.getElementById('date').innerText = today;
        function updatePlayedTime() {
        var startTimeStr = document.getElementById('start-time').innerText;
        var endTimeStr = document.getElementById('end-time').innerText;
        if (startTimeStr !== '-' && endTimeStr !== '-') {
            var startTime = new Date("2022-01-01T" + startTimeStr);
            var endTime = new Date("2022-01-01T" + endTimeStr);
            var timeDiff = endTime - startTime;
            if (timeDiff >= 0) {
                var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                document.getElementById('played-time').innerText = hours + 'h ' + minutes + 'm';
            } else {
                document.getElementById('played-time').innerText = 'Invalid Time';
            }
        } else {
            document.getElementById('played-time').innerText = '-';
        }
    }
    ///////////////////
    // document.addEventListener('DOMContentLoaded', function() {
    //     var generateButtons = document.querySelectorAll('.generate-btn');
    //     generateButtons.forEach(function(button) {
    //         button.addEventListener('click', function(event) {
    //             // Log a message to verify that the button click event is being captured
    //             var playedTime = this.parentElement.previousElementSibling.innerText;

    //             // Update the href attribute of the link with the calculated played time
    //             this.href = this.href.split('?')[0] + '?played_time=' + encodeURIComponent(playedTime);

    //             console.log('Button clicked');
    //         });
    //     });
    // });


        document.addEventListener('DOMContentLoaded', function () {
            var generateButton = document.querySelector('.generate-btn');
            generateButton.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default link behavior

                // Get the value of played-time
                var playedTime = document.getElementById('played-time').innerText.trim();

                // Construct the URL with the played_time parameter
                var url = "{{ route('invoice.generate', ['played_time' => ':playedTime']) }}";
                url = url.replace(':playedTime', playedTime);
                console.log(url);
                // Redirect to the generated URL
                window.location.href = url;
            });
        });

    /////////////////

    </script>

@endsection
