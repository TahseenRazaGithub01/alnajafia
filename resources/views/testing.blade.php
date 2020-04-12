<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Law &mdash; One Page Bootstrap 4 Theme by va8ive developers</title>
		<meta name="description" content="Free Bootstrap 4 Theme by va8ive developers">
		<meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">

		<link rel="stylesheet" href="{{ url('assets/law/css/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/law/fonts/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/law/fonts/law-icons/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ url('assets/law/fonts/fontawesome/css/font-awesome.min.css') }}">
    
    
    <link rel="stylesheet" href="{{ url('assets/law/css/slick.css') }}">
    <link rel="stylesheet" href="{{ url('assets/law/css/slick-theme.css') }}">

    <link rel="stylesheet" href="{{ url('assets/law/css/helpers.css') }}">
    <link rel="stylesheet" href="{{ url('assets/law/css/style.css') }}">
	</head>
	<body data-spy="scroll" data-target="#pb-navbar" data-offset="200">
    
    <nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_scrolled-light" id="pb-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.html">Law</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span><i class="ion-navicon"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="probootstrap-navbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#section-home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-why-us">Why</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-contact">Contact</a></li>
            <a href="locale/en">EN</a> &nbsp; &nbsp; &nbsp;
            <a href="locale/fr">FR</a> &nbsp; &nbsp; &nbsp;
            <a href="locale/ar">AR</a> &nbsp; &nbsp; &nbsp;
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->

    <section class="pb_cover_v1 text-left cover-bg-black cover-bg-opacity-4" style="background-image: url(assets/law/images/1900x1200_img_7.jpg)" id="section-home">
      <div class="container">
        <div class="row align-items-center justify-content-end">
          <div class="col-md-6  order-md-1">

            <h2 class="heading mb-3">The Law Firm</h2>
            <div class="sub-heading"><p class="mb-5">A free template by <a href="#">va8ive developers</a> for Law Firm</p>
            <p><a href="#section-contact" role="button" class="btn smoothscroll pb_outline-light btn-xl pb_font-13 p-4 rounded-0 pb_letter-spacing-2">Free Consultation</a></p>
            </div>
            
          </div>  
        </div>
      </div>
    </section>
    <!-- END section -->
   
    <section class="pb_section pb_section_v1" data-section="about" id="section-about">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 pr-md-5 pr-sm-0">
            @php $sess = Session::get('locale'); @endphp


            @foreach($stories as $record)
              <h2 class="mt-0 heading-border-top mb-3 font-weight-normal">{{ $record["name_$sess"] }}</h2>
              <p>{{ $record["description_$sess"] }}</p>
              <hr>
            @endforeach


          </div>
          <div class="col-lg-7">
            <div class="images">
              <img class="img1 img-fluid" src="assets/law/images/600x450_img_2.jpg" alt="free Template by uicookies.com">
            </div>
          </div>
          
        </div>
      </div>  
    </section>

    <!-- END section -->

    <footer class="pb_footer bg-light" role="contentinfo">
      <div class="container">
        <div class="row text-center">
          <div class="col">
            <ul class="list-inline">
              <li class="list-inline-item"><a href="#" class="p-2"><i class="fa fa-facebook"></i></a></li>
              <li class="list-inline-item"><a href="#" class="p-2"><i class="fa fa-twitter"></i></a></li>
              <li class="list-inline-item"><a href="#" class="p-2"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col text-center">
            <p class="pb_font-14">&copy; 2017 <a href="https://uicookies.com/">Law</a>. All Rights Reserved. Designed by <a href="https://uicookies.com/">uiCookies</a> Demo Images: Unsplash</p>
          </div>
        </div>
      </div>
    </footer>
    
    <!-- loader -->
    <div id="pb_loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#FDA04F"/></svg></div>


    <script src="{{ url('assets/law/js/jquery.min.js') }}"></script>
    
    <script src="{{ url('assets/law/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/law/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/law/js/slick.min.js') }}"></script>

    <script src="{{ url('assets/law/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ url('assets/law/js/jquery.easing.1.3.js') }}"></script>

    <script src="{{ url('assets/law/js/main.js') }}"></script>

	</body>
</html>