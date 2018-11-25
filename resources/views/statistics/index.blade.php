@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Statistics

                    <div class="float-right">
                        <a href="{{ route('statistics.create') }}">
                            <i class="fa fa-plus"></i>&nbsp;New
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    <div class="row">
                        <div class="col-12">
                            <table id="tbl_statistics" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Clinic</th>
                                        <th>Category</th>
                                        <th>Metric</th>
                                        <th>Reported For</th>
                                        <th>Total</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($statistics as $stat)
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    {{ $stat->id }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $stat->clinic->name }}
                                            </td>
                                            <td>
                                                {{ $stat->metric->category }}
                                            </td>
                                            <td>
                                                {{ $stat->metric->name }}
                                            </td>
                                            <td>
                                                {{ $stat->reported_for }}
                                            </td>
                                            <td>
                                                {{ $stat->total }}
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
