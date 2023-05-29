@extends('layouts.web')

@section('content')

<section id="contact" class="contact mb-5">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-12 text-center mb-5">
          <h1 class="page-title">Contact us</h1>
        </div>
      </div>

      <div class="row gy-4">
        <!--
        <div class="col-md-4">
          <div class="info-item">
            <i class="bi bi-geo-alt"></i>
            <h3>Address</h3>
            <address>A108 Adam Street, NY 535022, USA</address>
          </div>
        </div> End Info Item -->

        <div class="col-md-6">
          <div class="info-item"> <!-- I removed the class: info-item-borders -->
            <i class="bi bi-phone" style="color: #ED7B43;"></i>
            <h3>Call/WhatsApp</h3>
            <p>
                <a href="tel:+2348037449157">08037449157</a> 
                <a href="tel:+2348027497030" style="margin-left: 15px; margin-right: 15px;">08027497030</a> 
                <a href="tel:+2348154112679">08154112679</a>
            </p>
          </div>
        </div><!-- End Info Item -->

        <div class="col-md-6">
          <div class="info-item">
            <i class="bi bi-envelope" style="color: #ED7B43;"></i>
            <h3>Email</h3>
            <p><a href="mailto:penglobalinc@gmail.com">penglobalinc@gmail.com</a></p>
          </div>
        </div><!-- End Info Item -->

      </div>

      <div class="form mt-5">
        
        @if(strlen(session('sent_message') > 0))
        <div class="alert alert-success text-center">
            {{ session('sent_message') }}
            @php session(['sent_message' => '']); @endphp
        </div>
      @else
      <form action="{{ route('submit_contact_form') }}" method="post" class="contact-form">
          @csrf

        <div class="row">
          <div class="form-group col-md-6">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
          </div>
          <div class="form-group col-md-6">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
          </div>
        </div>
        <div class="form-group">
          <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
        </div>
        <div class="my-3">
          <div class="loading">Loading</div>
        </div>
        <div class="text-center"><button type="submit">Send Message</button></div>
      </form>
      @endif
      </div><!-- End Contact Form -->

    </div>
  </section>
  <div style="height: 100px;"></div>
@endsection