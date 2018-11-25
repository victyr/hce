@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Capture Weekly Statistics</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{ route('statistics.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="clinic" class="col-sm-2 col-form-label">{{ __('Clinic') }}</label>

                                    <div class="col-sm-4">

                                        <select id="clinic" type="number" class="form-control{{ $errors->has('clinic') ? ' is-invalid' : '' }}"
                                        name="clinic">
                                            <option value="" selected disabled>Choose clinic</option>
                                            @foreach ($clinics as $clinic)
                                                <option value="{{ $clinic->id }}" {{ old('clinic') == $clinic->id ? 'selected' : '' }}>
                                                    {{ $clinic->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('clinic'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('clinic') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <table id="tbl_statistics" class="table">
                                    <thead>
                                        <tr>
                                            <th>Metric</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thur</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                            <th>Sun</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($metrics as $metric)
                                            <tr>
                                                <td><strong>{{ $metric['category'] }}</strong>.{{ $metric['name'] }}</td>
                                                @foreach ($metric['statistics'] as $day => $tally)
                                                    <td>{{ $tally }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="form-group row mb-0">
                                    <div class="col-sm-4 offset-sm-8">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
