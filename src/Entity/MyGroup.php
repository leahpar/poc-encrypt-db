<?php

namespace App\Entity;

use App\Repository\MyGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MyGroupRepository::class)
 */
class MyGroup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=MyEntity::class, mappedBy="myGroup", cascade={"persist"})
     */
    private $entities;

    /**
     * @ORM\Column(type="encrypted", length=1000, nullable=true)
     */
    private $encryptedData;

    public function __construct()
    {
        $this->entities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|MyEntity[]
     */
    public function getEntities(): Collection
    {
        return $this->entities;
    }

    public function addEntity(MyEntity $entity): self
    {
        if (!$this->entities->contains($entity)) {
            $this->entities[] = $entity;
            $entity->setMyGroup($this);
        }

        return $this;
    }

    public function removeEntity(MyEntity $entity): self
    {
        if ($this->entities->contains($entity)) {
            $this->entities->removeElement($entity);
            // set the owning side to null (unless already changed)
            if ($entity->getMyGroup() === $this) {
                $entity->setMyGroup(null);
            }
        }

        return $this;
    }

    public function getEncryptedData()
    {
        return $this->encryptedData;
    }

    public function setEncryptedData($encryptedData): self
    {
        $this->encryptedData = $encryptedData;

        return $this;
    }
}
