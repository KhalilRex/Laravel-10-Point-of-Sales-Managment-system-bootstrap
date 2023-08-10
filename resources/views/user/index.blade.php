@extends('layouts.app')
@section('content')
<div class="container-fluid">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-md-9">
            <div class="card" style="background-color: aliceblue">
              <div class="card-header" style="background-color: rgb(63, 11, 112); color:white">
                <h4 style="float: left">  Add users</h4>
                <a href="#" style="float:right" class="btn btn-dark text-end" data-bs-toggle="modal" data-bs-target="#addUser">
                  <i class='bi bi-person-plus bi-lg me-2'></i>Add New user</a>
              </div>
                  <div class="card-body">
                  <table class="table table-bordered table-left">
                    <thead>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Role</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                     @foreach ($user as $key =>$user)
                     <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->phoneNumber }}</td>
                      <td> 
                        @if ($user->is_admin == 1)Admin      
                        @else User   
                        @endif 
                      </td>
                      <td>
                        <div class="btn-group">
                          <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{ $user->id }}">
                            <i class="bi bi-pencil-square">
                              </i>Edit</a>
                        </div>
                        <div class="btn-group">
                          <a href="#" class="btn btn-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}"><i class="bi bi-trash"></i>Delete</a>
                        </div>
                      </td>
                      

                     </tr>
                    {{-- ------MODEL FOR EDITING/Update------ --}}
                    <div class="modal right fade" id="editUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Employee</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            {{ $user->id }}
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                              @csrf
                              @method('put')
                              <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" id="" value="{{ $user->name }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" id="" value="{{ $user->email }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phoneNumber" id="" value="{{ $user->phoneNumber }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="">Password</label>
                                <input name="password" id="" class="form-control" value="{{ $user->password }}">
                              </div>
                              <div class="form-group">
                                <label for="" data-error="wrong" data-success="right" for="defaultForm-pass">Role</label>
                                <select name="is_admin" id="" class="form-control">
                                  <option value="1"
                                  @if ($user->is_admin ==1)
                                      selected
                                  @endif>Admin</option>
                                  <option value="2"
                                  @if ($user->is_admin ==2)
                                      selected
                                  @endif>User</option>
                                </select>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal" style="float: left">Close</button>
                                <button type="submit" class="btn btn-primary btn-block">Update Employee</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    

                    {{-- ------MODEL FOR DELETING------ --}}
                    <div class="modal right fade" id="deleteUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete user</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              {{ $user->id }}
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <p class="form-group">Are you sure to delete {{ $user->name }} ? </p>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-block " data-bs-dismiss="modal" style="float: left">Cancel</button>
                            <button type="submit" class="btn btn-secondary btn-danger">Delete user</button>
                          </div>
                            </form>
                          </div>
                    
                        </div>
                      </div>
                    </div> <!---end delete modal---->   
                    @endforeach

                    </tbody>
                  </table>
                </div>
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="card" style="background-color: aliceblue">
              <div class="card-header" style="background-color: rgb(63, 11, 112); color:white">
                <h4>Search user</h4>
              </div>
                <div class="card-body">
                ...........
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>

   {{-- ------MODEL FOR ADDING NEW USER/user------- --}}
<div class="modal right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" id="" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" name="email" id="" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Phone Number</label>
          <input type="text" name="phoneNumber" id="" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" name="password" id="" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Role</label>
             <select name="is_admin" id="" class="form-control">
              <option value="1">Admin</option>
              <option value="2">User</option>
             </select>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-block">Save User</button>
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