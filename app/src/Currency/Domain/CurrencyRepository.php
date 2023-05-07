<?php

declare(strict_types=1);

namespace App\Currency\Domain;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class CurrencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    public function getByCode(string $code): QueryBuilder
    {
        return $this->createQueryBuilder('c')
            ->select('id')
            ->where('c.code = :code')
            ->setParameter(':code', $code);
    }
}
