<?php

declare(strict_types=1);

namespace App\Entity;


use App\Entity\Share\AbstractEntity;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User extends AbstractEntity
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Cell", mappedBy="users")
     * @var Cell[]|ArrayCollection
     */
    private $cells;

    /**
     * @ORM\ManyToMany(targetEntity="Turn", mappedBy="users")
     * @var Turn[]|ArrayCollection
     */
    private $turns;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): User
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Cell[]|ArrayCollection
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * @param Cell[]|ArrayCollection $cells
     * @return User
     */
    public function setCells($cells): User
    {
        $this->cells = $cells;

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
     * @return User
     */
    public function setTurns($turns): User
    {
        $this->turns = $turns;

        return $this;
    }
}
