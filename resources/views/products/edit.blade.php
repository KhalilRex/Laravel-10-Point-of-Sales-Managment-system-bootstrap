<div class="modal right fade" id="editUser{{ $products->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Products
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                {{ $products->id }}
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update', $products->id) }}" method="POST" enctype="multipart/form-data" autocomplete = "o">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="Title" id="" value="{{ $products->Title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" name="Description" id="" value="{{ $products->Description }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">categories_Id </label>
                        <input type="text" name="categories_Id" id="" value="{{ $products->categories_Id }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="Image" id="" class="form-control">{{ $products->Image }}
                    </div>
                    <div class="form-group">
                        <label for="">Price </label>
                        <input type="number" name="Price" id="" value="{{ $products->Price }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Quantity </label>
                        <input type="number" name="Sale" id="" value="{{ $products->Sale }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alert Stock </label>
                        <input type="number" name="alert_stock" id="" value="{{ $products->alert_stock }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Image 2</label>
                        <img width="" src="{{ asset('product/images/' .$products->product_image) }}" alt="">
                        <input type="text" name="product_image" id="" 
                            class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal"
                            style="float: left">Close</button>
                        <button type="submit" class="btn btn-primary btn-block">Update
                            Products</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>