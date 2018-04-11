<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseTestCase extends KernelTestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    private function getKernel()
    {
        if (!self::$kernel) {
            static::bootKernel();
        }

        return self::$kernel;
    }

    protected function getService(string $id)
    {
        return $this->getKernel()->getContainer()->get($id);
    }

}
