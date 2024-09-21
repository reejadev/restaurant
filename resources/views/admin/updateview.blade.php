<x-app-layout>
<!DOCTYPE html>
<html lang="en">
  <head>

  <base href="/public">
    <!-- Required meta tags -->
    @include("admin.admincss")
  </head>
  <body>
  <div class="container-scroller">  
      @include("admin.navbar")
  

<div  class="position: relative; top: 60px; right: -150px" >

<form action="{{url('/update', $data->id)}}" method="post" enctype="multipart/form-data">
@csrf
<div class="mt-4 ">
<label>Title</label>
<input type="text" style="color:red" name="title" value="{{$data->title}}" required>
</div>

<div class="mt-4 ">
<label>Price</label>
<input type="num"  style="color:red" name="price" value="{{$data->price}}" required>
</div>

<div class="mt-4 ">
<label>Old Image</label>
<img height="100" width="100" src="/storage/{{$data->image}}">
</div>


<div class="mt-4 ">
<label>New Image</label>
<input type="file" name="image" required>
</div>

<div class="mt-4 ">
<label>Description</label>
<input type="text" style="color:red" name="description" value="{{$data->description}}" required>
</div>

<div>

<input class="btn btn-primary" type="submit" value="Save">

</div>


</form>

</div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include("admin.adminscript")
  </body>
</html>
</x-app-layout>