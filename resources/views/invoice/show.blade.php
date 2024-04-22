@extends('layouts.land')

@section('content')
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                <div class="card-header">Invoice Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Played Time Total:</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="played_time_total" value="{{ $amount }}.00" class="form-control" style="font-weight: 700" autofocus>
                        </div>
                    </div>
                    

                    <!-- Bought Products Table (Assuming some sample data) -->
                    <h3>Bought Products</h3>
                    <form id="addProductForm" method="POST" action="">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-md-4">
                                <select id="product" class="form-control" name="product" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" name="quantity" value="1" min="1">
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="addProductBtn" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                    
                    <table class="producttable">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <!-- Table body (sample data) -->
                        <tbody id="productTableBody">
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            document.getElementById('addProductBtn').addEventListener('click', function (event) {
                                event.preventDefault(); // Prevent default form submission
                                
                                var productId = document.getElementById('product').value;
                                console.log(productId);
                                var quantity = document.getElementsByName('quantity')[0].value;
                                console.log(quantity);
                                if (productId && quantity > 0) {
                                    // Fetch product details asynchronously
                                    var url = '/get-product-details/' + productId;
                                    console.log(url);
                                    fetch('/get-product-details/' + productId)
                                        .then(response => response.json())
                                        .then(data => {
                                            // Update product table with selected product details
                                            var productTableBody = document.getElementById('productTableBody');
                                            var newRow = productTableBody.insertRow();
                                            var productNameCell = newRow.insertCell(0);
                                            var unitPriceCell = newRow.insertCell(1);
                                            var quantityCell = newRow.insertCell(2);
                                            var totalPriceCell = newRow.insertCell(3);
                                            
                                            productNameCell.textContent = data.product_name;
                                            unitPriceCell.textContent = data.unit_price;
                                            quantityCell.textContent = quantity;
                                            totalPriceCell.textContent = parseFloat(data.unit_price) * parseInt(quantity);
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                        });
                                }
                            });
                        });
                    </script>
@endsection
