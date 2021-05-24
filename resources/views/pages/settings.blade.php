@php
	// dd(json_encode($settings->getAttributes()));
	// dd($tea_143_times);
@endphp
<script type="text/javascript">
	var week_up_hours = "{{@$settings->wake_up_hours}}";
	var settings = {!! json_encode($settings) !!};
</script>
@extends('layouts.default')
@section('links')
	<link rel="stylesheet" type="text/css" href="/css/jquery.timepicker.min.css">
	<link rel="stylesheet" type="text/css" href="/css/settings.css">
	<link rel="stylesheet" type="text/css" href="/css/teatimes.css">
@endsection

@section('content')
<div class="flex">
	<form class="settings" method="POST" action="/settings">
		@csrf
		<div class="form-outline">
			<h2 class="settings-title text-primary">Podesavanja</h2>
		</div>
	  <!-- Week up time input -->
	  <div class="form-outline input-group mb-2">

	  	{{-- Wake Up Time input --}}
	  	<div class="form-group col-6 pl-0">
		    <label class="form-label" for="weekup_time">Vrijeme ustajanja</label>
		    <input 
		    	type="text" 
		    	id="wakeup_time" 
		    	name="wakeup_time" 
		    	class="form-control timepicker"
		    	required 
		    	value="{{@$settings->wakeup_time}}" 
		    />
	  	</div>

		{{-- Bed Time input --}}
	  	<div class="form-group col-6 pr-0">
		    <label class="form-label" for="bed_time">Vrijeme lijeganja</label>
		    <input 
		    	type="text" 
		    	id="bed_time"
		    	name="bed_time" 
		    	class="form-control timepicker" 
		    	required
		    	value="{{@$settings->bed_time}}" 
		    />	  		
	  	</div>
	  </div>

	  {{-- Tea 143 doses input --}}
	  <div class="form-outline input-group mb-4">
	  	<label class="form-label" for="tea_quantity">Skuhana kolicina</label>
	  	<div class="input-group mb-2">
		  	{{-- TEA 143 --}}
	  		<div class="form-group col-sm-6 col-md-4 col-xl-3 pl-0">
				<label class="form-label" for="tea_143_quantity">Caj <font class="text-danger">143</font></label>
				<div class="input-group">
				    <input 
				    	type="number" 
				    	id="tea_143_quantity" 
				    	name="tea_143_quantity" 
				    	class="form-control quantity" 
				    	required
				    	value="{{@$settings->tea_143_quantity}}" 
				    />
				    <div class="quanity">
				    	<select 
				    		name="tea_143_quantity_type" 
				    		class="form-control tea_143_quantity_type quantity_type" 
				    		required
				    	>
				    		@php
				    			$quanity_type = @$settings['tea_143_quantity_type'];
				    			$selected_ml = $quanity_type == 'ml' ? 'selected' : '';
				    			$selected_dl = $quanity_type == 'dl' ? 'selected' : '';
				    			$selected_l = $quanity_type == 'l' ? 'selected' : '';
				    		@endphp
				    		<option value="ml" {{$selected_ml}}>ml</option>
				    		<option value="dl" {{$selected_dl}}>dl</option>
				    		<option value="l" {{$selected_l}}>l</option>
				    	</select>
				    </div>
				</div>
	  		</div>

		  	{{-- TEA 11 --}}
		  	<div class="form-group col-sm-6 col-md-4 col-xl-3">
			    <label class="form-label" for="tea_11_quantity">Caj <font class="text-danger">11</font></label>
			    <div class="input-group">
				    <input 
				    	type="number" 
				    	id="tea_11_quantity" 
				    	name="tea_11_quantity" 
				    	class="form-control quantity" 
				    	required 
				    	value="{{@$settings->tea_11_quantity}}" 
				    />
				    <div class="quanity">
				    	<select 
				    		name="tea_11_quantity_type" 
				    		class="form-control tea_11_quantity_type quantity_type" 
				    		required
				    	>
				    		@php
				    			$quanity_type = @$settings['tea_11_quantity_type'];
				    			$selected_ml = $quanity_type == 'ml' ? 'selected' : '';
				    			$selected_dl = $quanity_type == 'dl' ? 'selected' : '';
				    			$selected_l = $quanity_type == 'l' ? 'selected' : '';
				    		@endphp
				    		<option value="ml" {{$selected_ml}}>ml</option>
				    		<option value="dl" {{$selected_dl}}>dl</option>
				    		<option value="l" {{$selected_l}}>l</option>
				    	</select>
				    </div>
			    </div>
		  	</div>

		  	{{-- TEA 55 --}}
		  	<div class="form-group col-sm-6 col-md-4 col-xl-3">
			    <label class="form-label" for="tea_55_quantity">Caj <font class="text-danger">55</font></label>
			    <div class="input-group">
				    <input 
				    	type="number" 
				    	id="tea_55_quantity" 
				    	name="tea_55_quantity" 
				    	class="form-control quantity" 
				    	required 
				    	value="{{@$settings->tea_55_quantity}}" 
				    />
				    <div class="quanity">
				    	<select 
				    		name="tea_55_quantity_type" 
				    		class="form-control tea_55_quantity_type quantity_type" 
				    		required
						>
				    		@php
				    			$quanity_type = @$settings['tea_55_quantity_type'];
				    			$selected_ml = $quanity_type == 'ml' ? 'selected' : '';
				    			$selected_dl = $quanity_type == 'dl' ? 'selected' : '';
				    			$selected_l = $quanity_type == 'l' ? 'selected' : '';
				    		@endphp
				    		<option value="ml" {{$selected_ml}}>ml</option>
				    		<option value="dl" {{$selected_dl}}>dl</option>
				    		<option value="l" {{$selected_l}}>l</option>
				    	</select>
				    </div>
			    </div>
		  	</div>

		  	{{-- TEA ALL DAY --}}
		  	<div class="form-group col-sm-6 col-md-4 col-lg-3 pr-0">
			    <label class="form-label" for="bed_time">Caj <font class="text-danger">cijeli dan</font></label>
			    <div class="input-group">
				    <input 
				    	type="number" 
				    	id="tea_55" 
				    	name="tea_all_day_quantity" 
				    	class="form-control quantity" 
				    	required
				    	value="{{@$settings->tea_all_day_quantity}}" 
				    />
				    <div class="quanity">
				    	<select 
				    		name="tea_all_day_quantity_type" 
				    		class="form-control tea_all_day_quantity_type quantity_type" 
				    		required
				    	>
				    		@php
				    			$quanity_type = @$settings['tea_all_day_quantity_type'];
				    			$selected_ml = $quanity_type == 'ml' ? 'selected' : '';
				    			$selected_dl = $quanity_type == 'dl' ? 'selected' : '';
				    			$selected_l = $quanity_type == 'l' ? 'selected' : '';
				    		@endphp
				    		<option value="ml" {{$selected_ml}}>ml</option>
				    		<option value="dl" {{$selected_dl}}>dl</option>
				    		<option value="l" {{$selected_l}}>l</option>
				    	</select>
				    </div>
			    </div>
		  	</div>
	  	{{-- </div> --}}
	  </div>

	  	{{-- TEA 143 TIMES --}}
		<div 
			class="form-group w-100 border p-2 relative" 
			style="padding-bottom: 0.1rem !important; position: relative;"
		>
			<label 
				class="form-label p-2" 
				for="tea_143_times" 
				style="cursor: pointer;"
				data-toggle="collapse" 
				data-target="#tea_143_times_row"
			>Uzimanje caja 143</label>
			<div class="input-group w-100 flex-row collapse" id="tea_143_times_row" style="cursor: pointer;">
				@foreach($times as $time)
					<div class="flex col-2 align-content-center">
						<label class="form-label" for="tea_143_times" style="line-height: 30px;">{{$time}}</label>
						&nbsp;
						<input 
							type="checkbox" 
							class="form-control" 
							value="{{$time}}" 
							name="tea_143_times[]"
							style="width: 20px;margin-top: -4px;" 
							@if(in_array($time, $tea_143_times)) checked @endif
						>
					</div>
				@endforeach
			</div>
			<i class="fa fa-times" style="position: absolute; right: 20;top: 20" data-toggle="collapse" data-target="#tea_143_times_row"></i>
		</div>

	  	{{-- TEA 11 TIMES --}}
		<div 
			class="form-group w-100 border p-2 relative" 
			style="padding-bottom: 0.1rem !important; position: relative;"
		>
			<label 
				class="form-label p-2" 
				for="tea_11_times" 
				style="cursor: pointer;"
				data-toggle="collapse" 
				data-target="#tea_11_times_row"
			>Uzimanje caja 11</label>
			<div class="input-group w-100 flex-row collapse" id="tea_11_times_row" style="cursor: pointer;">
				@foreach($times as $time)
					<div class="flex col-2 align-content-center">
						<label class="form-label" for="tea_11_times" style="line-height: 30px;">{{$time}}</label>
						&nbsp;
						<input 
							type="checkbox" 
							class="form-control" 
							value="{{$time}}" 
							name="tea_11_times[]"
							style="width: 20px;margin-top: -4px;" 
							@if(in_array($time, $tea_11_times)) checked @endif
						>
					</div>
				@endforeach
			</div>
			<i class="fa fa-times" style="position: absolute; right: 20;top: 20" data-toggle="collapse" data-target="#tea_11_times_row"></i>
		</div>

	  	{{-- TEA 55 TIMES --}}
		<div 
			class="form-group w-100 border p-2 relative" 
			style="padding-bottom: 0.1rem !important; position: relative;"
		>
			<label 
				class="form-label p-2" 
				for="tea_55_times" 
				style="cursor: pointer;"
				data-toggle="collapse" 
				data-target="#tea_55_times_row"
			>Uzimanje caja 55</label>
			<div class="input-group w-100 flex-row collapse" id="tea_55_times_row" style="cursor: pointer;">
				@foreach($times as $time)
					<div class="flex col-2 align-content-center">
						<label class="form-label" for="tea_55_times" style="line-height: 30px;">{{$time}}</label>
						&nbsp;
						<input 
							type="checkbox" 
							class="form-control" 
							value="{{$time}}" 
							name="tea_55_times[]"
							style="width: 20px;margin-top: -4px;" 
							@if(in_array($time, $tea_55_times)) checked @endif
						>
					</div>
				@endforeach
			</div>
			<i class="fa fa-times" style="position: absolute; right: 20;top: 20" data-toggle="collapse" data-target="#tea_55_times_row"></i>
		</div>

	  	{{-- DROPS I TIMES --}}
		<div 
			class="form-group w-100 border p-2 relative" 
			style="padding-bottom: 0.1rem !important; position: relative;"
		>
			<label 
				class="form-label p-2" 
				for="drops_I_times" 
				style="cursor: pointer;"
				data-toggle="collapse" 
				data-target="#drops_I_times_row"
			>Uzimanje kapi I</label>
			<div class="input-group w-100 flex-row collapse" id="drops_I_times_row" style="cursor: pointer;">
				@foreach($times as $time)
					<div class="flex col-2 align-content-center">
						<label class="form-label" for="drops_I_times" style="line-height: 30px;">{{$time}}</label>
						&nbsp;
						<input 
							type="checkbox" 
							class="form-control" 
							value="{{$time}}" 
							name="drops_I_times[]"
							style="width: 20px;margin-top: -4px;" 
							@if(in_array($time, $drops_I_times)) checked @endif
						>
					</div>
				@endforeach
			</div>
			<i class="fa fa-times" style="position: absolute; right: 20;top: 20" data-toggle="collapse" data-target="#drops_I_times_row"></i>
		</div>


	  	{{-- DROPS I TIMES --}}
		<div 
			class="form-group w-100 border p-2 relative" 
			style="padding-bottom: 0.1rem !important; position: relative;"
		>
			<label 
				class="form-label p-2" 
				for="drops_II_times_times" 
				style="cursor: pointer;"
				data-toggle="collapse" 
				data-target="#drops_II_times_row"
			>Uzimanje kapi II</label>
			<div class="input-group w-100 flex-row collapse" id="drops_II_times_row" style="cursor: pointer;">
				@foreach($times as $time)
					<div class="flex col-2 align-content-center">
						<label class="form-label" for="drops_II_times" style="line-height: 30px;">{{$time}}</label>
						&nbsp;
						<input 
							type="checkbox" 
							class="form-control" 
							value="{{$time}}" 
							name="drops_II_times[]"
							style="width: 20px;margin-top: -4px;" 
							@if(in_array($time, $drops_II_times)) checked @endif
						>
					</div>
				@endforeach
			</div>
			<i class="fa fa-times" style="position: absolute; right: 20;top: 20" data-toggle="collapse" data-target="#drops_II_times_row"></i>
		</div>

	  <!-- Submit button -->
	  <button type="submit" class="btn btn-primary btn-block">Sacuvaj</button>
	</form>
</div>

@endsection

@section('scripts')
	<script type="text/javascript" src="/js/jquery.timepicker.min.js"></script>
	<script type="text/javascript">
		$('input#wakeup_time').timepicker({});
		// $('input#bed_time').timepicker({});
	    $('input#bed_time').timepicker({});

	    let calculate = {}
	    calculate.mlToL = quantity => quantity/100;
	    calculate.mlToDl = quantity => quantity/10; 
	    calculate.dlToL = quantity => quantity/10;
	    calculate.dlToMl = quantity => quantity*10;
	    calculate.lToMl = quantity => quantity*100;

	    var previousQuantityType;
	    let quantityTypeChangeListener = node => {
	    	node = node.currentTarget;
	    	let input = $(node).parent().siblings('.form-control')[0]
	    	let value = input.value;
	    	let unit = node.value;
	    	let propName = previousQuantityType + 'To' + unit.charAt(0).toUpperCase();
	    	if(unit.length != 1)
	    		propName += unit.slice(1);
	    	let newVal = calculate[propName](value);
	    	input.value = newVal;
	    	previousQuantityType = unit;
	    }
	    let quantities = document.querySelectorAll('select.quantity_type');
	    
	    quantities.forEach(quantity => {
	    	$(quantity).on('focus', function() {
	    		previousQuantityType = this.value;
	    		console.log(previousQuantityType);
	    	}).on('change', quantityTypeChangeListener)
	    })
	</script>
@endsection