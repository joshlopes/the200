<?php

namespace App\Client;

use App\Client\Adapters\AdapterInterface;
use Psr\Http\Message\RequestInterface;

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
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(RequestInterface $request, array $options = [])
    {
        return $this->adapter->request($request, $options);
    }

}
