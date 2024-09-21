  <!-- MENU-->
  <section id="menu" data-stellar-background-ratio="0.5">

      <div class="container">
          <div class="row">

              <div class="col-md-12 col-sm-12">
                  <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                      <h2>Our Menus</h2>
                      <h4>Tea Time &amp; Dining</h4>


                  </div>
              </div>

              @foreach($data as $data)

              <form action="{{url('/addtocart',$data->id)}}" method="post">
                  @csrf
                  <div class="col-md-4 col-sm-6">
                      <!-- MENU THUMB -->

                      <div class="menu-thumb">



                          <a href="{{ url('/index/' . $data->image) }}" class="image-popup" title="{{$data->title}}">
                              <img src="{{ asset('storage/'.$data->image) }}" class="img-responsive" alt="">


                              <div class="menu-info">
                                  <div class="menu-item">

                                      <h3>{{$data->title}}</h3>
                                      <p>{{$data->description}}</p>
                                  </div>
                                  <div class="menu-price">
                                      <span>{{$data->price}}</span>
                                  </div>
                              </div>
                          </a>

                      </div>
                      <input type="number" name="quantity" value="1" min="1" placeholder="qty" style="width: 80px;">
                      <input type="submit" value="add to cart">

                  </div>
              </form>
              @endforeach
          </div>

      </div>


      </div>


      </div>

  </section>