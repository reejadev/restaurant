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



<div style="position: relative; top: 60px; right: -150px" >

<div>Reservation</div>
  <table bgcolor="grey">
    <tr>
      <th style="padding: 30px">Name  </th>
      <th style="padding: 30px"> email </th>
      <th style="padding: 30px">Phonenumber  </th>
      <th style="padding: 30px"> NumberofGuest  </th>
      <th style="padding: 30px"> Date  </th>
      <th style="padding: 30px"> Time  </th>
      <th style="padding: 30px"> Message  </th>
    </tr>

    @foreach($data as $data)
    <tr align="center">

    <td>{{$data->Name}}</td>
    <td>{{$data->email}}</td>
    <td>{{$data->phone}}</td>
    <td>{{$data->guest}}</td>
    <td>{{$data->date}}</td>
    <td>{{$data->time}}</td>
    <td>{{$data->message}}</td>
   
   
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