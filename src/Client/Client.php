<?php

namespace App\Client;

use App\Client\Adapters\AdapterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function request(RequestInterface $request, array $options = [])
    {
        return $this->adapter->request($request, $options);
    }

}
