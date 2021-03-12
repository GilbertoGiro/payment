<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionType;
use App\Repository\TransactionTypeRepository;
use Illuminate\Support\Facades\DB;

class TransactionTypeTableSeeder extends Seeder
{
    /**
     * Variable who contains transaction type repository
     * @var TransactionTypeRepository
     */
    protected $transactionTypeRepository;

    /**
     * TransactionTypeTableSeeder constructor.
     * @param TransactionTypeRepository $transactionTypeRepository
     */
    public function __construct(TransactionTypeRepository $transactionTypeRepository)
    {
        $this->transactionTypeRepository = $transactionTypeRepository;
    }

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // Define transaction types
        $transactionTypes = [
            [
                'name' => TransactionType::TYPE_DEBITED,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => TransactionType::TYPE_CREDITED,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        // Find or create it
        foreach ($transactionTypes as $transactionType) {
            $this->transactionTypeRepository->updateOrCreate(
                ['name' => $transactionType['name']],
                $transactionType
            );
        }
    }
}
