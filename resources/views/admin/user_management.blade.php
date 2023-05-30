@extends('layout.app')
@section('content')

<section class="section mt-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold">User Management</h5>
                        <button type="button" class="btn btn-primary px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#addUser">Add New User</button>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr>
                                    <th class="">
                                        <h6 class="text-sm text-medium">
                                            No </i>
                                        </h6>
                                    </th>
                                    <th class="">
                                        <h6 class="text-sm text-medium">
                                            Full Name</i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Username</i>
                                        </h6>
                                    </th>
                                    <th class="">
                                        <h6 class="text-sm text-medium">
                                            Email</i>
                                        </h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm ">
                                            Role</i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Additional Information</i>
                                        </h6>
                                    </th>
                                    <th class="">
                                        <h6 class="text-sm ">
                                            Photo URL</i>
                                        </h6>
                                    </th>
                                    <th class="min-width text-center">
                                        <h6 class="text-sm text-medium">
                                            Is Active? </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium text-end">
                                            Actions </i>
                                        </h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                ?>
                                @foreach($users as $u)
                                <tr>
                                    <td>
                                        <p class="text-sm">{{ $no }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $u->name }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $u->username }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $u->email }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $u->role->role_name }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $u->no_hp }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $u->photo }}</p>
                                    </td>

                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox form-switch p-0">
                                            <input class="form-check-input check_product" type="checkbox" id="is_active"
                                                name="is_active" data-id="{{ $u->id }}" @if($u->is_active
                                            == 1) checked @endif>
                                        </div>
                                    </td>
                                    <td class=" text-end" nowrap>
                                        <button type="button" class="btn secondary-btn rounded-full me-1"
                                            data-bs-toggle="modal" data-bs-target="#editUser{{$u->id}}">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                        <button type="button" class="btn danger-btn rounded-full del-user"
                                            data-id="{{ $u->id }}">
                                            <i class="lni lni-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php 
                                    $no++;
                                ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addUserLabel">Add New User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="/admin/user" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="User Name (eg. Yulius)">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="User Name (eg. exampleusername)">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="User Email (eg. example@gmail.com)">
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-select" id="role_id" name="role_id">
                            <option value="">Please select Role</option>
                            @foreach($role as $r)
                            <option value="{{ $r->id }}">{{ $r->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password (eg. inipassword)">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                            placeholder="User Handphone (eg. example@gmail.com)">
                    </div>
                    <div class="mb-3 border-top pt-3">
                        <button type="submit" class="btn btn-primary ms-auto d-block px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($users as $u)
<div class="modal fade" id="editUser{{$u->id}}" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editUserLabel">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="/admin/edit_user" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="User Name (eg. Yulius)" value="{{ $u->name }}">
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $u->id }}">
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-select" id="role_id" name="role_id">
                            <option value="{{ $u->role_id }}">{{ $u->role->role_name }}</option>
                            @foreach($role as $r)
                            <option value="{{ $r->id }}">{{ $r->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 border-top pt-3">
                        <button type="submit" class="btn btn-primary ms-auto d-block px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection