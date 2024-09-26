 <!--====== HEADER PART START ======-->
 <header class="header_area">
     <div id="header_navbar" class="header_navbar">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-xl-12">
                     <nav class="navbar navbar-expand-lg">
                         <!-- <a class="navbar-brand" href="index.html">
                             <img id="logo" src="{{ asset('assets/images/logo-uti.png') }}" alt="Logo">
                         </a> -->
                         <button class="navbar-toggler" type="button" data-toggle="collapse"
                             data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                             aria-expanded="false" aria-label="Toggle navigation">
                             <span class="toggler-icon"></span>
                             <span class="toggler-icon"></span>
                             <span class="toggler-icon"></span>
                         </button>
                         <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                             <ul id="nav" class="navbar-nav ml-auto">
                                 <li class="nav-item">
                                     <a href="/" class="text">Home</a>
                                 </li>
                                 @auth
                                     <li class="nav-item">
                                         <a href="/daftarruang" class="text">Room List</a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="/daftarpinjam" class="text">Booking List</a>
                                     </li>
                                     <form action="/logout" method="post">
                                         @csrf
                                         <button type="submit"
                                             class="btn border border-dark rounded-pill text-dark "><i
                                                 class="bi bi-box-arrow-right"></i>
                                             Logout</button>
                                     </form>
                                 @else
                                     <li class="nav-item">
                                         <a class="header-btn btn-hover" href="/login">Login</a>
                                     </li>
                                 @endauth
                             </ul>
                         </div> <!-- navbar collapse -->
                     </nav> <!-- navbar -->
                 </div>
             </div> <!-- row -->
         </div> <!-- container -->
     </div> <!-- header navbar -->
 </header>
 <!--====== HEADER PART ENDS ======-->
