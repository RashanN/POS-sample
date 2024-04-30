<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/adminpanel.css')}}">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script>
        var hamburger = document.querySelector(".hamburger");
        var wrapper  = document.querySelector(".wrapper");
        var backdrop = document.querySelector(".backdrop");

        hamburger.addEventListener("click", function(){
            wrapper.classList.add("active");
        })

        backdrop.addEventListener("click", function(){
            wrapper.classList.remove("active");
        })
    </script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body>

    <div class="wrapper">
		<div class="wrapper_inner">
			<div class="vertical_wrap">
			<div class="backdrop"></div>
			<div class="vertical_bar">

				<ul class="menu">
					<li><a href="{{ route('customer.index') }}">
						<span class="icon"><i class="fas fa-home"></i></span>
						<span class="text">Customers</span>
					</a></li>
					<li><a href="#" class="active">
						<span class="icon"><i class="fas fa-file-alt"></i></span>
						<span class="text">Dashboard</span>
					</a></li>
                    <li><a href="{{ route('product.index') }}">
						<span class="icon"><i class="fas fa-home"></i></span>
						<span class="text">Products</span>
					</a></li>
                    <li><a href="{{route('product_category.index')}}">
						<span class="icon"><i class="fas fa-home"></i></span>
						<span class="text">Product Category</span>
					</a></li>
					<li><a href="{{ route('invoice.create') }}">
						<span class="icon"><i class="fas fa-chart-pie"></i></span>
						<span class="text">Invoice</span>
					</a></li>
					<li><a href="">
						<span class="icon"><i class="fas fa-cog"></i></span>
						<span class="text">Add New Product  </span>
					</a></li>
                    <li><a href="">
						<span class="icon"><i class="fas fa-cog"></i></span>
						<span class="text">Check Stock</span>
					</a></li>
                    <li><a href="{{ route('supplier.index') }}">
						<span class="icon"><i class="fas fa-cog"></i></span>
						<span class="text">Supplier</span>
					</a></li>

				</ul>


			</div>
		</div>
		<div class="main_container">
			<div class="top_bar">
				<div class="hamburger">
					<i class="fas fa-bars"></i>
				</div>
				<div class="logo">
					 <span>POS SYSTEM</span>
				</div>
			</div>

			<div class="container">
				<div class="content">

                    <div class="card text-dark bg-light mb-3" style="max-width: 30rem;">
                        <div class="card-header"><strong> Total Sales </strong></div>
                        <div class="card-body">
                          <p class="card-title"></p>

                        </div>
                    </div>

                    <div class="card text-dark bg-light mb-3" style="max-width: 30rem;">
                        <div class="card-header"><strong> Total Customers</strong></div>
                        <div class="card-body">
                          <p class="card-title">{{$customerCount}}</p>

                        </div>
                    </div>

						{{-- {{dd($coun t)}} --}}
				</div>
			</div>
		</div>
		</div>
	</div>
</body>
</html>
</x-app-layout>
