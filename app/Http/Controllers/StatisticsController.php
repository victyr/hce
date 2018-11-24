<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Metric;
use App\Statistics;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{

    /**
     * StatisticsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statistics = Statistics::with(['clinic', 'metric'])->get();

        return view('statistics.index', [
            'statistics' => $statistics,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinics = Clinic::get();
        $metrics = Metric::all()->groupBy('category');

        return view('statistics.create', [
            'clinics' => $clinics,
            'metrics' => $metrics,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'clinic' => 'required|integer|exists:clinics,id',
            'metric' => 'required|integer|exists:metrics,id',
            'report_date' => 'required|date',
            'total' => 'required|integer',
        ]);

        $clinic = Clinic::first();
        $metric = Metric::first();

        $stat = new Statistics();
        // $stat->clinic()->associate($clinic);
        $stat->clinic_id = $request->clinic;
        // $stat->metric()->associate($metric);
        $stat->metric_id = $request->metric;
        $stat->reported_for = $request->report_date;
        $stat->total = $request->total;
        $stat->save();

        return redirect()->route('statistics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Statistics  $statistics
     * @return \Illuminate\Http\Response
     */
    public function show(Statistics $statistics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Statistics  $statistics
     * @return \Illuminate\Http\Response
     */
    public function edit(Statistics $statistics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Statistics  $statistics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statistics $statistics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Statistics  $statistics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statistics $statistics)
    {
        //
    }
}
