@extends('layouts.admin')
@section('title',"Create User")
@section('content')
<div class="d-flex justify-content-start bg-white rounded-3 p-3 shadow">
    <div class="">
        <a href="{{route('admin.users.index')}}" class="text-black-50 text-decoration-none"><i
                class="bi bi-arrow-left"></i>
            <i class="bi bi-people-fill"></i> Users |
        </a>
        <span class="text-primary">
            Create New User
            <i class="bi bi-person-plus-fill"></i>
        </span>
    </div>
</div>
<div class="bg-white rounded-3 p-3 mt-3 shadow">
    <form class="row g-3" action="{{route('admin.users.store')}}" method="POST">
        @csrf
        <div class="col-md-6">
            <x-input name="name" label="Name" :value="old('name')" />
        </div>
        <div class="col-md-6">
            <x-input name="email" label="Email" :value="old('email')" type="email" />
        </div>
        <div class="col-md-6">
            <x-input name="password" label="Password" :value="old('password')??'password'" type="password" />
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-select" id="floatingSelect" name="is_admin" aria-label="Choose Role" required>
                    <option selected disabled>Choose Role...</option>
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                </select>
                <label for="floatingSelect">Role</label>
            </div>
            @error('is_admin')
            <span class="invalid-feedback" role="alert">
                <strong class="">*{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-12">
            <x-input name="bio" label="Bio" :value="old('bio')" />
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="email_verified_at" id="Check">
                <label class="form-check-label" for="Check">
                    Email is verified.
                </label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary text-white" type="submit">Create</button>
        </div>
    </form>

</div>
@endsection
