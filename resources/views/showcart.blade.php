<!DOCTYPE html>
<html lang="en">

<head>

    <title>Eatery Cafe and Restaurant Template</title>


    <!-- 

Eatery Cafe Template 

http://www.templatemo.com/tm-515-eatery

-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/templatemo-style.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



</head>


<body>

    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">

            <span class="spinner-rotate"></span>

        </div>
    </section>


    <!-- MENU -->
    <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <!-- lOGO TEXT HERE -->
                <a href="index.html" class="navbar-brand">Eatery <span>.</span> Cafe</a>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-nav-first">
                    <li><a href="{{'/redirects'}}" class="smoothScroll">Home</a></li>
                    <li><a href="#about" class="smoothScroll">About</a></li>
                    <li><a href="#team" class="smoothScroll">Chef</a></li>
                    <li><a href="#menu" class="smoothScroll">Menu</a></li>
                    <li><a href="#contact" class="smoothScroll">Contact</a></li>

                    <li class="scroll-to-section">
                        @auth
                        <a href="{{ url('/showcart',Auth::user()->id) }}" class="smoothScroll">
                            Cart[{{$count}}]
                        </a>
                        @endauth

                        @guest

                        Cart[0]

                        @endguest
                    </li>


                    <li>

                        @if (Route::has('login'))
                        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                            @auth
                    <li>

                        <!-- <a href="{{ route('logout') }}" class="font-semibold text-gray-600 hover:text-gray-900 
                        focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log out</a> -->

                    </li>

                    @else
                    <li><a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 
                        focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a></li>

                    @if (Route::has('register'))
                    <li> <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 
                         focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a></li>
                    @endif
                    @endauth
            </div>
            @endif
            </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Call Now! <i class="fa fa-phone"></i> 010 020 0340</a></li>
                <a href="#footer" class="section-btn">Reserve a table</a>
            </ul>



        </div>

        </div>
    </section>



    <div style="position: relative; top: 150px; left: -150px">


        <table align="center">
            <tr style="background-color:yellow;">
                <th style="padding: 30px">Food Name </th>
                <th style="padding: 30px"> Price </th>
                <th style="padding: 30px">Quantity </th>
                <th style="padding: 30px">Total Price </th>
                <th style="padding: 30px">Action </th>
            </tr>


            <form action="{{url('orderconfirm')}}" method="POST">

                @csrf

                @php
                $fullTotal = 0;
                @endphp

                @if(isset($data) && $data->isNotEmpty()){
                @foreach($data as $index => $item)

                <tr align="center">

                    <td style="padding: 10px">
                        <input type="text" name="foodname[]" value="{{$item->title}}" hidden="">
                        {{$item->title}}

                    </td>
                    <td style="padding: 10px">
                        <input type="text" name="price[]" value="{{$item->price}}" hidden="">
                        {{$item->price}}
                    </td>

                    <td style="padding: 10px">
                        <input type="text" name="quantity[]" value="{{$item->quantity}}" hidden="">
                        {{$item->quantity}}
                    </td>


                    <td style="padding: 10px">
                        @php
                        $totalPrice = $item->price * $item->quantity;
                        $fullTotal += $totalPrice;
                        @endphp
                        {{$totalPrice}}
                    </td>


                    <td style="padding: 10px">
                        @if(isset($data2[$index]))
                        <a href="{{ url('/remove', $data2[$index]->id) }}" class="btn btn-warning remove-btn">Remove</a>
                        @endif
                    </td>

                </tr>
                @endforeach


        </table>

        <div align="center" style="padding: 10px;">
            <strong>Full Total: {{ $fullTotal }}</strong>
            <input type="hidden" name="full_total" value="{{ $fullTotal }}">
        </div>




        <div align="center" style="padding: 10px;">

            <button class="btn btn-primary" type="button" id="order">Order Now</button>
            <!-- <button class="btn btn-primary" type="submit" id="order">Order Now</button> -->

        </div>

        <div id="appear" align="center" style="padding: 10px; display: none;">

            <div style="padding: 10px;">
                <label>Name</label>
                <input type="text" name="name" placeholder="Name" value="{{$item->name}}">
                {{$item->name}}
            </div>

            <div style="padding: 10px;">
                <label>Phone</label>
                <input type="integer" name="phone" placeholder="Phone" value="{{$item->phone}}">
                {{$item->phone}}
            </div>

            <div style="padding: 10px;">
                <label>Address</label>
                <input type="text" name="address" placeholder="Address" value="{{$item->address}}">
                {{$item->address}}
            </div>

            <div align="center" style="padding: 10px;">
                <form action="{{ route('stripe.checkout') }}" method="Post">
                    @csrf
                    <input type="hidden" name="full_total" value="{{ intval($fullTotal) }}">
                    <button class="btn btn-primary" type="submit">Proceed to Pay</button>
                </form>


            </div>


            <!-- 
            <div style="padding: 10px;">

                <input class="btn btn-success" type="submit" id="order" value="Order Confirm">

                <button class="btn btn-danger" type="button" id="close">Close</button>
            </div> -->

        </div>

        </form>
        }{@else
        <tr>
            <td colspan="5" style="text-align: center;">Your cart is empty.</td>
        </tr>
        @endif}
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        $("#order").click(function() {
            $("#appear").show();
        });

        $("#close").click(function() {
            $("#appear").hide();
        });
    });
    </script>

    <!-- SCRIPTS -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/smoothscroll.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>