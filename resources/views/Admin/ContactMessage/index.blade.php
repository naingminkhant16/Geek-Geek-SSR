@extends('layouts.admin')
@section('title',"Contact Messages")

@section('content')
<div class="container-fluid">
    <x-admin.menuBar>
        <p class="mb-0 text-primary">
            <i class="bi bi-chat-square-heart-fill"></i>
            Contact Messages
        </p>
    </x-admin.menuBar>
    <div class="mt-3 bg-white rounded-3 p-3 shadow">
        <div class="row">
            @foreach ($contacts as $contact)
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-black-50">From :</small>
                                <span
                                    class="@if ($contact->is_read) text-black-50 @else text-black @endif">{{$contact->name}}</span><br>
                                <small class="text-black-50">Email :</small>
                                <small
                                    class="@if ($contact->is_read) text-black-50 @else text-black @endif">{{$contact->email}}</small>
                            </div>
                            <div>
                                @if ($contact->is_read)
                                <span class="text-black-50">Read <i class="bi bi-check-circle-fill"></i></span>
                                @else
                                <form action="{{route('admin.contact-messages.markAsRead',$contact->id)}}"
                                    id="markAsReadForm-{{$contact->id}}" method="POST">
                                    @csrf
                                    @method("PATCH")
                                    <button type="submit" class="btn btn-white text-success btn-sm "
                                        form="markAsReadForm-{{$contact->id}}">
                                        Mark as read <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                @endif
                                <small
                                    class="text-black-50 d-block text-end">{{$contact->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text @if ($contact->is_read) text-black-50 @else text-black @endif"
                            style="text-align: justify">
                            {{$contact->message}}
                        </p>
                        @if ($contact->is_read)
                        <div class="float-end">
                            <form action="{{route('admin.contact-message.delete',$contact->id)}}" method="POST"
                                class=" d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-white">
                                    <i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="">
            {{$contacts->links()}}
        </div>
    </div>

</div>
@endsection