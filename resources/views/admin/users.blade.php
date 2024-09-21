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

  <div style="position: relative; top: 60px; right: -150px">
  <table bgcolor="grey" border="3px">
    <tr>
        <th style="padding: 30px">Home </th>
        <th style="padding: 30px">Email </th>
        <th style="padding: 30px">Action </th>
        
    </tr>

    @foreach($data as $data)
    <tr align="center">
        <th>{{$data->name}} </th>
        <th>{{$data->email}} </th>

        @if($data->usertype=="0")
        <th><a href="{{url('/deleteuser',$data->id)}}">delete</a> </th>
        @else
        <th><a>not allowed</a> </th>
        @endif
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

</body>
</html>
</x-app-layout>