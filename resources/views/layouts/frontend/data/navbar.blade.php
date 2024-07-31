 <!-- Offcanvas Menu Begin -->
 <div class="offcanvas-menu-overlay"></div>
 <div class="offcanvas-menu-wrapper">
     <div class="offcanvas__close">+</div>
     <ul class="offcanvas__widget">
         <li><span class="icon_search search-switch"></span></li>
         <li><a href="#"><span class="icon_bag_alt"></span>
             <div class="tip">2</div>
         </a></li>
     </ul>
     <a class="navbar-brand" href="#">
        <img src="{{ asset('me/img/LogoMahardhika.png') }}" alt="" style="max-width: 100px; max-height: 55px">
    </a>
 </div>
 <!-- Offcanvas Menu End -->

 <!-- Header Section Begin -->
 <header class="header">
     <div class="container-fluid">
         <div class="row">
             <div class="col-xl-3 col-lg-2">
                 <div class="">
                     
                 </div>
             </div>
             <div class="col-xl-6 col-lg-7 text-center">
                 <nav class="header__menu">
                     <ul>
                         <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Beranda</a></li>
                         <li class="{{ request()->is('product*') ? 'active' : '' }}"><a href="{{ route('product.index') }}">Belanja</a></li>
                         <li class="{{ request()->is('category*') ? 'active' : '' }}"><a href="{{ route('category.index') }}">Kategori</a></li>
                         <li><a href="./contact.html">Contact</a></li>
                     </ul>
                 </nav>
             </div>
             <div class="col-lg-3">
                 <div class="header__right">
                     <ul class="header__right__widget">
                         <li><span class="icon_search search-switch"></span></li>
                         <li><a href="{{ route('cart.index') }}"><span class="icon_bag_alt"></span>
                             <div class="tip">
                                 {{ $totalCart ?? 0 }}
                             </div>
                         </a></li>
                     </ul>
                 </div>
             </div>
         </div>
         <div class="canvas__open">
             <i class="fa fa-bars"></i>
         </div>
     </div>
 </header>
 <!-- Header Section End -->