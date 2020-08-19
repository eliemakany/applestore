<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @ORM\Table(name="tags")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     *
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Apple::class, mappedBy="tags")
     */
    private $apples;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tags")
     */
    private $user;

    public function __construct()
    {
        $this->apples = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Apple[]
     */
    public function getApples(): Collection
    {
        return $this->apples;
    }

    public function addApple(Apple $apple): self
    {
        if (!$this->apples->contains($apple)) {
            $this->apples[] = $apple;
        }

        return $this;
    }

    public function removeApple(Apple $apple): self
    {
        if ($this->apples->contains($apple)) {
            $this->apples->removeElement($apple);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
