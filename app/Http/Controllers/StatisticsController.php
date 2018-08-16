<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Tour;
use App\Tourists;
use App\User;
use App\Operator;

use App\Http\Controllers\FunctionsController as Func;

class StatisticsController extends Controller {


	public function index() {

		return view('Statistics.index');
	}


	public function array_number_format ($array) {

		return array_map(function ($n) { return is_float($n) ? number_format($n, '2', ',', ' ') : $n;}, $array);
	}


	public function real_profit ($tour) {


		if(round($tour->payments_from_tourists_sum()) == round((float)$tour->price) && round($tour->payments_to_operator_sum()) == round((float)$tour->operator_price) && $tour->status == 'Подтверждено') 
		
		{

			return $tour->payments_from_tourists_rub_sum() - $tour->payments_to_operator_rub_sum();

		} 

		else {

			return 0;

		}


	}

	public function get_totals($tours_result) {

		$keys = collect($tours_result->first())->keys();

		foreach ($keys as $key) {

			if(!in_array($key, ['id', 'created_at', 'date_depart'])) {
				
				if($key === 'commission' || $key === 'total_commission' || $key === 'arpu' || $key === 'check') {

					$array[$key] = $this->total_commission($tours_result->pluck($key)->toArray()); 
				
				} else {

				$array[$key] = $tours_result->sum($key);

				}
			}

		}

		return $array;

	}



	public function total_commission ($commissions_array) {

		$count_commissions_non_zero = array_reduce($commissions_array, function($s, $n){$n!=0 ? $s+=1: $s = $s; return $s;});

		return $total_commission = $count_commissions_non_zero != 0 ? array_sum($commissions_array)/$count_commissions_non_zero : '-';		
	}



	public function load_statistics_for_one(Request $request) {

		$func = new Func;




		if(in_array($request->report_type, ['user_id', 'operator'])) {

			$model = $request->report_type == 'user_id' ? new User : new Operator;
				
			$request->key = $model::where('name', $request->key)->first()->id;

		}

		$request[$request->report_type] = $request->key;

// dump($request->all());


		$filters = $func->filters($request, 'statistics');

// dd($filters);

		$tours = Tour::where(array_merge($filters))->get();

		$tours_result = $tours->map(function($tour, $key) use($func) {

			return ['id' => $tour->id, 'number_of_tourists' => $tour->tourists_only_who_really_go()->count(), 'created_at' => $tour->created_at->toDateString(), 'date_depart' => $tour->date_depart, 'tourist_price' => (float)$tour->price_rub, 'operator_price' => (float)$tour->operator_price_rub, 'debt_to_operator' => $tour->operator_price_rub - $tour->payments_to_operator_rub_sum(), 'planned_profit' => $tour->price_rub - $tour->operator_price_rub, 'real_profit' => $this->real_profit($tour), 'commission' => $func->commission($tour)];

		});

		$totals = $this->get_totals($tours_result);

		$tours = $tours_result->put('totals', $totals)->put('request', $request)->toArray();

		foreach ($tours as $key => $result) {

			if($key !== 'request') {

				$tours[$key] = $this->array_number_format($result);
			}

		}

		// dd($tours);

		return view('Statistics.statistics_for_one')->with('results', $tours);


	}




	public function load_statistics(Request $request) {


		$func = new Func;

		$filters = $func->filters($request, auth()->user());
	
		$sort = $func->sort($request);

		$tours = Tour::where(array_merge($filters, [['status', '<>', 'Аннулировано']]))->get()->groupBy($request->report_type);

		$tours_result = $tours->map(function($item, $key){


			$number_of_tours = $item->count();

			$number_of_tourists = 0; 

			$paid_to_operator = 0; 

			$total_tourist_price = $item->sum('price_rub');

			$total_operator_price = $item->sum('operator_price_rub');

			$real_profit = 0;

			$commission = array();


			$item->each(function($this_tour, $tour_id) use (&$paid_to_operator, &$number_of_tourists, &$real_profit, &$commission, $key) {

				$paid_to_operator += $this_tour->payments_to_operator_rub_sum();

				$number_of_tourists += $this_tour->tourists_only_who_really_go()->count();

				$real_profit += $this->real_profit($this_tour);

				$func = new Func;

				$commission [] = $func->commission($this_tour);

			});

			$debt_to_operator = $total_operator_price - $paid_to_operator;

			$planned_profit = $total_tourist_price - $total_operator_price;

			$total_commission = $this->total_commission($commission);

			$arpu = $total_tourist_price / $number_of_tourists;

			$check = $total_tourist_price / $number_of_tours;


			$array =  ['number_of_tourists' => $number_of_tourists, 'number_of_tours' => $number_of_tours, 'total_tourist_price' => $total_tourist_price, 'paid_to_operator' => $paid_to_operator, /* 'total_operator_price' => $total_operator_price ,*/ 'debt_to_operator' => $debt_to_operator, 'planned_profit' => $planned_profit, 'real_profit' => $real_profit, 'total_commission' => $total_commission, 'arpu' => $arpu, 'check' => $check]; 



			// $array = array_map(function ($n) { return is_float($n) ? number_format($n, '2', ',', ' ') : $n;}, $array);

			return $array;

		});

		if(in_array($request->report_type, ['user_id', 'operator'])) {

			$model = $request->report_type == 'user_id' ? new User : new Operator;

			foreach ($tours_result as $key => $value) {
				
				$name = $model::find($key)->name;

				$new_tours_result[$name] = $value;
			}

			$tours_result = collect($new_tours_result);
		}

		$sort_method = $sort['order'] == 'asc' ? 'sortBy' : 'sortByDesc';

		$tours_result = $tours_result->{$sort_method}($sort['column'] == 'created_at' ? 'number_of_tourists' : $sort['column']);

		$totals = $this->get_totals($tours_result);

		$tours_result->put('totals', $totals);

		$tours_result->transform(function($item, $key) { return $this->array_number_format($item); });

		return $tours_result;

	}




}