@extends('layouts.app')
@section('content')
<div class="container-fluid">
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-9">
            <div class="card" style="background-color: aliceblue">
                <div class="card-header" style="background-color: rgb(63, 11, 112); color:white">
                    <h4 style="float: left">Add category</h4>
                    <a href="#" style="float:right" class="btn btn-dark text-end" data-bs-toggle="modal" data-bs-target="#addUser">
                        <i class='bi bi-person-plus bi-lg me-2'></i>Add New category
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-left">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($category as $key => $category)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $category->Title }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->image }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{ $category->id }}">
                                                <i class="bi bi-pencil-square"></i>Edit
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $category->id }}">
                                                <i class="bi bi-trash"></i>Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                {{-- ------MODEL FOR EDITING------ --}}
                <div class="modal right fade" id="editUser{{ $category->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            {{ $category->id }}
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="Title" id="" value="{{ $category->Title }}" class="form-control">
                            </div>
                            <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="description" id="" value="{{ $category->description }}" class="form-control">
                            </div>
                            <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" id="" class="form-control">{{ $category->image }}
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal" style="float: left">Close</button>
                            <button type="submit" class="btn btn-primary btn-block">Update category</button>
                            </div>
                            </form>
                            </div>

                        </div>
                    </div>
                </div> <!---end edit modal---->   

                {{-- ------MODEL FOR DELETING------ --}}
                <div class="modal right fade" id="deleteUser{{ $category->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            {{ $category->id }}
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <p class="form-group">Are you sure to delete {{ $category->Title }}  ? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-block " data-bs-dismiss="modal" style="float: left">Cancel</button>
                            <button type="submit" class="btn btn-secondary btn-danger">Delete category</button>
                        </div>
                            </form>
                        </div>
                    
                        </div>
                    </div>
                    </div> <!---end delete modal---->
                    
                    @endforeach
                        
                    </tbody>
                </table>
                <div class="row">
                    {{-- $category::links('pagination::bootstrap-4') --}}
                    {{-- $category->onEachSide(5)->links() --}}
                </div>{{-- Pagiantion end... --}}
    
            </div>
            
        </div>
        </div>
        <div class="col-md-3">
        <div class="card" style="background-color: aliceblue">
            <div class="card-header" style="background-color: rgb(63, 11, 112); color:white"><h4>Search category</h4>
            </div>
            <div class="card-body">
            ...........
            </div>
            
        </div>
        </div>
    </div>
    </div>
</div>

{{-- ------MODEL FOR ADDING NEW category------- --}}
<div class="modal right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add category</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Title</label>
        <input type="text" name="Title" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Description</label>
        <input type="text" name="description" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">image</label>
        <input type="file" name="image" id="" class="form-control">
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-primary btn-block">Save</button>
    </div>
    </form>
    </div>

</div>
</div>
</div><!---end of add model--->




<style>
.modal.right .modal-dialog{
top:0%;
right: 0%;
margin-right: 20vh;
}
.modal.fade:not(.in).right .modal-dialog{
-webkit-transform: translate3d(25%,0,0);
transform: translate3d(25%,0,0)
}
</style>
@endsection