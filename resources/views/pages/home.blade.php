@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
  <!-- Carousel Slide -->
  <div id="carouselCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselCaptions" data-slide-to="1"></li>
      <li data-target="#carouselCaptions" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="pic/bgHome1.jpg" class="d-block w-100 min-vh-100" alt="First Slide">
        <div class="carousel-caption d-md-block">
          <blockquote>
              <h4>"Nothing is pleasanter than exploring a Library"</h4>
              <footer><cite> - Walter Savage Landor</cite></footer>
          </blockquote>
        </div>
      </div>

      <div class="carousel-item">
        <img src="pic/bgHome2.jpg" class="d-block w-100 min-vh-100" alt="Second Slide">
        <div class="carousel-caption d-md-block">
          <h4>Find Books Here</h4>
          <a href="/books" class="btn btn-dark btn-md active" role="button" aria-pressed="true">Books</a>
        </div>
      </div>
      
      <div class="carousel-item">
        <img src="pic/bgHome3.jpg" class="d-block w-100 min-vh-100" alt="Third Slide">
        <div class="carousel-caption d-md-block">
          <h4>Find Issued Books</h4>
          <a href="/issuestuds" class="btn btn-light btn-md active" role="button" aria-pressed="true">Student</a>
          <a href="/issueteachers" class="btn btn-light btn-md active" role="button" aria-pressed="true">Teacher</a>
        </div>
      </div>
    </div>

    <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
@endsection