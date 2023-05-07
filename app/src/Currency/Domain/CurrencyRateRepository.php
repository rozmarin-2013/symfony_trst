<?php

declare(strict_types=1);

namespace App\Currency\Domain;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

class CurrencyRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyRate::class);
    }

    public function findByCode(string $code): Currency
    {
        return $this->findOneBy(['code' => $code]);
    }

    public function findOneByFilters(array $filters, ?array $orderBy = null)
    {
        $queryBuilder = $this->createQueryBuilder('cr');

        if ($date = $filters['date']) {
            $queryBuilder->where('cr.updatedAt BETWEEN :firstTime AND :secondTime')
                ->setParameter(':firstTime', $date . ' 00:00:00')
                ->setParameter(':secondTime', $date . ' 23:59:59');
        }

        if ($currency = $filters['currency']) {
            $queryBuilder->innerJoin(Currency::class,
                'c',
                Join::WITH,
                'cr.currency=c.id'
            )
                ->andWhere('c.code = :currency')
                ->setParameter(':currency', $currency);
        }

        return $queryBuilder->getQuery()->execute();
    }

    public function findAllByDate(string $date): array
    {
        return $this->createQueryBuilder('cr')
            ->where('cr.updatedAt BETWEEN :firstTime AND :secondTime')
            ->setParameter(':firstTime', $date . ' 00:00:00')
            ->setParameter(':secondTime', $date . ' 23:59:59')
            ->getQuery()
            ->execute();
    }
}
