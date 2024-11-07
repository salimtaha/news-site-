@extends('layouts.dashboard.app')
@section('title')
    Home
@endsection
@section('body')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>

    <!-- Content Row -->
    @livewire('admin.statistics')
    <!-- Content Row -->
    {{-- chart row --}}
    <div class="row">

        <div class="card-body shadow col-6">
            <h4>{{ $posts_chart->options['chart_title'] }}</h4>
            {!! $posts_chart->renderHtml() !!}

        </div>
        <div class="card-body shadow col-6">
            <h4> {{ $users_chart->options['chart_title'] }} </h4>
            {!! $users_chart->renderHtml() !!}

        </div>
    </div>

    <!--Posts && Comments Row -->
    <@livewire('admin.latest-posts-comments'))

</div>
@endsection
@push('js')
{!! $posts_chart->renderChartJsLibrary() !!}

{!! $posts_chart->renderJs() !!}
{!! $users_chart->renderJs() !!}
@endpush
