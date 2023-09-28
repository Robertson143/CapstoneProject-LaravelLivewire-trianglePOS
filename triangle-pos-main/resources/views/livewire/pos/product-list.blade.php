<div>
    <div class="card border-0 shadow-sm mt-3">
        <div class="card-body">
            <livewire:pos.filter :categories="$categories"/>
            <div class="row position-relative">
                <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @forelse($products as $product)
                    <div wire:click.prevent="selectProduct({{ $product }})" class="col-lg-4 col-md-4 mb-3" style="cursor: pointer;">
                        <div class="card border-0 shadow h-100" style="height: 300px; /* Adjust the height as needed */">
                            <div class="position-relative">
                                <img height="100" " border="0" width="50" class="img-thumbnail" align="center" src="{{ $product->getFirstMediaUrl('images') }}" class="card-img-top" alt="Product Image">
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                   
                                    <p class="card-text font-weight-bold" style="font-size: 12px; margin-top: -68px; margin-left: 40px;">{{ $product->product_name }} </p>
                                    <h6  class="card-title mb-0" style="font-size: 12px; margin-left: -15px;">Price: {{ format_currency($product->product_price) }}</h6>
                                    
                                    
                                    <p class="card-text text-muted" style="font-size: 10px;  margin-left: -15px;">  {{ $product->product_note }} </p>
                                    <span class="badge badge-info" style="font-size: 10px; margin-top: -50px; margin-left: -15px;">
                                       Stock: {{ $product->product_quantity }}
                                    </span> 
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning mb-0">
                            Products Not Found...
                        </div>
                    </div>
                @endforelse
            </div>
            <div @class(['mt-3' => $products->hasPages()])>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
