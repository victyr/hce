<?php

namespace App;

use App\Clinic;
use App\Metric;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reported_for', 'total',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'reported_for',
    ];

    /**
     * Clinic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    /**
     * Metric.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function metric()
    {
        return $this->belongsTo(Metric::class, 'metric_id', 'id');
    }

}
