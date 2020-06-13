<?php

declare(strict_types=1);

namespace App\Service;


use App\Entity\Cell;
use App\Entity\Round;
use App\Entity\Turn;
use App\Entity\User;
use App\Repository\CellRepository;
use App\Repository\RoundRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class RouletteService implements RouletteServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritDoc}
     * @param array $userNames
     * @return mixed|void
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws \Exception
     */
    public function turn(array $userNames)
    {
        /**
         * Алгоритм
         * 1) Берем/добавляем пользователей
         * 2) Проверяет текущий раунд
         * 3) Берем рандомную ячейку которая еще не выпадала в этом раунде
         * 4) Логируем выпавшую ячейку
         */

        /** @var UserRepository $userRep */
        $userRep = $this->entityManager->getRepository(User::class);
        $users = $userRep->findManyByNameOrCreate($userNames);

        /** @var RoundRepository $roundRep */
        $roundRep = $this->entityManager->getRepository(Round::class);
        $round = $roundRep->getCurrentRound();

        /** @var CellRepository $cellRep */
        $cellRep = $this->entityManager->getRepository(Cell::class);
        $cells = $cellRep->getNotPlayedInRoundCells($round);

        // пустые cells, значит в раунде сыграли все ячейки
        if ($cells->isEmpty()) {
            $cell = $cellRep->getJackPot();
            $round->setIsFinished(true);
        } else {
            $cell = $this->getRandomSell($cells);
        }

        // логируем прокрутку
        $turn = new Turn();
        $turn->setRound($round);
        $turn->setCell($cell);
        $turn->setUsers($users);

        $this->entityManager->persist($turn);
        $this->entityManager->flush();
    }


    /**
     * Получение случайно ячейки
     * @param Cell[]|ArrayCollection $cells
     * @return Cell|null
     * @throws \Exception
     */
    private function getRandomSell($cells): ?Cell
    {
        // все коды ячеек
        $values = $cells->map(
            static function (Cell $cell) {
                return $cell->getId();
            });

        // все веса ячеек
        $weights = $cells->map(
            static function (Cell $cell) {
                return $cell->getWeight();
            });

        // сумма весов всех ячеек
        $total = array_sum($weights->toArray());

        $n = 0;
        $num = random_int(1, $total);

        foreach ($values as $i => $value)
        {
            $n += $weights[$i];

            if ($n >= $num)
            {
                return $cells[$i];
            }
        }
        return null;
    }
}
