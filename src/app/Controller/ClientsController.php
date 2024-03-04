<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\ClientsRequest;
use App\Services\ClientsService;
use Hyperf\HttpServer\Contract\RequestInterface;

class ClientsController extends AbstractController
{

    public function __construct(private ClientsService $clientsService)
    {
    }

    public function transactions(ClientsRequest $request, int $id): array
    {
        $type = $request->input('tipo');

        return $this->clientsService->store($id, $type, $request->all());
    }

    public function extract(RequestInterface $request, int $id): array
    {
        return $this->clientsService->extract($id, $request->all());
    }
}
