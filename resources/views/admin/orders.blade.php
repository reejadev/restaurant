<x-app-layout>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include("admin.admincss")
  </head>
  <body>
  <div class="container-scroller">  
      @include("admin.navbar")

      <div class="mt-10">
    <h3>Customer Orders</h3>
    <!-- Your table and other content here -->


<form action="{{url('/search')}}" method="get">
    @csrf

<input type="text" name="search" style="color:blue;">

<input type="submit" value="search" class="btn btn-success">
</form>
     
<table class="mt-5" bgcolor="purple">
    <tr>
      <th style="padding: 30px"> Food name  </th>
      <th style="padding: 30px"> Price </th>
      <th style="padding: 30px">Quantity  </th>
      <th style="padding: 30px"> Name  </th>
      <th style="padding: 30px"> Phone  </th>
      <th style="padding: 30px"> Address  </th>
      <th style="padding: 30px"> Total Quantity  </th>
    </tr>

    @foreach($data as $data)
    <tr align="center">

    <td>{{$data->foodname}}</td>
    <td>${{$data->price}}</td>
    <td>{{$data->quantity}}</td>
    <td>{{$data->name}}</td>
    <td>{{$data->phone}}</td>
    <td>{{$data->address}}</td>
    <td>${{$data->price*$data->quantity}}</td>
    </tr>
    @endforeach
  </table>

</div>

</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include("admin.adminscript")
  </body>
</html>
</x-app-layout>