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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_by_week()
    {
        $metrics = Metric::all()->map(function($metric) {
          return [
            'id' => $metric->id,
            'category' => $metric->category,
            'name' => $metric->name,
            'total' => null,
          ];
        });

        $statistics = Statistics::where('clinic_id', 1)->get()->groupBy('reported_for');

        $_statistics = array();

        foreach(week_days() as $day) {
            $_metrics = $metrics->toArray();

            if(isset($statistics[$day])) {

                foreach ($statistics[$day] as $metric) {

                    $_metric_idx = array_search($metric->metric_id, array_column($_metrics, 'id'));

                    if(is_numeric($_metric_idx)) {
                        $_metrics[$_metric_idx]['total'] = $metric['total'];
                    }

                }

            }

            $_statistics[$day] = $_metrics;
        }

        $tests = array(
          [
            'id' => 1,
            'category' => 'patients',
            'name' => 'surgeries',
            'statistics' => [
              '2018-11-19' => 5,
              '2018-11-20' => null,
              '2018-11-21' => 6,
              '2018-11-22' => null,
              '2018-11-23' => 15,
              '2018-11-24' => null,
              '2018-11-25' => 0,
            ],
          ],
          [
            'id' => 2,
            'category' => 'staff',
            'name' => 'doctors',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => 8,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 3,
            'category' => 'staff',
            'name' => 'mid-wives',
            'statistics' => [
              '2018-11-19' => 4,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => 8,
              '2018-11-23' => null,
              '2018-11-24' => 3,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 4,
            'category' => 'staff',
            'name' => 'others',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => null,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 5,
            'category' => 'staff',
            'name' => 'support',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => null,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 6,
            'category' => 'staff-hop',
            'name' => 'doctors',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => null,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 7,
            'category' => 'staff-hop',
            'name' => 'mid-wives',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => null,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 8,
            'category' => 'staff-hop',
            'name' => 'others',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => null,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 9,
            'category' => 'staff-hop',
            'name' => 'support',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => null,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 10,
            'category' => 'prescriptions',
            'name' => 'sku',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => null,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 11,
            'category' => 'prescriptions',
            'name' => 'total',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => null,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
          [
            'id' => 12,
            'category' => 'prescriptions',
            'name' => 'unfilled',
            'statistics' => [
              '2018-11-19' => null,
              '2018-11-20' => null,
              '2018-11-21' => null,
              '2018-11-22' => null,
              '2018-11-23' => null,
              '2018-11-24' => null,
              '2018-11-25' => null,
            ],
          ],
        );

        // return response()->json($tests);

        $clinics = Clinic::get();

        return view('statistics.create-week', [
            'clinics' => $clinics,
            'metrics' => $tests,
            // 'statistics' => $_statistics,
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
