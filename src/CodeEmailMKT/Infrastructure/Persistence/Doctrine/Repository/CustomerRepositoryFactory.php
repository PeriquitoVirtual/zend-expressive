<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;


class CustomerRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
       $entityManager = $container->get(EntityManager::class);
        return new TestePageAction($container->get(EntityManager::class),$template);
    }
}
