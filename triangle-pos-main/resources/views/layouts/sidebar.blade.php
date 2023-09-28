
  
  <style>
     /*   @keyframes rotateImage {
             0%{
      transform: rotateX(0deg) rotateY(360deg) rotateZ(0deg);
    }
    100%{
      transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
            }
        } */
        </style>

@if (auth()->check() && auth()->user()->email !== 'cashier@test.com')
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show {{ request()->routeIs('app.pos.*') ? 'c-sidebar-minimized' : '' }}" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <a href="{{ route('home') }}">
            <img class="c-sidebar-brand-full" src="{{ asset('images/Logo.png') }}" alt="Site Logo" width="50" style="margin-top: 10px; margin-bottom: 30px; animation: rotateImage 5s linear infinite;"">
            <img class="c-sidebar-brand-minimized" src="{{ asset('images/Logo.png') }}" alt="Site Logo" width="40" style="animation: rotateImage 5s linear infinite;">
        </a>
    </div>
    <div class="typescript" style="margin-top: -10px; margin-left: 60px;">
     <h5>  <span  class="multiple-text-2" style="text-shadow: 1px 1px #017a74; color: #24001b;"></span></h5>
    </div>
    
    
    <ul class="c-sidebar-nav">
        @include('layouts.menu')
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 692px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 369px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
@endif