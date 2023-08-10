@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card" style="background-color: aliceblue">
                        <div class="card-header" style="background-color: rgb(63, 11, 112); color:white">
                            <h4 style="float: left"> Add products</h4>
                            <a href="#" style="float:right" class="btn btn-dark text-end" data-bs-toggle="modal"
                                data-bs-target="#addUser">
                                <i class='bi bi-person-plus bi-lg me-2'></i>Add New products</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Categories ID</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Alert Stocks</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $products)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $products->Title }}</td>
                                            <td>{{ $products->Description }}</td>
                                            <td>{{ $products->categories_Id }}</td>
                                            <td>{{ $products->Image }}</td>
                                            <td>{{ $products->Price }}</td>
                                            <td>{{ $products->Sale }}</td>
                                            <td>
                                                @if ($products->alert_stock >= $products->Sale)
                                                    <span class="badge bg-danger text-white"> > <!--Low Stocks --->
                                                        {{ $products->alert_stock }}</span>
                                                @else<span
                                                        class="badge bg-success text-white">{{ $products->alert_stock }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editUser{{ $products->id }}">
                                                        <i class="bi bi-pencil-square">
                                                        </i>Edit</a>
                                                </div>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteUser{{ $products->id }}"><i
                                                            class="bi bi-trash"></i>Delete</a>
                                                </div>
                                            </td>


                                        </tr>
                                        {{-- ------MODEL FOR EDITING------ --}}
                                        @include('products.edit')
                                        

                                        {{-- ------MODEL FOR DELETING------ --}}
                                        <div class="modal right fade" id="deleteUser{{ $products->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete
                                                            Products</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        {{ $products->id }}
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        <form action="{{ route('products.destroy', $products->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <p class="form-group">Are you sure to delete
                                                                {{ $products->Title }} ? </p>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary btn-block "
                                                                    data-bs-dismiss="modal"
                                                                    style="float: left">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-secondary btn-danger">Delete
                                                                    Products</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!---end delete modal---->
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="row">
                                {{-- $products::links('pagination::bootstrap-4') --}}
                                {{-- $products->onEachSide(5)->links() --}}
                            </div>{{-- Pagiantion end --}}
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="background-color: aliceblue">
                        <div class="card-header" style="background-color: rgb(63, 11, 112); color:white">
                            <h4>Search Products</h4>
                        </div>
                        <div class="card-body">
                            ...........
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ------MODEL FOR ADDING NEW products------- --}}
    <div class="modal right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Products</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="Title" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="Description" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Categories Id</label>
                            <input type="text" name="categories_Id" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Product Code</label>
                            <input type="text" name="product_code" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="Image" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="Price" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="number" name="Sale" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Alert Stock </label>
                            <input type="number" name="alert_stock" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Code Image</label>
                            <input type="file" name="product_image" id="" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!---end of add model--->




    <style>
        .modal.right .modal-dialog {
            top: 0%;
            right: 0%;
            margin-right: 20vh;
        }

        .modal.fade:not(.in).right .modal-dialog {
            -webkit-transform: translate3d(25%, 0, 0);
            transform: translate3d(25%, 0, 0)
        }
    </style>
@endsection
