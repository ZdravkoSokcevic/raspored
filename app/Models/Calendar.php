<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
    	'date',
    	'tea',
    	'time',
    	'used'
    ];

    protected $teaTypes = [
        '143',
        '11',
        '55',
        'I',
        'II',
    ];

    public function getIsUsedAtribute()
    {
    	return $this->used;
    }

    public function whereEnum($column, $value)
    {
        $key = -1;
        foreach($this->teaTypes as $k=>$val)
            if($val == $value)
                $key = $k;
        return static::where($column, $k);
    }
}
