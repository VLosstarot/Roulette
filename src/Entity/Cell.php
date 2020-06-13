<?php

declare(strict_types=1);

namespace App\Entity;


use App\Entity\Share\AbstractEntity;
use App\Repository\CellRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CellRepository::class)
 */
class Cell extends AbstractEntity
{
    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\OneToMany(targetEntity="Turn", mappedBy="cells")
     * @var Turn[]|ArrayCollection
     */
    private $turns;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="cells")
     * @var User[]|ArrayCollection
     */
    private $users;

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     * @return Cell
     */
    public function setWeight($weight): Cell
    {
        $this->weight = $weight;

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
     * @return Cell
     */
    public function setUsers($users): Cell
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @param User $user
     * @return Cell
     */
    public function addUser(User $user): Cell
    {
        $this->users[] = $user;

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
     * @return Cell
     */
    public function setTurns($turns): Cell
    {
        $this->turns = $turns;

        return $this;
    }
}
