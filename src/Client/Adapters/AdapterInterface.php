<?php

namespace App\Client\Adapters;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface AdapterInterface
{
    public function request(RequestInterface $request, array $options = []): ResponseInterface;
}
