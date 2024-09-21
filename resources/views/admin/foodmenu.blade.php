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
      

<div  style="position: relative; top: 60px; right: -150px" >

<form action="{{url('/uploadfood')}}" method="post" enctype="multipart/form-data">
@csrf

<div class="mt-4 ">
  <div>
<h3>Insert Food<h3>
</div>
<label>Title</label>
<input type="text" style="color:red" name="title" placeholder="Write a title" required>
</div>

<div class="mt-4 ">
<label>Price</label>
<input type="num"  style="color:red" name="price" placeholder="price" required>
</div>

<div class="mt-4 ">
<label>Image</label>
<input type="file" name="image" required>
</div>

<div class="mt-4 ">
<label>Description</label>
<input type="text" style="color:red" name="description" placeholder="description" required>
</div>

<div class="mt-4" style="display: flex; justify-content: center;">

<input  class="btn btn-primary" type="submit" value="Save">

</div>


</form>
</div>


<div style="position: relative; top: 60px; right: -150px" >

<h3>Display Food</h3>
  <table bgcolor="purple">
    <tr>
      <th style="padding: 30px"> Food name  </th>
      <th style="padding: 30px"> Price </th>
      <th style="padding: 30px">Description  </th>
      <th style="padding: 30px"> Image  </th>
      <th style="padding: 30px"> Action  </th>
      <th style="padding: 30px"> Action2  </th>
    </tr>

    @foreach($data as $data)
    <tr align="center">

    <td>{{$data->title}}</td>
    <td>{{$data->price}}</td>
    <td>{{$data->description}}</td>
    <td><img height="100" width="100" src="/storage/{{$data->image}}"></td>
    <td><a href="{{url('/deletemenu',$data->id)}}">Delete</a></td>
    <td><a href="{{url('/updateview',$data->id)}}">Update</a></td>
    </tr>
    @endforeach
  </table>



    <!-- container-scroller -->
    <!-- plugins:js -->

    @include("admin.adminscript")
    </div>
 
  </body>
  
</html>
</x-app-layout>