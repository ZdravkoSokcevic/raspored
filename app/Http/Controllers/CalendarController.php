<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use App\Models\Settings;
use App\Models\Calendar;

class CalendarController extends Controller
{
    public function display(Request $r, $date = null)
    {
    	$settings = Settings::first();
        if(is_null($settings)) {
            return redirect()->to('/settings');
        }
    	$tea_143_times = !is_null($settings)? $settings->getTea143Times() : []; 
    	$tea_11_times = !is_null($settings)? $settings->getTea11Times() : [];
    	$tea_55_times = !is_null($settings)? $settings->getTea55Times() : [];
        $drops_I_times = !is_null($settings)? $settings->getDropsITimes() : [];
        $drops_II_times = !is_null($settings)? $settings->getDropsIITimes() : [];

    	$date = $r->filled('date')? CarbonImmutable::create($r->date) : CarbonImmutable::now();

    	$calendar_143 = Calendar::where('date', $date->format('Y-m-d'))
            ->where('tea', '143')
            ->get();
    	$calendar_11 = Calendar::where('date', $date->format('Y-m-d'))
            ->where('tea', '11')
            ->get();
    	$calendar_55 = Calendar::where('date', $date->format('Y-m-d'))
            ->where('tea', '55')
            ->get();
    	$calendar_drops_I = Calendar::where('date', $date->format('Y-m-d'))
            ->where('tea', 'I')
            ->get();
    	$calendar_drops_II = Calendar::where('date', $date->format('Y-m-d'))
            ->where('tea', 'II')
            ->get();

    	$calendar = Calendar::where('date', $date->format('Y-m-d'))->first();
    	if(is_null($calendar))
    		$calendar = new Calendar;
    	return view('pages.calendar', [
    		'active'=>'calendar',
    		'date' => $date,
    		'times' => $this->getAllTeaTimeRanges(),
    		'settings' => $settings,
    		'calendar' => $calendar,
    		'tea_143_times' => $tea_143_times,
    		'tea_11_times' => $tea_11_times,
    		'tea_55_times' => $tea_55_times,
            'drops_I_times' => $drops_I_times,
            'drops_II_times' => $drops_II_times,
            'calendar_143_uses' => $calendar_143,
            'calendar_11_uses' => $calendar_11,
            'calendar_55_uses' => $calendar_55,
            'calendar_drops_I_uses' => $calendar_drops_I,
            'calendar_drops_II_uses' => $calendar_drops_II,
    	]);
    	// ToDo resolve overview times from settings wakeup and bed times, and tea times
    }
    public function update(Request $r)
    {
        $errors = [];
        if(!$this->validateR($r, $errors))
            return response()->json([
                'sucess' => 'false',
                'message' => 'Validation error',
                'errors' => [

                ]
            ]);
        $date = Carbon::parse($r->date);
        $calendar = Calendar::where([
            'tea' => $r->tea,
            'date' => $date,
            'time' => $r->time
        ])->first();
        if($calendar == null)
            $calendar = new Calendar;
        $this->modifyRequest($r);
        $calendar->fill($r->only($calendar->getFillable()));
        if(!$calendar->save())
            return response()->json([
                'success' => 'false',
                'message' => 'Failed to save data!',
                'calendar' => $calendar
            ]);

        return response()->json([
            'success' => 'true',
            'message' => 'Data saved sucessifully',
            'calendar' => $calendar
        ]);
    }

    public function delete(Request $r)
    {
        $errors = [];
        if(!$this->validateR($r, $errors))
            return response()->json([
                'success' => 'false',
                'message' => 'Validation error',
                'errors' => [

                ]
            ]);

        $date = Carbon::parse($r->date);
        $calendar = Calendar::where([
            'tea' => $r->tea,
            'date' => $date,
            'time' => $r->time
        ])->first();

        if($calendar == null) 
        {
            return response()->json([
                'success' => 'false',
                'message' => 'Record not found'
            ]);
        }

        if(!$calendar->delete()) 
        {
            return response()->json([
                'success' => 'false',
                'message' => 'Cannot delete record' 
            ]);
        }

        return response()->json([
            'success' => 'true',
            'message' => 'Data saved!'
        ]);
    }

    public function modifyRequest(Request &$r)
    {
        $data = $r->all();
        $used = false;
        if($r->filled('status') && $data['status'] != 1) 
            $data['used'] = false;

        $time = Carbon::parse($r->date);
        $data['date'] = $time;
        $r->replace($data);
    }

    public function validateR(Request $r, &$errors)
    {
        $data = $r->all();
        if(
            $this->notFilled($r, 'tea') || 
            $this->notFilled($r, 'time') || 
            $this->notFilled($r, 'date')
        ) {
            return false;
        }
        return true;
    }

    public function notFilled(Request $r, $key) 
    {
        return !array_key_exists($key, $r->all()) || empty($r->$key);
    }

    public function getAllTeaTimeRanges()
    {
        $times = [];
        $default_times = $this->defaultTimes;
        $settings = Settings::first();
        $wakeup_time = CarbonImmutable::parse($settings->wakeup_time);
        $sleep_time = Carbon::parse($settings->bed_time);
        foreach($default_times as $i => $time) {
            $c_time = Carbon::parse($time);
            $time_year = $c_time->format('Y');
            $time_month = $c_time->format('m');
            $time_day = $c_time->format('d');
            $wakeup_time->setYear($time_year);
            $wakeup_time->setMonth($time_month);
            $wakeup_time->setDay($time_day);

            $sleep_time->year = $time_year;
            $sleep_time->month = $time_month;
            $sleep_time->day = $time_day;

            
            if(($c_time->gt($wakeup_time) && $c_time->lt($sleep_time)) || 
                $time == $wakeup_time->format('H:i') || 
                $time == $sleep_time->format('H:i')
            ) {
                $times[] = $time;
            }
        }
        return $times;
    }

    public function check(Request $r)
    {
        $now = Carbon::now();

        // ToDo use times from settings
        $settings = Settings::first();
        if(is_null($settings))
            return response()->json([
                'success' => 'true',
                'message' => 'Empty settings',
                'data' => []
            ]);

        $tea_143_times = $settings->getTea143Times();
        $tea_11_times = $settings->getTea11Times();
        $tea_55_times = $settings->getTea55Times();
        $drops_I_times = $settings->getDropsITimes();
        $drops_II_times = $settings->getDropsIITimes();

        $unused = [
            'tea_143'   => [],
            'tea_11'    => [],
            'tea_55'    => [],
            'drops_I'   => [],
            'drops_II'  => []
        ];
        foreach($tea_143_times as $time) {
            $ref_time = Carbon::now();
            list($hour, $minute) = explode(':', $time);
            $ref_time->setHours($hour);
            $ref_time->setMinutes($minute);
            if($ref_time->gt($now))
                continue;
            $exists = Calendar::where('tea', '143')
                ->where('date', $now->format('Y-m-d'))
                ->where('time', trim($time))
                ->get();
            if(!$exists || $exists->count() == 0)
                $unused['tea_143'][] = $time;
        }

        foreach ($tea_11_times as $time) {
            $ref_time = Carbon::now();
            list($hour, $minute) = explode(':', $time);
            $ref_time->setHours($hour);
            $ref_time->setMinutes($minute);
            if($ref_time->gt($now))
                continue;
            $exists = Calendar::where('tea', '11')
                ->where('date', $now->format('Y-m-d'))
                ->where('time', trim($time))
                ->get();
            if(!$exists || $exists->count() == 0)
                $unused['tea_11'][] = $time;
        }

        foreach ($tea_55_times as $time) {
            $ref_time = Carbon::now();
            list($hour, $minute) = explode(':', $time);
            $ref_time->setHours($hour);
            $ref_time->setMinutes($minute);
            if($ref_time->gt($now))
                continue;
            $exists = Calendar::where('tea', '55')
                ->where('date', $now->format('Y-m-d'))
                ->where('time', trim($time))
                ->get();
            if(!$exists || $exists->count() == 0)
                $unused['tea_55'][] = $time;
        }

        foreach ($drops_I_times as $time) {
            $ref_time = Carbon::now();
            list($hour, $minute) = explode(':', $time);
            $ref_time->setHours($hour);
            $ref_time->setMinutes($minute);
            if($ref_time->gt($now))
                continue;
            $exists = Calendar::where('tea', 'I')
                ->where('date', $now->format('Y-m-d'))
                ->where('time', trim($time))
                ->get();
            if(!$exists || $exists->count() == 0)
                $unused['drops_I'][] = $time;
        }

        foreach ($drops_II_times as $time) {
            $ref_time = Carbon::now();
            list($hour, $minute) = explode(':', $time);
            $ref_time->setHours($hour);
            $ref_time->setMinutes($minute);
            if($ref_time->gt($now))
                continue;
            $exists = Calendar::where('tea', 'II')
                ->where('date', $now->format('Y-m-d'))
                ->where('time', trim($time))
                ->get();
            if(!$exists || $exists->count() == 0)
                $unused['drops_II'][] = $time;
        }

        return response()->json([
            'success'   => true,
            'data'      => $unused
        ]);
    }
}
