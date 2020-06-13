<?php

declare(strict_types=1);

namespace App\Repository;


use App\Entity\Cell;
use App\Entity\Round;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cell|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cell|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cell[]    findAll()
 * @method Cell[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CellRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cell::class);
    }

    /**
     * @param Round $round
     * @return int|mixed|string
     */
    public function getNotPlayedInRoundCells(Round $round)
    {
        $qb = $this->createQueryBuilder('c')
            // без ячейки джекпота
            ->andWhere('c.weight != 0');

        // без уже сыгранных в этом раунте ячеек
        if ($playedCells = $round->getPlayedCellsId()) {
            $qb->andWhere('c.id not in (:played_cells)')
               ->setParameter('played_cells', $playedCells);
        }

        return new ArrayCollection(
            $qb->orderBy('c.weight')
               ->getQuery()
               ->getResult()
        );
    }

    /**
     * @return Cell
     * @throws NonUniqueResultException
     */
    public function getJackPot(): Cell
    {
        return $this->createQueryBuilder('c')
                    ->andWhere('c.weight = 0')
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}
