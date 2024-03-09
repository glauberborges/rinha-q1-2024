<?php

namespace App\Repository;

use App\Model\TransactionsModel;

class TransactionsRepository
{

    public function __construct(
        private readonly TransactionsModel $transactionsModel,
    )
    {
    }

    public function getTransactionByClient(int $clientId, int $limit = 10)
    {
        $transactions = $this->transactionsModel
            ->where('cliente_id', $clientId)
            ->select('valor', 'tipo', 'descricao', 'realizada_em')
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();

        return $transactions->toArray();
    }

    public function create(int $clientId, array $data)
    {
        return $this->transactionsModel->create([...$data, 'cliente_id' => $clientId]);
    }

}
