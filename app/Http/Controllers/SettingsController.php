<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
	protected $tees = ['143', '11', '55', 'all_day'];
    public function view()
    {
    	$settings = Settings::all();
    	return view('pages.settings', ['settings' => $settings, 'active'=>'settings']);	
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
    	// dd($r->all());
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

    public function validateR(Request $r, $errors)
    {
    	return true;
    }

}
