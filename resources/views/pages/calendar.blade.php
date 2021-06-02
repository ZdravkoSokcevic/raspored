@extends('layouts.default')
@section('links')
  <link rel="stylesheet" type="text/css" href="/css/calendar.css">
@endsection

@php
  $day_before = $date->subDays(1);
  $day_after = $date->addDays(1); 
  $now = Carbon\CarbonImmutable::now();
  $in_half_hour = $now->addMinutes(30);
@endphp

@section('content')

<div class="title-and-time-container w-100">
  <h2 class="py-4">Raspored uzimanja lijekova</h2>
  <h2 
	class="time-span py-4 btn-group-vertical" 
  >
	<div class="flex flex-row bg-primary">
	  <a href="/calendar?date={{$day_before->format('d.m.Y')}}" class="my-0">
		<button class="bg-primary">
		  <i class="fas fa-caret-left text-white date-change"></i>
		</button>
	  </a>
	  &nbsp;
	  <p class="my-0 text-white">{{$date->format('d.m.Y')}}</p>
	  &nbsp;
	  <a href="/calendar?date={{$day_after->format('d.m.Y')}}" class="my-0">
		<button class="bg-primary">
		  <i class="fas fa-caret-right text-white date-change"></i>
		</button>
	  </a>
	  
	</div>
  </h2>
</div>
<table class="table table-bordered text-center table-fixed">
  <thead>
	<tr class="bg-dark text-light">
	  <th scope="col">Vrijeme</th>
	  <th scope="col">143</th>
	  <th scope="col">11</th>
	  <th scope="col">55</th>
	  <th scope="col">I</th>
	  <th scope="col">II</th>
	</tr>
  </thead>
  <tbody>
	@foreach($times as $time)
	  @php
	  // dd($settings);
		if(is_null($time))
		  continue;
		// carbon time
		$ct = $settings->getCarbonTimeFromTime($time, $date);
		// dd($ct->format('m'));
		// dd([
		//   'now' => $now->format('d.m.Y H:i'),
		//   'in_half_hour' => $in_half_hour->format('d.m.Y H:i'),
		//   'current_time' => $ct->format('d.m.Y H:i')
		// ]);
		list($hour, $minute) = explode(':', $time);
		$hour = (int) $hour;
		$minute = (int) $minute;
		// dd([
		//   'format h current time' => $now->format('H'),
		//   'format m current time' => $now->format('i'),
		//   'hour' => $hour,
		//   'minute' => $minute 
		// ]);
	  @endphp
	  <tr
		  @if($ct->gt($now) && $ct->lt($in_half_hour))
			class="bg-danger"
			id="current-time"
			data-date="{{$date}}"
			style="font-weight: 800 !important; color:white;"
		  @elseif((int)$now->format('H') == 23 && (int)$now->format('i') >= 30 && $hour == 23 && $minute == 30)
				style="font-weight: 800 !important"
			id="current-time"
		  @endif
	  >
		<th 
		  data-time="{{$time}}" 
		  scope="row"
		>
		  {{$time}}
		</th>
		@if(in_array($time, $tea_143_times))
		{{-- @if($hour > 8)
		  @dd($hour, $minute, $ct)
		  @dd($now, $ct, $now->gt($ct))
		@endif --}}
		  <td 
			data-time="{{$time}}" 
			data-tea="143" 
			data-date-timestamp="{{$date->timestamp}}"
			data-date="{{$date->format('d.m.Y')}}"
			data-id="{{$time}}"
			class=""
			onclick="openModal(this)" 
			@if(in_array($time, array_values($calendar_143_uses->pluck('time')->toArray())))
			  data-used-status="1"
			@elseif($now->gt($ct))
			  data-used-status="2"
			@elseif($now->lt($ct))
			  data-used-status="3"
			@else
			  data-used-status="4"
			@endif
		  >
			@if(in_array($time, array_values($calendar_143_uses->pluck('time')->toArray())))
			  <i class="fa fa-check text-primary"></i>
			@elseif($now->gt($ct))
			  <i class="fa fa-times text-danger"></i>
			@elseif($now->lt($ct))
			  <i class="fa fa-times text-secondary"></i>
			@else
			  <i class="fa fa-check text-primary"></i>
			@endif

		  </td>
		@else
		  <td></td>          
		@endif

		@if(in_array($time, $tea_11_times))
		  <td 
			data-time="{{$time}}" 
			data-tea="11" 
			data-date-timestamp="{{$date->timestamp}}"
			data-date="{{$date->format('d.m.Y')}}"
			class=""
			onclick="openModal(this)" 
			@if(in_array($time, array_values($calendar_11_uses->pluck('time')->toArray())))
			  data-used-status="1"
			@elseif($now->gt($ct))
			  data-used-status="2"
			@elseif($now->lt($ct))
			  data-used-status="3"
			@else
			  data-used-status="4"
			@endif
		  >
			@if(in_array($time, array_values($calendar_11_uses->pluck('time')->toArray())))
			  <i class="fa fa-check text-primary"></i>
			@elseif($now->gt($ct))
			  <i class="fa fa-times text-danger"></i>
			@elseif($now->lt($ct))
			  <i class="fa fa-times text-secondary"></i>
			@else
			  <i class="fa fa-check text-primary"></i>
			@endif

		  </td>
		@else
		  <td></td>          
		@endif

		@if(in_array($time, $tea_55_times))
		  <td 
			data-time="{{$time}}" 
			data-tea="55" 
			data-date-timestamp="{{$date->timestamp}}"
			data-date="{{$date->format('d.m.Y')}}"
			class=""
			onclick="openModal(this)" 
			@if(in_array($time, array_values($calendar_55_uses->pluck('time')->toArray())))
			  data-used-status="1"
			@elseif($now->gt($ct))
			  data-used-status="2"
			@elseif($now->lt($ct))
			  data-used-status="3"
			@else
			  data-used-status="4"
			@endif
		  >
			@if(in_array($time, array_values($calendar_55_uses->pluck('time')->toArray())))
			  <i class="fa fa-check text-primary"></i>
			@elseif($now->gt($ct))
			  <i class="fa fa-times text-danger"></i>
			@elseif($now->lt($ct))
			  <i class="fa fa-times text-secondary"></i>
			@else
			  <i class="fa fa-check text-primary"></i>
			@endif

		  </td>
		@else
		  <td></td>          
		@endif

		@if(in_array($time, $drops_I_times))
		  <td 
			data-time="{{$time}}" 
			data-tea="I" 
			data-date-timestamp="{{$date->timestamp}}"
			data-date="{{$date->format('d.m.Y')}}"
			class=""
			onclick="openModal(this)" 
			@if(in_array($time, array_values($calendar_drops_I_uses->pluck('time')->toArray())))
			  data-used-status="1"
			@elseif($now->gt($ct))
			  data-used-status="2"
			@elseif($now->lt($ct))
			  data-used-status="3"
			@else
			  data-used-status="4"
			@endif
		  >
			@if(in_array($time, array_values($calendar_drops_I_uses->pluck('time')->toArray())))
			  <i class="fa fa-check text-primary"></i>
			@elseif($now->gt($ct))
			  <i class="fa fa-times text-danger"></i>
			@elseif($now->lt($ct))
			  <i class="fa fa-times text-secondary"></i>
			@else
			  <i class="fa fa-check text-primary"></i>
			@endif

		  </td>
		@else
		  <td></td>          
		@endif

		@if(in_array($time, $drops_II_times))
		  <td 
			data-time="{{$time}}" 
			data-tea="II" 
			data-date-timestamp="{{$date->timestamp}}"
			data-date="{{$date->format('d.m.Y')}}"
			class=""
			onclick="openModal(this)" 
			@if(in_array($time, array_values($calendar_drops_II_uses->pluck('time')->toArray())))
			  data-used-status="1"
			@elseif($now->gt($ct))
			  data-used-status="2"
			@elseif($now->lt($ct))
			  data-used-status="3"
			@else
			  data-used-status="4"
			@endif
		  >
			@if(in_array($time, array_values($calendar_drops_II_uses->pluck('time')->toArray())))
			  <i class="fa fa-check text-primary"></i>
			@elseif($now->gt($ct))
			  <i class="fa fa-times text-danger"></i>
			@elseif($now->lt($ct))
			  <i class="fa fa-times text-secondary"></i>
			@else
			  <i class="fa fa-check text-primary"></i>
			@endif

		  </td>
		@else
		  <td></td>          
		@endif

	  </tr>
	@endforeach
  </tbody>
</table>

@endsection


{{-- MODAL --}}
@include('pages.calendar-modal')

@section('scripts')
  <script type="text/javascript" src="/assets/js/moment.2.29.1.min.js"></script>
  <script type="text/javascript" src="/assets/js/jquery.scrollTo.min.js"></script>
  <script type="text/javascript" src="/js/calendar.js"></script>
  <script type="text/javascript" src="/js/calendar-api.js"></script>
@endsection