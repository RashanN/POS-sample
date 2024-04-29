@extends('layouts.land')

@section('content')
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/invoiceshow.css')}}">
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
                    <script>
                        // Define JavaScript variables to store the products and amount

                    </script>
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
                                <select id="product" class="form-control" name="product" required onchange="focusQuantity()">
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
                                <th>Action </th>
                            </tr>
                        </thead>
                        <!-- Table body (sample data) -->
                        <tbody id="productTableBody">
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                    <div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Amount</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="amount"  class="form-control input-with-border" >
                        </div>
                        <div class="col-md-6">
                            <h4>Discount</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="discount"  class="form-control input-with-border" id="discountInput">
                        </div>
                        <div class="col-md-6">
                            <h4>Fine Payment</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="finePayment"  class="form-control input-with-border" id="finetInput">
                        </div>
                        <div class="col-md-6">
                            <h4>Total</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="total"  class="form-control input-with-border">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
      <script>

                function focusQuantity() {
                     document.getElementsByName('quantity')[0].focus();
                }
            document.getElementById('addProductBtn').addEventListener('click', function(event) {
            event.preventDefault();

            var productId = document.getElementById('product').value;
             console.log(productId);
              var quantity = document.getElementsByName('quantity').value;
    
          console.log(quantity);
            $.ajax({
                url: '{{ route('get-product-details') }}',
                method: 'GET',
                data: {
                    productId: productId,
                    quantity: quantity
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
    var productsData = data.products;
    console.log(productsData);

    var tableBody = document.getElementById('productTableBody');
    var row = tableBody.insertRow();

    row.innerHTML = `
        <td class="font_color row_padding">${productsData.name}</td>
        <td class="font_color row_padding" contenteditable="true">${productsData.unitprice}</td>
        <td class="font_color row_padding">${data.quantity}</td>
        <td id="tot" class="font_color row_padding">${productsData.unitprice * data.quantity}</td>
        <td class="font_color row_padding"><button onclick="deleteRow(this)">Delete</button></td>
    `;

    var tot = 0;

    document.querySelectorAll('#productTableBody tr').forEach(function(row) {
        var totalPriceCell = row.querySelector('#tot');
        if (totalPriceCell) {
            var totalPriceCellContent = totalPriceCell.textContent;
            console.log(totalPriceCellContent);
            tot += parseFloat(totalPriceCellContent);
        }
    });

    console.log('Total:', tot);
    updateAmount(tot);
    var totalRow = tableBody.insertRow();
    totalRow.innerHTML = `
        <td hidden>Total:</td>
        <td id="sum" colspan="3" " hidden>${tot}</td>

    `;

}

        function deleteRow(button) {
            var row = button.parentNode.parentNode; // Get the parent row of the button
            row.parentNode.removeChild(row); // Remove the row from the table
            updateAmount();
        }

        function updateAmount(tot) {

                var playedTimeTotalValue = document.getElementsByName('played_time_total')[0].value;
                document.getElementsByName('amount')[0].value=parseFloat(playedTimeTotalValue);

                    var tot = 0;
                    document.querySelectorAll('#productTableBody tr').forEach(function(row) {
                    var totalPriceCell = row.querySelector('#tot');
                    if (totalPriceCell) {
                            var totalPriceCellContent = totalPriceCell.textContent;
                            tot += parseFloat(totalPriceCellContent);
                    }
                    var amount = parseFloat(playedTimeTotalValue) + tot;
                    amount = amount.toFixed(2);
                    document.getElementsByName('amount')[0].value = amount;
    });
                    // if (typeof tot === 'undefined') {
                    //        document.getElementsByName('amount')[0].value=parseFloat(playedTimeTotalValue);
                    //     } else {
                    //         var totFormatted = tot.toFixed(2);
                    //         console.log('totFormatted:', totFormatted);
                    //         amount = parseFloat(playedTimeTotalValue) + parseFloat(totFormatted);
                    //         document.getElementsByName('amount')[0].value =amount;
                    //     }


            }
            updateAmount();
            document.getElementsByName('played_time_total')[0].addEventListener('input', function() {
                updateAmount(); // Update the amount input field when played_time_total changes
            });

            
    </script>
@endsection
