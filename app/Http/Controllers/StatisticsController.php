<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Metric;
use App\Statistics;
use Carbon\Carbon;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_by_week()
    {
        // Fake last week
        $today = Carbon::now();

        $yesterday = $today->subDay();

        // Week days
        $days = week_days($yesterday);

        $week = array();
        foreach ($days as $day) {
            $week[$day] = null;
        }

        // Metrics
        $metrics = \App\Metric::all()->map(function($metric) use($week) {
            return [
                "id" => $metric->id,
                "category" => $metric->category,
                "name" => $metric->name,
                "statistics" => $week,
            ];
        })->toArray();

        // Statistics
        $stats_by_metric = \App\Statistics::where('clinic_id', 1)->get()->groupBy('metric_id');

        $statistics = $stats_by_metric->map(function($metrics) {
            $stat = [];
            foreach ($metrics as $metric) {
                $reported_for = $metric['reported_for'];
                $stat[$reported_for] = $metric['total'];
            }
            return $stat;
        })->toArray();

        // Incorporate statistics into default metrics
        foreach ($metrics as &$metric) {
            if(isset($statistics[$metric['id']])) {
                $stat = $statistics[$metric['id']];
                foreach ($stat as $reported_for => $tally) {
                    $metric['statistics'][$reported_for] = $tally;
                }
            }
        }

        $clinics = Clinic::get();

        return view('statistics.create-week', [
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
