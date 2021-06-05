<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
    	'wakeup_time',
    	'bed_time',
    	'tea_143_quantity',
    	'tea_143_quatity_type',
    	'tea_11_quantity',
    	'tea_11_quatity_type',
    	'tea_55_quantity',
    	'tea_55_quatity_type',
    	'tea_all_day_quantity',
        'tea_143_times',
        'tea_11_times',
        'tea_55_times',
        'drops_I_times',
        'drops_II_times',
    ];

    public function getWakeUpHoursAttribute()
    {
    	$wakeup_time = Carbon::create($this->wakeup_time);
    	$bed_time = Carbon::create($this->bed_time);
    	return $wakeup_time->diffInHours($bed_time);
    }

    public function getTea143Times()
    {
        return explode(',', $this->tea_143_times);
    }

    public function getTea11Times()
    {
        return explode(',', $this->tea_11_times);
    }

    public function getTea55Times()
    {
        return explode(',', $this->tea_55_times);
    }

    public function getDropsITimes()
    {
        return explode(',', $this->drops_I_times);
    }

    public function getDropsIITimes()
    {
        return explode(',', $this->drops_II_times);
    }
    /**
     *  @param $t|string
     *  @param $date CarbonImmutable|null
     *  @return Carbon
     *
     * if date is null then this is for current day
     *  otherwise we must make datetime from $t and $date
     * 
    */
    public function getCarbonTimeFromTime($t, $date = null)
    {
        if(is_null($t))
            return Carbon::now();

        list($hours,$minutes) = explode(':', $t);
        if($date == null)
            $time = Carbon::createFromTime($hours, $minutes, 0);
        else {
            $time = Carbon::parse($date);
            $time->setHours("11");
            $time->setMinutes((int)$minutes);
        }
        return $time;
    }
}
?>