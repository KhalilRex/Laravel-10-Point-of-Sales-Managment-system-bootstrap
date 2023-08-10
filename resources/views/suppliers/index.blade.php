@extends('layouts.app')
@section('content')
<div class="container-fluid">
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-9">
            <div class="card" style="background-color: aliceblue">
                <div class="card-header" style="background-color: rgb(63, 11, 112); color:white">
                    <h4 style="float: left">Add suppliers</h4>
                    <a href="#" style="float:right" class="btn btn-dark text-end" data-bs-toggle="modal" data-bs-target="#addUser">
                        <i class='bi bi-person-plus bi-lg me-2'></i>Add New suppliers
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-left">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>PhoneNo</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $key => $suppliers)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $suppliers->Name }}</td>
                                    <td>{{ $suppliers->Address }}</td>
                                    <td>{{ $suppliers->PhoneNo }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{ $suppliers->id }}">
                                                <i class="bi bi-pencil-square"></i>Edit
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $suppliers->id }}">
                                                <i class="bi bi-trash"></i>Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                {{-- ------MODEL FOR EDITING------ --}}
                <div class="modal right fade" id="editUser{{ $suppliers->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit suppliers</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            {{ $suppliers->id }}
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('suppliers.update', $suppliers->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="Name" id="" value="{{ $suppliers->Name }}" class="form-control">
                            </div>
                            <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="Address" id="" value="{{ $suppliers->Address }}" class="form-control">
                            </div>
                            <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="numbers" name="PhoneNo" id="" class="form-control">{{ $suppliers->PhoneNo }}
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal" style="float: left">Close</button>
                            <button type="submit" class="btn btn-primary btn-block">Update suppliers</button>
                            </div>
                            </form>
                            </div>

                        </div>
                    </div>
                </div> <!---end edit modal---->   

                {{-- ------MODEL FOR DELETING------ --}}
                <div class="modal right fade" id="deleteUser{{ $suppliers->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete suppliers</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            {{ $suppliers->id }}
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('suppliers.destroy', $suppliers->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <p class="form-group">Are you sure to delete {{ $suppliers->Name }}  ? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-block " data-bs-dismiss="modal" style="float: left">Cancel</button>
                            <button type="submit" class="btn btn-secondary btn-danger">Delete suppliers</button>
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
                    {{-- $suppliers::links('pagination::bootstrap-4') --}}
                    {{-- $suppliers->onEachSide(5)->links() --}}
                </div>{{-- Pagiantion end... --}}
    
            </div>
            
        </div>
        </div>
        <div class="col-md-3">
        <div class="card" style="background-color: aliceblue">
            <div class="card-header" style="background-color: rgb(63, 11, 112); color:white"><h4>Search suppliers</h4>
            </div>
            <div class="card-body">
            ...........
            </div>
            
        </div>
        </div>
    </div>
    </div>
</div>

{{-- ------MODEL FOR ADDING NEW suppliers------- --}}
<div class="modal right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add suppliers</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="Name" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Address</label>
        <input type="text" name="Address" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">PhoneNo</label>
        <input type="numbers" name="PhoneNo" id="" class="form-control">
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