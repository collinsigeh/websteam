@extends('layouts.web_upgrade')

@section('content')

<section>
    <div style="height: 50px;"></div>
    <div id="page-title">
        <h1>PENGlobal is Upgrading</h1>
    </div>
    <div id="page-body">
        <h5 class="text-center" style="line-height: 1.4em;">
            We're currently upgrading our website. Please reach us with any of the options below.
        </h5>

        <div class="page-section">
            <div class="p-3"></div>
            <div class="row">
                <div class="col-lg-6">
                  <div class="contact-box">
                    <div class="contact-icon">
                      <i class="fas fa-mobile-screen-button"></i>
                    </div>
                    <div class="sub-title text-center"><h3>Call/WhatsApp</h3></div>
                    <div class="contact-info">
                      <a href="tel:+2348037449157">08037449157</a>
                      <a href="tel:+2348027497030">08027497030</a>
                      <a href="tel:+2348154112679">08154112679</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-box">
                      <div class="contact-icon">
                        <i class="fas fa-at"></i>
                      </div>
                        <div class="sub-title text-center"><h3>Email</h3></div>
                        <div class="contact-info">
                          <a href="mailto:penglobalinc@gmail.com">penglobalinc@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
              @include('inc.social_icons')
            </div>
        </div>
        
    </div>
@endsection