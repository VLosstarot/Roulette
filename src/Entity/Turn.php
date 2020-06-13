<?php

declare(strict_types=1);

namespace App\Entity;


use App\Entity\Share\AbstractEntity;
use App\Repository\TurnRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TurnRepository::class)
 */
class Turn extends AbstractEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="Round", inversedBy="turns")
     * @var Round
     */
    private $round;

    /**
     * @ORM\ManyToOne(targetEntity="Cell", inversedBy="turns")
     * @var Cell
     */
    private $cell;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="turns")
     * @var User[]|ArrayCollection
     */
    private $users;

    /**
     * @return Round
     */
    public function getRound(): Round
    {
        return $this->round;
    }

    /**
     * @param Round $round
     * @return Turn
     */
    public function setRound(Round $round): Turn
    {
        $this->round = $round;

        return $this;
    }

    /**
     * @return Cell
     */
    public function getCell(): Cell
    {
        return $this->cell;
    }

    /**
     * @param Cell $cell
     * @return Turn
     */
    public function setCell(Cell $cell): Turn
    {
        $this->cell = $cell;

        return $this;
    }

    /**
     * @return User[]|ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User[]|ArrayCollection $users
     * @return Turn
     */
    public function setUsers($users): Turn
    {
        $this->users = $users;

        return $this;
    }
}
