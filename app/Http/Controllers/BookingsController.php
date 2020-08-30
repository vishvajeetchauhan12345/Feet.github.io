<?php

namespace App\Http\Controllers;

use App\BookingIncome;
use App\Bookings;
use App\Customers;
use App\Http\Requests\BookingRequest;
use App\IncCats;
use App\IncomeModel;
use App\User;
use App\VehicleModel;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class BookingsController extends Controller {
	public function index() {
		$data['data'] = Bookings::orderBy('id', 'desc')->get();
		$data['types'] = IncCats::get();

		return view("bookings.index", $data);
	}

	public function receipt($id) {
		$data['i'] = $book = BookingIncome::whereBooking_id($id)->first();
		$data['info'] = IncomeModel::whereId($book['income_id'])->first();
		$data['booking'] = Bookings::whereId($id)->get()->first();
		return view("bookings.receipt", $data);

	}

	public function complete_post(Request $request) {

		$id = IncomeModel::create([
			"vehicle_id" => $request->get("vehicleId"),
			"amount" => $request->get("revenue"),
			"user_id" => $request->get("userId"),
			"date" => $request->get('date'),
			"mileage" => $request->get("mileage"),
			"income_cat" => $request->get("income_type"),
		])->id;
		BookingIncome::create(['booking_id' => $request->get("bookingId"), "income_id" => $id]);
		$xx = Bookings::whereId($request->get("bookingId"))->first();
		$xx->status = 1;
		$xx->save();
		// echo  $request->get("mileage");
		// echo "<br>";
		// echo $request->get("revenue");
		// echo $request->get("vehicleId");
		// echo "<br>";
		// echo $request->get("userId");
		// echo "<br>";

		// echo $request->get("bookingId");
		// echo "<br>";
		// echo $request->get("customerId");
		return redirect()->route("bookings.index");

	}

	public function complete($id) {

		$xx = Bookings::whereId($id)->first();
		$xx->status = 1;
		$xx->save();
		return redirect()->route("bookings.index");
	}

	public function get_driver(Request $request) {

		$from_date = $request->get("from_date");
		$to_date = $request->get("to_date");
		$req_type = $request->get("req");
		if ($req_type == "new") {
			$q = "select id,name as text from users where user_type='D' and deleted_at is null and id not in (select driver_id from bookings where  deleted_at is null   and ((dropoff between '" . $from_date . "' and '" . $to_date . "' or pickup between '" . $from_date . "' and '" . $to_date . "') or (DATE_ADD(dropoff, INTERVAL 10 MINUTE)>='" . $from_date . "' and DATE_SUB(pickup, INTERVAL 10 MINUTE)<='" . $to_date . "')))";

			$d = collect(DB::select(DB::raw($q)));

			$r['data'] = $d;
		} else {
			$id = $request->get("id");
			$current = Bookings::find($id);
			$q = "select id,name as text from users where user_type='D' and id not in (select driver_id from bookings where  id!=" . $id . " and deleted_at is null  and ((dropoff between '" . $from_date . "' and '" . $to_date . "' or pickup between '" . $from_date . "' and '" . $to_date . "') or (DATE_ADD(dropoff, INTERVAL 10 MINUTE)>='" . $from_date . "' and DATE_SUB(pickup, INTERVAL 10 MINUTE)<='" . $to_date . "')))";
			$d = collect(DB::select(DB::raw($q)));

			$chk = $d->where('id', $current->driver_id);
			$r['show_error'] = "yes";
			if (count($chk) > 0) {
				$r['show_error'] = "no";
			}
			$new = array();

			foreach ($d as $ro) {
				if ($ro->id === $current->driver_id) {
					array_push($new, array("id" => $ro->id, "text" => $ro->text, 'selected' => true));
				} else {
					array_push($new, array("id" => $ro->id, "text" => $ro->text));
				}

			}

			$r['data'] = $new;
		}

		return $r;

	}

	public function get_vehicle(Request $request) {

		$from_date = $request->get("from_date");
		$to_date = $request->get("to_date");
		$req_type = $request->get("req");
		if ($req_type == "new") {
			$xy = array();
			$q = "select id,concat(make,' ',model,' - ',license_plate) as text from vehicles where in_service=1 and deleted_at is null  and  id not in(select vehicle_id from bookings where  deleted_at is null  and ((dropoff between '" . $from_date . "' and '" . $to_date . "' or pickup between '" . $from_date . "' and '" . $to_date . "') or (DATE_ADD(dropoff, INTERVAL 10 MINUTE)>='" . $from_date . "' and DATE_SUB(pickup, INTERVAL 10 MINUTE)<='" . $to_date . "')))";

			$d = collect(DB::select(DB::raw($q)));

			$new = array();
			foreach ($d as $ro) {

				array_push($new, array("id" => $ro->id, "text" => $ro->text));

			}

			$r['data'] = $new;
			return $r;

		} else {
			$id = $request->get("id");
			$current = Bookings::find($id);

			$q = "select id,concat(make,' ',model,' - ',license_plate) as text from vehicles where in_service=1 and id not in (select vehicle_id from bookings where id!=$id and  deleted_at is null  and ((dropoff between '" . $from_date . "' and '" . $to_date . "' or pickup between '" . $from_date . "' and '" . $to_date . "') or (DATE_ADD(dropoff, INTERVAL 10 MINUTE)>='" . $from_date . "' and DATE_SUB(pickup, INTERVAL 10 MINUTE)<='" . $to_date . "')))";

			$d = collect(DB::select(DB::raw($q)));
			$chk = $d->where('id', $current->vehicle_id);
			$r['show_error'] = "yes";
			if (count($chk) > 0) {
				$r['show_error'] = "no";
			}

			$new = array();
			foreach ($d as $ro) {
				if ($ro->id === $current->vehicle_id) {
					array_push($new, array("id" => $ro->id, "text" => $ro->text, "selected" => true));
				} else {
					array_push($new, array("id" => $ro->id, "text" => $ro->text));
				}
			}
			$r['data'] = $new;
			return $r;
		}

	}

	public function calendar_event($id) {
		$data['booking'] = Bookings::find($id);
		return view("bookings.event", $data);

	}
	public function calendar_view() {
		return view("bookings.calendar");
	}
	public function calendar(Request $request) {
		$data = array();
		$start = $request->get("start");
		$end = $request->get("end");
		$b = Bookings::where("pickup", ">=", $start)->where("dropoff", "<=", $end)->get();
		foreach ($b as $booking) {
			$x['start'] = $booking->pickup;
			$x['end'] = $booking->dropoff;
			if ($booking->status == 1) {
				$color = "grey";
			} else {
				$color = $booking->vehicle->color;
			}
			$x['backgroundColor'] = $color;
			$x['title'] = $booking->customer->name;
			$x['id'] = $booking->id;

			array_push($data, $x);
		}
		return $data;
	}

	public function create() {
		$data['customers'] = Customers::all();
		$data['drivers'] = User::whereUser_type("D")->get();
		$data['vehicles'] = VehicleModel::whereIn_service("1")->get();
		return view("bookings.create", $data);
	}

	public function edit($id) {
		$booking = Bookings::whereId($id)->get()->first();

		$q = "select id,name,deleted_at from users where user_type='D' and deleted_at is null and id not in (select user_id from bookings where status=0 and  id!=" . $id . " and deleted_at is null and  (DATE_SUB(pickup, INTERVAL 15 MINUTE) between '" . $booking->pickup . "' and '" . $booking->dropoff . "' or DATE_ADD(dropoff, INTERVAL 15 MINUTE) between '" . $booking->pickup . "' and '" . $booking->dropoff . "' or dropoff between '" . $booking->pickup . "' and '" . $booking->dropoff . "'))";
		$drivers = collect(DB::select(DB::raw($q)));
		$q1 = "select * from vehicles where in_service=1 and deleted_at is null and id not in (select vehicle_id from bookings where status=0 and  id!=" . $id . " and deleted_at is null and  (DATE_SUB(pickup, INTERVAL 15 MINUTE) between '" . $booking->pickup . "' and '" . $booking->dropoff . "' or DATE_ADD(dropoff, INTERVAL 15 MINUTE) between '" . $booking->pickup . "' and '" . $booking->dropoff . "'  or dropoff between '" . $booking->pickup . "' and '" . $booking->dropoff . "'))";
		$vehicles = collect(DB::select(DB::raw($q1)));

		$index['drivers'] = $drivers;
		$index['vehicles'] = $vehicles;
		$index['data'] = $booking;

		return view("bookings.edit", $index);
	}

	public function destroy(Request $request) {
		// dd($request->get('id'));
		Bookings::find($request->get('id'))->delete();

		return redirect()->route('bookings.index');
	}

	protected function check_booking($pickup, $dropoff, $vehicle) {

		$chk = DB::table("bookings")
			->where("status", 0)
			->where("vehicle_id", $vehicle)
			->whereNull("deleted_at")
			->where("pickup", ">=", $pickup)
			->where("dropoff", "<=", $dropoff)
			->get();

		if (count($chk) > 0) {
			return false;
		} else {
			return true;
		}

	}

	public function store(BookingRequest $request) {

		$xx = $this->check_booking($request->get("pickup"), $request->get("dropoff"), $request->get("vehicle_id"));
		if ($xx) {
			$id = Bookings::create($request->all())->id;
			$booking = Bookings::find($id);
			$booking->user_id = $request->get("user_id");
			$booking->driver_id = $request->get('driver_id');
			$dropoff = Carbon::parse($booking->dropoff);
			$pickup = Carbon::parse($booking->pickup);
			$diff = $pickup->diffInMinutes($dropoff);
			$booking->note = $request->get('note');
			$booking->duration = $diff;
			$booking->save();
			$mail = Bookings::find($id);

			// Mail::to($mail->customer->email)->send(new VehicleBooked($booking));
			// Mail::to($mail->user->email)->send(new UserBooked($booking));
			// Mail::to($mail->driver->email)->send(new DriverBooked($booking));
			return redirect()->route("bookings.index");
		} else {
			return redirect()->route("bookings.create")->withErrors(["error" => "Selected Vehicle is not Available in Given Timeframe"])->withInput();
		}

	}
	public function update(Request $request) {

		$booking = Bookings::whereId($request->get("id"))->first();

		$booking->vehicle_id = $request->get("vehicle_id");
		$booking->user_id = $request->get("user_id");
		$booking->driver_id = $request->get('driver_id');
		$booking->travellers = $request->get("travellers");
		$booking->pickup = $request->get("pickup");
		$booking->dropoff = $request->get("dropoff");
		$booking->pickup_addr = $request->get("pickup_addr");
		$booking->dest_addr = $request->get("dest_addr");

		$dropoff = Carbon::parse($request->get("dropoff"));
		$pickup = Carbon::parse($request->get("pickup"));
		$booking->note = $request->get('note');
		$diff = $pickup->diffInMinutes($dropoff);
		$booking->duration = $diff;
		$booking->save();

		return redirect()->route('bookings.index');

	}
}
