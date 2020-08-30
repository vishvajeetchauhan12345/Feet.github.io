<?php
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'user_type' => "D",
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Customers::class, function (Faker $faker) {

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'phone' => $faker->e164PhoneNumber,
		'address1' => $faker->streetAddress,
		'address2' => $faker->address,
		'city' => $faker->city,

	];
});

$factory->define(App\UserMeta::class, function (Faker $faker) {
	// $date = $faker->dateTimeThisCentury->format('Y-m-d');
	$start_date = Carbon\Carbon::today()->toDateString();
	$date = strtotime(date('Y-m-d'));
	$newDate = date('Y-m-d', strtotime('+1 month', $date));

	$issue_date = Carbon\Carbon::today()->toDateString();
	$expDate = Carbon\Carbon::createFromFormat('Y-m-d', $issue_date)->addYear(1);
	$user = factory('App\User')->create();
	$name = explode(" ", $user->name);
	return [

		'user_id' => $user->id,
		'first_name' => $name[0],
		'last_name' => $name[1],
		'address' => $faker->address,
		'phone' => $faker->e164PhoneNumber,
		'issue_date' => $issue_date,
		'exp_date' => $expDate,
		'start_date' => $start_date,
		'end_date' => $newDate,

		'license_number' => '123',

		'license_number' => $faker->unique()->numberBetween($min = 100000, $max = 900000),

		'contract_number' => $faker->unique()->numberBetween($min = 1000, $max = 9000),
		'emp_id' => $faker->unique()->randomNumber,
	];
});

$factory->define(App\Bookings::class, function (Faker $faker) {
	$customer = factory('App\Customers')->create();
	$date = $faker->dateTimeThisMonth($max = 'now', $timezone = date_default_timezone_get());
	$drop = $faker->dateTimeInInterval($startDate = $date, $interval = '+ 2 days', $timezone = date_default_timezone_get());

	return [
		'customer_id' => $customer->id,
		'user_id' => 1,
		'vehicle_id' => 1,
		'driver_id' => 1,
		'pickup' => $date,
		'dropoff' => $drop, //add 2 days
		'duration' => '2880',
		'pickup_addr' => $customer->address1,
		'dest_addr' => $customer->address1,
		'note' => 'sample note',
		'travellers' => $faker->randomElement([1, 2, 3, 4]),
		'status' => 0,

	];
});
