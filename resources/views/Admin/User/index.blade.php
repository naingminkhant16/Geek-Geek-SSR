@extends('layouts.admin')
@section('title','Posts')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <x-admin.menuBar>
                <a href="{{route('admin.users.index')}}" class="mb-0 text-decoration-none text-primary">
                    <span class="">
                        <i class="bi bi-people-fill"></i>
                        Users
                    </span>
                </a>
                <span class="text-black-50">|</span>
                <a href="{{route('admin.users.deletedUsers')}}" class="mb-0 text-decoration-none text-black-50">
                    <span class="">
                        Deleted Users
                        <i class="bi bi-trash-fill"></i>
                    </span>
                </a>
            </x-admin.menuBar>
        </div>
        <div class="col-12">
            <div class="mt-3 shadow p-3 rounded-3 bg-white overflow-auto">
                <table class="table text-start text-black-50 table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Is Verify</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>
                                <x-avatar :path="$user->profile" width="30" /> {{$user->name}}
                            </td>
                            <td>{{$user->email}} <a href=""><i class="bi bi-envelope-fill"></i></a></td>
                            <td>
                                {!!$user->is_admin?'<span class="badge bg-danger">Admin</span>':
                                '<span class="badge bg-primary">User</span>';!!}

                                @if ($user->id!==auth()->id())
                                <form action="{{route('admin.users.changeRole',$user->username)}}" class="d-none"
                                    method="POST" id="changeRoleForm{{$user->id}}">
                                    @csrf
                                    @method('PATCH')
                                </form>
                                <button type="submit" form="changeRoleForm{{$user->id}}"
                                    class=" bg-transparent border-0 text-primary"><small>Change Role</small></button>
                                @endif
                            </td>
                            <td>
                                {!!$user->email_verified_at?
                                '<i class="bi bi-check-lg text-success fs-5"></i>':
                                '<i class="bi bi-x-lg text-danger fs-5"></i>';!!}
                            </td>
                            <td class="">
                                <a href="{{route('users.edit',$user->username)}}"
                                    class="text-decoration-none btn btn-sm btn-primary me-1">
                                    <i class="bi bi-pencil-fill text-white"></i>
                                </a>
                                <a href="{{route('users.show',$user->username)}}"
                                    class="text-decoration-none btn btn-sm btn-success me-1">
                                    <i class="bi bi-eye-fill text-white"></i>
                                </a>
                                @if ($user->id !==auth()->id())
                                <form action="{{route('admin.users.softDelete',$user->id)}}" class="d-none"
                                    method="POST" id="deleteUser{{$user->id}}">
                                    @csrf
                                    @method('delete')
                                </form>
                                <button form="deleteUser{{$user->id}}" type="submit"
                                    class="text-decoration-none btn btn-sm btn-danger me-1">
                                    <i class="bi bi-trash-fill text-white"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
    <a href="" class="position-fixed" style="right:30px;bottom:30px;font-size:50px"><i
            class="bi bi-plus-circle-fill"></i></a>
</div>

@endsection
