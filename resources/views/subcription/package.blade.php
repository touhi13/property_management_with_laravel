<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Rental Management System</title>

  <!-- Bootstrap core CSS -->
<link href="{{asset('assets/package/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('assets/package/modern-business.css')}}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">Rental Management System</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.html">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Portfolio
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item" href="portfolio-1-col.html">1 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-2-col.html">2 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-3-col.html">3 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-4-col.html">4 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-item.html">Single Portfolio Item</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Blog
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="blog-home-1.html">Blog Home 1</a>
              <a class="dropdown-item" href="blog-home-2.html">Blog Home 2</a>
              <a class="dropdown-item" href="blog-post.html">Blog Post</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Other Pages
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="full-width.html">Full Width Page</a>
              <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
              <a class="dropdown-item" href="faq.html">FAQ</a>
              <a class="dropdown-item" href="404.html">404</a>
              <a class="dropdown-item" href="pricing.html">Pricing Table</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header>
    
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      {{-- <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol> --}}
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="">
          <img  class="carousel-item active" src="{{asset('images/room.jpg')}}" alt="">
          <div class="carousel-caption d-none d-md-block">
            {{-- <h3>First Slide</h3>
            <p>This is a description for the first slide.</p> --}}
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        {{-- <div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Second Slide</h3>
            <p>This is a description for the second slide.</p>
          </div>
        </div> --}}
        <!-- Slide Three - Set the background image for this slide in the line below -->
        {{-- <div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Third Slide</h3>
            <p>This is a description for the third slide.</p>
          </div>
        </div> --}}
      </div>
      {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a> --}}
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">

    <h1 class="my-4">Welcome!!!</h1>

    <!-- Marketing Icons Section -->
    <div class="row">
      @foreach ($packages as $package)
      <div class="col-lg-4 mb-4">

        <div class="card h-100">
        <div class="card-header"><span class="h3">{{$package->name}}</span><span class="float-right">${{$package->price}}/{{$package->duration}}</span></div>
        

          <div class="card-body">
            <p class="card-text">{{$package->description}}</p>
            
          </div>
          <div class="card-footer">
            <a href="{{ url('/register/manager',$package->id) }}" class="btn btn-primary">Buy Now</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <!-- /.row -->

    <!-- Portfolio Section -->
    
    <!-- /.row -->

    <!-- Features Section -->
    
    <!-- /.row -->

    <hr>

    <!-- Call to Action Section -->
    <div class="row mb-4">
      
    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('assets/package/jquery.min.js')}}"></script>
  <script src="{{asset('assets/package/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
