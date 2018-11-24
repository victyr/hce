@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Capture Statistics</div>

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
                                    <label for="clinic" class="col-sm-4 col-form-label">{{ __('Clinic') }}</label>

                                    <div class="col-sm-8">

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

                                <div class="form-group row">
                                    <label for="metric" class="col-sm-4 col-form-label">{{ __('Metric') }}</label>

                                    <div class="col-sm-8">
                                        <select id="metric" type="number" class="form-control{{ $errors->has('metric') ? ' is-invalid' : '' }}"
                                        name="metric">
                                            <option value="" selected disabled>Choose metric</option>
                                            @foreach ($metrics as $category => $_metrics)
                                                <optgroup label="{{ $category }}">
                                                    @foreach ($_metrics as $metric)
                                                        <option value="{{ $metric->id }}" {{ old('metric') == $metric->id ? 'selected' : '' }}>
                                                            {{ $metric->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('metric'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('metric') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="report_date" class="col-sm-4 col-form-label">{{ __('Report For') }}</label>

                                    <div class="col-sm-8">
                                        <input id="report_date" type="date"
                                        class="form-control{{ $errors->has('report_date') ? ' is-invalid' : '' }}"
                                        name="report_date" value="{{ old('report_date') }}" {{-- required --}}>

                                        @if ($errors->has('report_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('report_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total" class="col-sm-4 col-form-label">{{ __('Total') }}</label>

                                    <div class="col-sm-8">
                                        <input id="total" type="number" class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}"
                                        name="total" value="{{ old('total') }}" {{-- required --}}>

                                        @if ($errors->has('total'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('total') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-sm-8 offset-sm-4">
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
