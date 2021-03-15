<?php

use App\Models\Account;

class TransactionTest extends TestCase
{
    /**
     * Test transfer action
     * @return void
     */
    public function testTransfer()
    {
        $this->post('transaction', [
            'payer' => Account::factory()->create()->user->id,
            'payee' => Account::factory()->create()->user->id,
            'value' => 1
        ], []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['code', 'message']
        );
    }
}
