<?php

use App\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //        $this->call(CountrySeeder::class);
        //        $this->call(FieldSuggestionsSeeder::class);
        //        $this->call(FieldTipsSeeder::class);
        //        $this->call(PositionSeeder::class);
        //        $this->call(PositionClassification::class);

        //Countries Seeding
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'X-CSCAPI-KEY: bWV1Q0doc3F5ajQ2TnBWT3FqVHU5N21LZ0dRQ0VsQ2tyRkRHVWhxbA=='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        foreach($data as $countries){
            DB::table('countries')->insert([
                'id' => $countries['id'],
                'country_name' => $countries['name'],
                'country_code' => $countries['iso2']
            ]);
        }

        //States
        // $curl1 = curl_init();
        // curl_setopt_array($curl1, array(
        //     CURLOPT_URL => 'https://api.countrystatecity.in/v1/states',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_HTTPHEADER => array(
        //         'X-CSCAPI-KEY: bWV1Q0doc3F5ajQ2TnBWT3FqVHU5N21LZ0dRQ0VsQ2tyRkRHVWhxbA=='
        //     ),
        // ));

        // $response2 = curl_exec($curl1);
        // curl_close($curl1);
        // $data2 = json_decode($response2, true);
        // foreach($data2 as $states){
        //     DB::table('states')->insert([
        //         'state' => $states['name'],
        //         'state_code' => $states['iso2'],
        //         'country_id' => $states['country_id']
        //     ]);
        // }

    }
}
