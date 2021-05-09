
@extends('layouts.default')
@section('links')
	<link rel="stylesheet" type="text/css" href="/css/settings.css">
	<link rel="stylesheet" type="text/css" href="/css/jquery.timepicker.min.css">
@endsection

@section('content')
<div class="flex">
	<form class="settings" method="POST" action="/settings">
		@csrf
		<div class="form-outline">
			<h2 class="settings-title text-primary">Podesavanja</h2>
		</div>
	  <!-- Week up time input -->
	  <div class="form-outline mb-2">
	    <label class="form-label" for="weekup_time">Vrijeme ustajanja</label>
	    <input 
	    	type="text" 
	    	id="weekup_time" 
	    	name="weekup_time" 
	    	class="form-control timepicker"
	    	required 
	    />
	  </div>

	  <!-- Bed Time input -->
	  <div class="form-outline mb-4">
	    <label class="form-label" for="bed_time">Vrijeme lijeganja</label>
	    <input 
	    	type="text" 
	    	id="bed_time"
	    	name="bed_time" 
	    	class="form-control timepicker" 
	    	required
	    />
	  </div>

	  {{-- Tea 143 doses input --}}
	  <div class="form-outline mb-4">
	    <label class="form-label" for="tea_143_quantity">Skuhana kolicina caja <font class="text-danger">143</font> u (<span class="tea_143_unit">ml</span>)</label>
	    <div class="input-group">
		    <input 
		    	type="number" 
		    	id="tea_143_quantity" 
		    	name="tea_143_quantity" 
		    	class="form-control" 
		    	required
		    />
		    <div class="quanity">
		    	<select 
		    		name="tea_143_quantity_type" 
		    		class="form-control tea_143_quantity_type" 
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

	  {{-- Tea 11 doses input --}}
	  <div class="form-outline mb-4">
	    <label class="form-label" for="tea_11_quantity">Skuhana kolicina caja <font class="text-danger">11</font> u (<span class="tea_11_unit">ml</span>)</label>
	    <div class="input-group">
		    <input 
		    	type="number" 
		    	id="tea_11_quantity" 
		    	name="tea_11_quantity" 
		    	class="form-control" 
		    	required 
		    />
		    <div class="quanity">
		    	<select 
		    		name="tea_11_quantity_type" 
		    		class="form-control tea_11_quantity_type" 
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

	  {{-- Tea 55 doses input --}}
	  <div class="form-outline mb-4">
	    <label class="form-label" for="tea_55_quantity">Skuhana kolicina caja <font class="text-danger">55</font> u (<span class="tea_55_measure">ml</span>)</label>
	    <div class="input-group">
		    <input 
		    	type="number" 
		    	id="tea_55_quantity" 
		    	name="tea_55_quantity" 
		    	class="form-control" 
		    	required 
		    />
		    <div class="quanity">
		    	<select 
		    		name="tea_55_quantity_type" 
		    		class="form-control tea_55_quantity_type" 
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

	  {{-- Tea all day doses input --}}
	  <div class="form-outline mb-4">
	    <label class="form-label" for="bed_time">Skuhana kolicina caja <font class="text-danger">cijeli dan</font> u (<span class="tea_all_day_measure">ml</span>)</label>
	    <div class="input-group">
		    <input type="number" id="tea_55" name="tea_all_day_quantity" class="form-control" required />
		    <div class="quanity">
		    	<select 
		    		name="tea_143_quantity_type" 
		    		class="form-control tea_all_day_quantity_type" 
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

	  <!-- Submit button -->
	  <button type="submit" class="btn btn-primary btn-block">Sacuvaj</button>
	</form>
</div>

@endsection

@section('scripts')
	<script type="text/javascript" src="/js/jquery.timepicker.min.js"></script>
	<script type="text/javascript">
		$('input#weekup_time').timepicker({});
		// $('input#bed_time').timepicker({});
	    $('input#bed_time').timepicker({});

	    // $('input#bed_time').timepicker({
	    //     hourGrid: 0,
	    //     minuteGrid: 0,
	    //     stepHour: 1,
	    //     timeFormat: 'H:mm:ss',
	    //     showSecond: false,
	    //     showMillisec: false,
	    //     showMicrosec: false,
	    //     showTimezone: false,
	    //     controlType: 'select',
	    //     showButtonPanel: false,
	    // });
	</script>
@endsection