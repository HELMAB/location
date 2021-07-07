<?php

namespace App\Console\Commands;

use App\Models\Commune;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RegionCommand extends Command
{
    /**
     * @var string
     */
    protected $api = 'http://localhost:8000/get-address';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asorasoft:region';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed province, district, commune and village.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('villages')->truncate();
        DB::table('communes')->truncate();
        DB::table('districts')->truncate();
        DB::table('provinces')->truncate();

        $provinces = $this->getClient();
        $bar = $this->output->createProgressBar(count($provinces));
        $bar->start();
        DB::beginTransaction();
        try {
            foreach ($provinces as $province) {
                $newProvince = Province::create([
                    'code' => $province->code,
                    'name_km' => $province->name_km,
                    'name_en' => $province->name_latin,
                    'type_en' => $this->getTypeEn($province->type),
                    'type_km' => $province->type,
                    'admin_level' => $province->admin_level,
                ]);
                $districts = $this->getClient($province->code);
                foreach ($districts as $district) {
                    $newDistrict = District::create([
                        'province_id' => $newProvince->id,
                        'parent_code' => $province->code,
                        'code' => $district->code,
                        'name_km' => $district->name_km,
                        'name_en' => $district->name_latin,
                        'type_en' => $this->getTypeEn($district->type),
                        'type_km' => $district->type,
                        'admin_level' => $district->admin_level,
                    ]);
                    $communes = $this->getClient($district->code);
                    foreach ($communes as $commune) {
                        $newCommune = Commune::create([
                            'district_id' => $newDistrict->id,
                            'parent_code' => $district->code,
                            'code' => $commune->code,
                            'name_km' => $commune->name_km,
                            'name_en' => $commune->name_latin,
                            'type_en' => $this->getTypeEn($commune->type),
                            'type_km' => $commune->type,
                            'admin_level' => $commune->admin_level,
                        ]);
                        $villages = $this->getClient($commune->code);
                        foreach ($villages as $village) {
                            $bar->advance();
                            Village::create([
                                'commune_id' => $newCommune->id,
                                'code' => $village->code,
                                'parent_code' => $commune->code,
                                'name_km' => $village->name_km,
                                'name_en' => $village->name_latin,
                                'type_en' => $this->getTypeEn($village->type),
                                'type_km' => $village->type,
                                'admin_level' => $village->admin_level,
                            ]);
                        }
                    }
                }
                $bar->advance();
            }
            $bar->finish();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dump($exception->getMessage());
        }
        $this->info('Done!');
    }

    private function getClient($parent_code = null)
    {
        $path = "$this->api/$parent_code";
        $client = new Client();
        $request = $client->get($path);
        $data = (array)json_decode($request->getBody());
        return $data;
    }

    private function getTypeEn($type)
    {
        switch ($type) {
            case 'រាជធានី':
                return 'Capital';
            case 'ខេត្ត':
                return 'Province';
            case 'ក្រុង':
                return 'City';
            case 'ភូមិ':
                return 'Village';
            case 'ស្រុក':
                return 'District';
            case 'ខណ្ឌ':
                return 'Khan';
            case 'សង្កាត់':
                return 'Sangkat';
            case 'ឃុំ':
                return 'Commune';
        }
    }
}
