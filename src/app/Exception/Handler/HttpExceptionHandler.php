<?php

namespace App\Exception\Handler;

use Exception;
use Hyperf\HttpMessage\Exception\HttpException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class HttpExceptionHandler extends ExceptionHandler
{
    /**
     * Determine if the exception handler should handle the exception.
     *
     * @param Throwable $throwable
     * @return bool
     */
    public function isValid(Throwable $throwable): bool
    {
        // Verifique se você deseja lidar com esse tipo de exceção.
        return true;
    }

    /**
     * Handle the exception and return the response.
     *
     * @param Throwable|Exception $throwable
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handle(Throwable|Exception $throwable, ResponseInterface $response)
    {
        // Determina o código de status com base no tipo de exceção.
        $statusCode = $throwable instanceof HttpException
            ? $throwable->getStatusCode()
            : ($throwable->getCode() >= 400 && $throwable->getCode() <= 599 ? $throwable->getCode() : 500);
        $errorMessage = $throwable->getMessage();

        // Prepara a resposta JSON.
        $data = json_encode([
            'error' => true,
            'message' => $errorMessage,
        ]);

        // Cria um novo body stream com o conteúdo JSON.
        $body = new SwooleStream($data);

        // Configura a resposta com o status, cabeçalho e corpo adequados.
        return $response
            ->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($body);
    }
}
