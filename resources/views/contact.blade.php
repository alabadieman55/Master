@extends('layouts.base')
@section('content')

<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Contact Us</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.htm">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section> <!-- Contact Section Start -->
    <section class="contact-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="materialContainer">
                        <div class="material-details">
                            <div class="title title1 title-effect mb-1 title-left">
                                <h2>Contact Us</h2>
                                <p class="ms-0 w-100">Your email address will not be published. Required fields are
                                    marked *</p>
                            </div>
                        </div>
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row g-4 mt-md-1 mt-2">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name"
                                        required="">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address"
                                        required="">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone *</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter Your Phone Number" required="">
                                </div>
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                        placeholder="Enter Subject" required="">
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required=""></textarea>
                                </div>

                                <div class="col-auto">
                                    <button class="btn btn-solid-default" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="contact-details">
                        <div>
                            <h2>Let's get in touch</h2>
                            <h5 class="font-light">We're open for any suggestion or just to have a chat</h5>
                            <div class="contact-box">
                                <div class="contact-icon">
                                    <i data-feather="map-pin"></i>
                                </div>
                                <div class="contact-title">
                                    <h4>Address :</h4>
                                    <p>AS-Salt,Jordan </p>
                                </div>
                            </div>

                            <div class="contact-box">
                                <div class="contact-icon">
                                    <i data-feather="phone"></i>
                                </div>
                                <div class="contact-title">
                                    <h4>Phone Number :</h4>
                                    <p>+9627788899</p>
                                </div>
                            </div>

                            <div class="contact-box">
                                <div class="contact-icon">
                                    <i data-feather="mail"></i>
                                </div>
                                <div class="contact-title">
                                    <h4>Email Address :</h4>
                                    <p>alabadieman58@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection