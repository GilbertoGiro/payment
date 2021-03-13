<?php

namespace Database\Seeders;

use App\Models\Parameter;
use App\Repositories\ParameterRepository;
use Illuminate\Database\Seeder;

class ParameterTableSeeder extends Seeder
{
    /**
     * Variable who contains parameter repository
     * @var ParameterRepository
     */
    private $parameterRepository;

    /**
     * ParameterTableSeeder constructor.
     * @param ParameterRepository $parameterRepository
     */
    public function __construct(ParameterRepository $parameterRepository)
    {
        $this->parameterRepository = $parameterRepository;
    }

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $this->parameterRepository->insert([
            [
                'name' => Parameter::EXTERNAL_AUTHORIZER_URL,
                'value' => 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6',
                'description' => 'Variável que contém a URL do autorizador externo',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
