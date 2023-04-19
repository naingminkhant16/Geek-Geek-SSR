@extends('layouts.admin')
@section('title',"Dashboard")

@section('content')
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-12 col-lg-3">
            <div class="bg-primary bg-gradient bg-opacity-75 p-4 rounded-3 shadow">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h3 class="text-black-50">{{$data['Users']->sum()}}</h3>
                        <span class="text-black-50">Total Users</span>
                    </div>
                    <div class="">
                        <i class="bi bi-person-fill fs-1 text-black-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="p-4 rounded-3 shadow" style="background-color: rgba(69, 235, 165,0.75)">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h3 class="text-black-50">{{$data['Posts']->sum()}}</h3>
                        <span class="text-black-50">Total Posts</span>
                    </div>
                    <div class="">
                        <i class="bi bi-file-post fs-1 text-black-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="bg-danger bg-gradient bg-opacity-75 p-4 rounded-3 shadow">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h3 class="text-white">{{$data['Likes']->sum()}}</h3>
                        <span class="text-white">Total Likes</span>
                    </div>
                    <div class="">
                        <i class="bi bi-heart-fill fs-1 text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="bg-warning bg-gradient bg-opacity-75 p-4 rounded-3 shadow">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h3 class="text-black-50">{{$data['Comments']->sum()}}</h3>
                        <span class="text-black-50">Total Comments</span>
                    </div>
                    <div class="">
                        <i class="bi bi-chat-left-text-fill fs-1 text-black-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mt-1">
        {{-- generate chart html ui --}}
        @foreach ($data as $key=>$chart)
        <div class="col-12 col-lg-6">
            <div class="p-3 bg-white rounded-3 shadow">
                <canvas id="chart{{$key}}"></canvas>
            </div>
        </div>
        @endforeach

    </div>
</div>
</div>
@push('scripts')
<script type="module">
    // generate data to show chart
    @foreach ($data as $key=>$chart)

    showChart('{!! $chart !!}','chart{{$key}}','{{$key}}')

    @endforeach
</script>
@endpush

@endsection