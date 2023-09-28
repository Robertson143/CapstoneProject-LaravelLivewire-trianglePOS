
    <style>
    /*    @keyframes rotateImage {
             0%{
      transform: rotateX(0deg) rotateY(360deg) rotateZ(0deg);
    }
    100%{
      transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
            }
        } */
        </style> 

<button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
    <i class="bi bi-list" style="font-size: 2rem; "></i>
</button>

@if (auth()->check() && auth()->user()->email !== 'cashier@test.com')
<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
    <i class="bi bi-list" style="font-size: 2rem;"></i>
</button>
@endif
    @php
      $allowedEmails = ['cashier@test.com', 'cashier@gmail.com']; 
            $userEmail = auth()->user()->email;
                @endphp

                @if(in_array($userEmail, $allowedEmails))
 <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
          <img class="c-sidebar-brand-minimized" src="{{ asset('images/Logo.png') }}" alt="Site Logo" width="40"> <!--style="animation: rotateImage 5s linear infinite; -->
    </button> 
  @endif
  

<ul class="c-header-nav ml-auto mr-4">
@php
$allowedEmails = ['admin@test.com','manager@test.com']; 
$userEmail = auth()->user()->email;
@endphp

@if(in_array($userEmail, $allowedEmails))
<!--<div class="types">
<h1>
    <span  class="multiple-text text-muted" style="text-shadow: 2px 2px violet; align-items: center; font-family: 'Times New Roman', serif;">
    </span>
</h1>
    </div> -->
@endif

        @can('create_pos_sales')
            @php
                $allowedEmails = ['cashier@test.com', 'cashier@gmail.com']; 
                $userEmail = auth()->user()->email;
            @endphp

            @if(in_array($userEmail, $allowedEmails))
            <h5 style="margin-right: 480px; margin-top: 10px; text-shadow: 1px 1px violet; color: black;">Point of Sale in AZ Variety Store</h5>
            <li class="c-header-nav-item mr-3">
                    <a class="btn btn-primary btn-pill {{ request()->routeIs('app.pos.index') ? 'disabled' : '' }}" href="{{ route('app.pos.index') }}">
                        <i class="bi bi-cart mr-1"></i> Cashier
                    </a>
                </li>

                <li class="c-header-nav-item mr-3">
                    <a class="btn btn-primary btn-pill {{ request()->routeIs('sales.index') ? 'disabled' : '' }}" href="{{ route('sales.index') }}">
                    <i class="bi bi-journals"></i> Transactions
                    </a>
                </li>
                
                <li class="c-header-nav-item mr-3">
                    <a class="btn btn-primary btn-pill {{ request()->routeIs('sales-report.index') ? 'disabled' : '' }}" href="{{ route('sales-report.index') }}">
                    <i class="bi bi-clipboard-data"></i>  Sales Report
                    </a>
                </li>   
                
            @endif
        @endcan


    @can('show_notifications')
    <li class="c-header-nav-item dropdown d-md-down-none mr-2">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-bell" style="font-size: 20px;"></i>
            <span class="badge badge-pill badge-danger">
            @php
                $low_quantity_products = \Modules\Product\Entities\Product::select('id', 'product_quantity', 'product_stock_alert', 'product_code')->whereColumn('product_quantity', '<=', 'product_stock_alert')->get();
                echo $low_quantity_products->count();
            @endphp
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
            <div class="dropdown-header bg-light">
                <strong>{{ $low_quantity_products->count() }} Notifications</strong>
            </div>
            @forelse($low_quantity_products as $product)
                <a class="dropdown-item" href="{{ route('products.show', $product->id) }}">
                    <i class="bi bi-hash mr-1 text-primary"></i> Product: "{{ $product->product_code }}" is low in quantity!
                </a>
            @empty
                <a class="dropdown-item" href="#">
                    <i class="bi bi-app-indicator mr-2 text-danger"></i> No notifications available.
                </a>
            @endforelse
        </div>
    </li>
    @endcan

    <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
           aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar mr-2">
                <img class="c-avatar rounded-circle" src="{{ auth()->user()->getFirstMediaUrl('avatars') }}" alt="Profile Image">
            </div>
            <div class="d-flex flex-column">
                <span class="font-weight-bold">{{ auth()->user()->name }}</span>
                <span class="font-italic">Online <i class="bi bi-circle-fill text-success" style="font-size: 11px;"></i></span>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
            <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                <i class="mfe-2  bi bi-person" style="font-size: 1.2rem;"></i> Profile
            </a>
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mfe-2  bi bi-box-arrow-left" style="font-size: 1.2rem;"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>
