<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class SettingsController extends Controller
{
	protected $tees = ['143', '11', '55', 'all_day', 'I', 'II'];
    public function view()
    {
    	$settings = Settings::first();

        $tea_143_times = !is_null($settings)? $settings->getTea143Times() : []; 
        $tea_11_times = !is_null($settings)? $settings->getTea11Times() : [];
        $tea_55_times = !is_null($settings)? $settings->getTea55Times() : [];
        $drops_I_times = !is_null($settings)? $settings->getDropsITimes() : [];
        $drops_II_times = !is_null($settings)? $settings->getDropsIITimes() : [];
        
        $times = $this->collectTimes();
    	return view('pages.settings', [
            'settings' => $settings, 
            'times' => $times, 
            'active'=>'settings',
            'tea_143_times' => $tea_143_times,
            'tea_11_times' => $tea_11_times,
            'tea_55_times' => $tea_55_times,
            'drops_I_times' => $drops_I_times,
            'drops_II_times' => $drops_II_times,
        ]);	
    }

    public function saveOrUpdate(Request $r)
    {
    	$settings = Settings::first();
    	if($settings == null)
    		$settings = new Settings;

    	$errors = [];
    	if(!$this->validateR($r, $errors))
    	{
    		return redirect()->to('/settings')->with('errors', $errors);
    	}

    	$this->modifyData($r);
    	$data = $r->only($settings->fillable);
    	$settings->fill($data);
    	if(!$settings->save())
    		return redirect()->to('/settings')->with('errors', 'Nije moguce sacuvati');

    	return redirect()->to('/settings')->with('success', 'Sacuvano');
    } 

    public function modifyData(Request &$r)
    {
    	$data = $r->all();
    	$tea_143_quantity = $r->tea_143_quantity;
    	$tea_143_quantity_type = $r->tea_143_quantity_type;
    	$data['tea_143_quantity'] = $this->convertToMl($tea_143_quantity, $tea_143_quantity_type);

    	if($data['tea_143_quantity'] == false)
    		$data['tea_143_quantity'] = 0;

    	$tea_11_quantity = $r->tea_11_quantity;
    	$tea_11_quantity_type = $r->tea_11_quantity_type;
    	$data['tea_11_quantity'] = $this->convertToMl($tea_11_quantity, $tea_11_quantity_type);

    	if($data['tea_11_quantity'] == false)
    		$data['tea_11_quantity'] = 0;

    	$tea_55_quantity = $r->tea_55_quantity;
    	$tea_55_quantity_type = $r->tea_55_quantity_type;
    	$data['tea_55_quantity'] = $this->convertToMl($tea_55_quantity, $tea_55_quantity_type);

    	if($data['tea_55_quantity'] == false)
    		$data['tea_55_quantity'] = 0;

    	// Modify time
    	$wakeup_time = Carbon::create($r->wakeup_time);
    	$data['wakeup_time'] = $wakeup_time;

    	$bed_time = Carbon::create($r->bed_time);
    	$data['bed_time'] = $bed_time;

        // dd($r->all());

        //Tea 143 times
        if($r->filled('tea_143_times')) 
            $data['tea_143_times'] = implode(',', $r->tea_143_times);

        //Tea 11 times
        if($r->filled('tea_11_times')) 
            $data['tea_11_times'] = implode(',', $r->tea_11_times);

        //Tea 55 times
        if($r->filled('tea_55_times')) 
            $data['tea_55_times'] = implode(',', $r->tea_55_times);

        if($r->filled('drops_I_times'))
            $data['drops_I_times'] = implode(',', $r->drops_I_times);

        if($r->filled('drops_II_times'))
            $data['drops_II_times'] = implode(',', $r->drops_II_times);

    	$r->replace($data);
    }

    public function convertToMl($qty, $measure)
    {
    	// dd([
    	// 	'number' => $qty,
    	// 	'measure' => $measure,
    	// 	'is_numeric' => is_numeric($qty),
    	// 	'float_val' => (float) $qty
    	// ]);
    	if(!is_numeric($qty))
    		return false;

    	$quantity = 0;
    	switch($measure)
    	{
    		case 'dl':
    		{
    			$quantity = (float)$qty * 10.0;
    			break;
    		}
    		case 'l':
    		{
    			$quantity = (float)$qty * 100.0;
    			break;
    		}
    		default: $quantity = (float)$qty; break;
    	}

    	return $quantity;
    }

    public function collectTimes()
    {
        $times = [];
        $settings = Settings::first();
        if(is_null($settings))
            return $this->defaultTimes;
        
        $start_time = CarbonImmutable::create($settings->wakeup_time);
        $end_time = CarbonImmutable::create($settings->bed_time);
        $hours = $start_time;
        if($start_time->lt($end_time))
        {
            $times[] = $start_time->format('H:i');
            while($start_time->lt($end_time))
            {
                $start_time = CarbonImmutable::create($start_time->addMinutes(30)->format('H:i'));
                $times[] = $start_time->format('H:i');
            }
        }else {
            // ToDo handle wrong start time and end time
        }
        return $times;
    }

    public function validateR(Request $r, $errors)
    {
    	return true;
    }

}
