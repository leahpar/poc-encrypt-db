<?php

namespace App\Entity;

use App\Repository\MyEntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MyEntityRepository::class)
 */
class MyEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="encrypted", length=1000, nullable=true)
     */
    private $encryptedData;

    /**
     * @ORM\ManyToOne(targetEntity=MyGroup::class, inversedBy="entities")
     */
    private $myGroup;

    /**
     * MyEntity constructor.
     */
    public function __construct()
    {
        $this->encryptedData = "Lorem ipsum default value";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEncryptedData(): ?string
    {
        return $this->encryptedData;
    }

    public function setEncryptedData(string $encryptedData): self
    {
        $this->encryptedData = $encryptedData;

        return $this;
    }

    public function getMyGroup(): ?MyGroup
    {
        return $this->myGroup;
    }

    public function setMyGroup(?MyGroup $myGroup): self
    {
        $this->myGroup = $myGroup;

        return $this;
    }
}
