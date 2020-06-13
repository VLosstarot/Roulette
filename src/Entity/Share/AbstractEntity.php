<?php

declare(strict_types=1);

namespace App\Entity\Share;


use Doctrine\ORM\Mapping as ORM;

abstract class AbstractEntity implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;

    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
