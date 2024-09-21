<div class="col-md-6 col-sm-12">

    <div class="col-md-12 col-sm-12">
        <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
            <h2>Reservation</h2>
        </div>
    </div>

    <!-- CONTACT FORM -->
    <form action="{{ route('store.reservation') }}" method="post" class="wow fadeInUp" id="contact-form" role="form"
        data-wow-delay="0.8s">
        @csrf
        <!-- IF MAIL SENT SUCCESSFUL  // connect this with custom JS -->
        <h6 class="text-success">Your message has been sent successfully.</h6>

        <!-- IF MAIL NOT SENT -->
        <h6 class="text-danger">E-mail must be valid and message must be longer than 1 character.</h6>

        <div class="col-md-6 col-sm-6">
            <input type="text" class="form-control" id="Name" name="Name" placeholder="Full name">
        </div>

        <div class="col-md-6 col-sm-6">
            <input type="email" class="form-control" id="cf-email" name="email" placeholder="Email address">
        </div>

        <div class="col-md-6 col-sm-6">
            <input type="number" class="form-control" id="cf-number" name="phone" placeholder="Phone number">
        </div>

        <div class="col-md-6 col-sm-6">
            <input type="number" class="form-control" id="cf-guest" name="guest" placeholder="Number of guest">
        </div>

        <div class="col-md-6 col-sm-6">
            <input type="date" class="form-control" id="cf-date" name="date" placeholder="Date">
        </div>

        <div class="col-md-6 col-sm-6">
            <input type="time" class="form-control" id="cf-time" name="time" placeholder="Time">
        </div>

        <div class="col-md-6 col-sm-6">
            <input type="number" class="form-control" id="cf-time" name="cost" value="1000" placeholder="cost">
        </div>

        <div class="col-md-6 col-sm-6">
            <input type="hidden" class="form-control" id="cf-time" name="schedule_id" value="3"
                placeholder="scheduleid">
        </div>


        <textarea class="form-control" rows="6" id="cf-message" name="message" placeholder="Message"></textarea>

        <button type="submit" class="form-control" id="cf-submit" name="submit">Send Message</button>
</div>
</form>
</div>