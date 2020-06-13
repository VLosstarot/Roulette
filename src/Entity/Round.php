<?php

declare(strict_types=1);

namespace App\Entity;


use App\Entity\Share\AbstractEntity;
use App\Repository\RoundRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoundRepository::class)
 */
class Round extends AbstractEntity
{
    /**
     * @ORM\Column(type="boolean", name="is_finished")
     * @var bool
     */
    private $isFinished = false;

    /**
     * @ORM\OneToMany(targetEntity="Turn", mappedBy="round")
     * @var Turn[]|ArrayCollection
     */
    private $turns;

    /**
     * @return bool
     */
    public function isFinished(): bool
    {
        return $this->isFinished;
    }

    /**
     * @param bool $isFinished
     * @return Round
     */
    public function setIsFinished(bool $isFinished): Round
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    /**
     * @return Turn[]|ArrayCollection
     */
    public function getTurns()
    {
        return $this->turns;
    }

    /**
     * @param Turn[]|ArrayCollection $turns
     * @return Round
     */
    public function setTurns($turns): Round
    {
        $this->turns = $turns;

        return $this;
    }

    /**
     * @param Turn $turn
     * @return Round
     */
    public function addTurn($turn): Round
    {
        $this->turns[] = $turn;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getPlayedCellsId(): ?array
    {
        if (empty($this->turns)) {
            return null;
        }

        return $this->turns->map(
            static function (Turn $turn) {
                return $turn->getCell()->getId();
            })->toArray();
    }
}
