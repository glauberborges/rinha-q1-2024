<?php

namespace App\Services;

use App\Model\ClientsModel;
use App\Repository\ClientRepository;
use App\Repository\TransactionsRepository;

class ClientsService
{
    public function __construct(
        private readonly ClientRepository $clientRepository,
        private readonly TransactionsRepository $transactionsModel,
    )
    {
    }

    public function store(int $clientId, string $type, $data = []): array
    {
        $client = $this->clientRepository->getClientById($clientId);

        $this->processTransaction($type, $data['valor'], $client, $data);

        return [
            "limite" => $client->limite,
            "saldo" => $client->balance->valor
        ];
    }

    public function extract(int $clientId, $data = []): array
    {
        $client = $this->clientRepository->getClientById($clientId);

        return [
            "saldo" => [
                "total" => $client->balance->valor,
                "data_extrato" => date('Y-m-d H:i:s.e'),
                "limite" => $client->limite,
            ],
            "ultimas_transacoes" => $this->transactionsModel->getTransactionByClient($clientId)
        ];
    }

    private function applyWithdraw($valor, ClientsModel $client): void
    {
        $newBalance = $client->balance->valor -= $valor;

        if ((floatval($client->limite) + floatval($newBalance)) < 0) {
            throw new \Exception('Limite excedido', 422);
        }

        $client->balance->valor = $newBalance;
        $client->balance->save();
    }

    private function applyCredit($valor, ClientsModel $client): void
    {
        $newBalance = $client->balance->valor += $valor;

        $client->balance->valor = $newBalance;
        $client->balance->save();
    }

    private function processTransaction(string $type, float $valor, ClientsModel $client, array $extraData = []): void
    {
        if ($type !== 'd' && $type !== 'c'){
            throw new \Exception('Operação inválida', 422);
        }

        if ($type === 'd') {
            $this->applyWithdraw($valor, $client);
        }

        if ($type === 'c') {
            $this->applyCredit($valor, $client);
        }

        $this->transactionsModel->create($client->id, [
            'cliente_id' => $client->id,
            'valor' => $valor,
            'tipo' => $type,
            'descricao' => $extraData['descricao'] ?? '',
        ]);
    }
}
