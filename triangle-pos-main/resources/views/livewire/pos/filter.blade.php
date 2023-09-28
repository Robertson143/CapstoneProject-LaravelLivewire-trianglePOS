<div>
    <div class="form-row">
        <div class="col-md-7">
            <div class="form-group">
                <label>Product Category</label>
                <select wire:model="category" class="form-control">
                    <option value="">All Products Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Product Count</label>
                <select wire:model="showCount" class="form-control">
                    <option value="10">All Products</option>
                    <option value="15">15 Products</option>
                    <option value="20">20 Products</option>
                    <option value="25">25 Products</option>
                    <option value="30">30+ Products</option>
                </select>
            </div>
        </div>
    </div>
</div>
