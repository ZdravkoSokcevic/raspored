<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Settings;
use App\Models\Calendar;

class CalendarController extends Controller
{
    public function display(Request $r)
    {
    	$settings = Settings::first();
    	$tea_143_times = !is_null($settings)? $settings->getTea143Times() : []; 
    	$tea_11_times = !is_null($settings)? $settings->getTea11Times() : [];
    	$tea_55_times = !is_null($settings)? $settings->getTea55Times() : [];
        $drops_I_times = !is_null($settings)? $settings->getDropsITimes() : [];
        $drops_II_times = !is_null($settings)? $settings->getDropsIITimes() : [];

    	$date = $r->filled('date')? Carbon::create($r->date) : Carbon::now();
    	$calendar = Calendar::where('date', $date->format('Y-m-d'));
        // dd($calendar->get());
        // $calendar = Calendar::where('date', $date->format('Y-m-d'))->get();
        // dd($calendar);
        // dd(Calendar::all(), $date->format('Y-m-d'));

    	$calendar_143 = $calendar->where('tea', '143')->get();
        // dd($calendar_143);
    	$calendar_11 = $calendar->where('tea', '11')->get();
    	$calendar_55 = $calendar->where('tea', '55')->get();
    	$calendar_drops_I = $calendar->where('tea', 'I')->get();
    	$calendar_drops_II = $calendar->where('tea', 'II')->get();
    	$calendar = $calendar->first();
        // dd($calendar_143);
    	if(is_null($calendar))
    		$calendar = new Calendar;
    	return view('pages.calendar', [
    		'active'=>'calendar',
    		'date' => Carbon::now(),
    		'times' => $this->defaultTimes,
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
        // dd($r->all());
        $errors = [];
        if(!$this->validateR($r, $errors))
            return response()->json([
                'sucess' => 'false',
                'message' => 'Validation error',
                'errors' => [

                ]
            ]);
        $date = Carbon::parse($r->date);
        // dd($date);
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

    public function modifyRequest(Request &$r)
    {
        $data = $r->all();
        $used = false;
        if($r->filled('status') && $data['status'] != 1) 
            $data['used'] = false;

        $data['date'] = Carbon::parse($r->date);
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
}
