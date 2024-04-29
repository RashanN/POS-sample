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
                                    <label for="" class="col-md-4 col-form-label text-md-right">Customer</label>
                                    <div class="col-md-6">
                                        <select id="customer_id" class="form-control" name="customer_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                        <a href="{{ route('customer.create') }}" class="btn btn-success">+</a>

                                </div>
                                <div class="form-group row justify-content-center">

                                    <a href="#" id="conformButton" class="btn btn-success">Conform</a>


                                </div>
                                <div id="textBoxContainer"></div>

                                <div class="form-group row justify-content-center">
                                    <div class="col-sm">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" style="border: 1px solid #ced4da;" placeholder="RFID" id="RFID">
                                            </div>
                                            <div class="col">
                                                <select class="form-control" id="childNames" class="childNames">

                                                </select>

                                            </div>
                                            <div class="col">
                                                <select class="form-control" id="pricerange" class="pricerange">
                                                    <option value="">Select Range</option>
                                            @foreach ($priceranges as $pricerange)
                                                <option value="{{ $pricerange->id }}">{{ $pricerange->name }}</option>
                                            @endforeach
                                                </select>
                                            </div>

                                            <div class="col">
                                                <a href="#" id="addBtn" class="btn btn-success">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            {{-- <!-- In Time -->
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
                            </div> --}}

                            <!-- Playtime Price -->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <h3>Playtime Price</h3>
                                    <table id="playtime-table" class="table">
                                        <!-- Table header -->
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Child Name</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Played Time </th>
                                                <th>Amount</th>

                                            </tr>
                                        </thead>
                                        <!-- Table body (data should come from controller) -->
                                        <tbody id="PlaytimeBody">
                                            {{-- <tr id="time-row">
                                                <td id="date"></td>
                                                <td id="child-name">-</td>
                                                <td id="start-time">-</td>
                                                <td id="end-time">-</td>
                                                <td id="played-time">-</td>
                                                <td id="amount">-</td>



                                            </tr> --}}
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

    var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;
        // document.getElementById('date').innerText = today;



//     document.addEventListener('DOMContentLoaded', function () {
//     var generateBtn = document.querySelector('.generate-btn');
//     generateBtn.addEventListener('click', function (event) {
//         event.preventDefault(); // Prevent the default action of the anchor tag

//         const customerId = document.getElementById('customer_id').value;
//         const inTime = document.getElementById('intime').value;
//         var playedTime = document.getElementById('played-time').innerText.trim();


//         var routeUrl = "{{ url('/invoice/generate/') }}" + '/' + playedTime  + '/' + customerId + '/' + inTime;
//         window.location.href = routeUrl;
//     });
// });

    document.getElementById("conformButton").addEventListener("click", function() {
        var customerId = document.getElementById("customer_id").value;


        fetch("{{ route('fetch.children') }}?customerId=" + customerId)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                renderChildFields(data);
            })
            .catch(error => console.error('Error:', error));
    });

        function renderChildFields(children) {

        var childNamesSelect = document.getElementById("childNames");
        childNamesSelect.innerHTML = ""; // Clear previous content

    children.forEach(child => {
        // Create an option element for each child and append it to the select element
        var option = document.createElement("option");
        option.value = child.id; // Assuming 'id' is the ID of the child
        option.textContent = child.name; // Assuming 'name' is the name of the child
        childNamesSelect.appendChild(option);
        });
    }

    document.getElementById('addBtn').addEventListener('click', function(event) {
            event.preventDefault();

            var rfid = document.getElementById('RFID').value;
             console.log('dsdsd',rfid);
             var childName = document.getElementById('childNames').value;
              console.log('SDSD',childName);
              var pricerange= document.getElementById('pricerange').value;
          console.log('hghg',pricerange);

            $.ajax({
            url: '{{ route('get-time') }}',
            method: 'GET',
            data: {
                rfid: rfid,
                childName: childName,
                pricerange: pricerange
            },
            beforeSend: function () {
                // Show loader if needed
            },
            success: function (data) {
                console.log(data);
                 updateTable(data);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                // Hide loader if needed
            }
        });
        });

        function updateTable(data) {
    var childData = data.child;
    console.log(childData);

    var tableBody = document.getElementById('PlaytimeBody');
    var row = tableBody.insertRow();

    row.innerHTML = `
        <td class="font_color row_padding">${today}</td>
        <td class="font_color row_padding" >${childData.name}</td>
        <td class="font_color row_padding">${data.intime.intime}</td>
        <td class="font_color row_padding">${data.outtime.outtime}</td>
        <td class="font_color row_padding">${data.outtime.outtime - data.intime.intime}</td>
        <td class="font_color row_padding">${data.rfid}</td>

    `;

}

document.addEventListener('DOMContentLoaded', function() {
    var generateBtn = document.querySelector('.generate-btn');
    if (generateBtn) {
        generateBtn.addEventListener('click', function(event) {
            event.preventDefault();

            // Gather data from the table
            var tableRows = document.querySelectorAll('#PlaytimeBody tr');
            var rowData = [];
            tableRows.forEach(function(row) {
                var today = row.cells[0].textContent.trim();
                var childName = row.cells[1].textContent.trim();
                var rfid = row.cells[2].textContent.trim();

                console.log('Row data:', { today: today, childName: childName, rfid: rfid }); // Log each row's data

                rowData.push({ today: today, childName: childName, rfid: rfid });
            });

            console.log('Data to be sent:', rowData); // Log the data to be sent

            // Send data to the controller via AJAX
            $.ajax({
                url: '{{ route('playTimeOrder') }}', // Route name for Laravel
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: { data: JSON.stringify(rowData) },
                beforeSend: function() {
                    // Show loader or perform any pre-AJAX actions
                },
                success: function(response) {
                    console.log('Server response:', response);
                    // Perform any actions after successful data submission
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', error);
                    console.log('Server response:', xhr.responseText); // Log the server response
                    // Handle error if needed
                },
                complete: function() {
                    // Hide loader or perform any post-AJAX actions
                }
            });
        });
    }
});

    /////////////////http://127.0.0.1:8000/invoice/generate/1h%2056m/2/11:52

    </script>

@endsection
