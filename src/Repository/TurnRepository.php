<?php

declare(strict_types=1);

namespace App\Repository;


use App\Entity\Turn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Turn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Turn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Turn[]    findAll()
 * @method Turn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TurnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Turn::class);
    }
}
