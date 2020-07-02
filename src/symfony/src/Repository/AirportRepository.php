<?php

namespace App\Repository;

use App\Entity\Airport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Airport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Airport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Airport[]    findAll()
 * @method Airport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Airport::class);
    }

    public function getAllCount()
    {
        $airportsNumber = $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $airportsNumber;
    }

    public function findAllByFirstLetter($letter)
    {
        return $this->createQueryBuilder('a')
            ->where('a.ident LIKE :letter')
            ->setParameter('letter', $letter . '%')
            ->getQuery()
            ->getResult();
    }

    public function findAllWithPaginationAndOrder($page, $col, $sens)
    {
        return $this->findBy(
            [],
            [$col => $sens],
            20,
            ($page - 1) * 20
        );
    }
}
