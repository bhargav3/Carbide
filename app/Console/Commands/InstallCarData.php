<?php

namespace App\Console\Commands;

use App\Car;
use Illuminate\Console\Command;

class InstallCarData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install-car-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loads database with car data from resources/data/cars.csv';

    /**
     * @var resource File content
     */
    protected $data;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->data = $csv = array_map('str_getcsv', file('resources/data/cars.csv'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Car::truncate();
        foreach ($this->data as $datum) {
            $datum[3] = json_decode($datum[3]);
            for ($i = 0; $i < count($datum[3]); $i++) {
                $car = new Car();
                $car->year = (int)$datum[0];
                $car->make = $datum[1];
                $car->model = $datum[2];
                $car->body_style = $datum[3][$i];
                $car->save();
            }
        }

        dd(Car::all()->count());
    }
}
