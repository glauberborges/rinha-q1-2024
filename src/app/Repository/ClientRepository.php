<?php

namespace App\Repository;

use App\Model\ClientsModel;
use Hyperf\Di\Exception\NotFoundException;

class ClientRepository
{

    public function __construct(
        private ClientsModel $clientsModel,
    )
    {
    }

    public function getClientById(int $clientId): ClientsModel
    {
        $client = $this->clientsModel->find($clientId);

        if (!$client){
            throw new NotFoundException('Client not found', 404);
        }

        return $client;
    }

}
