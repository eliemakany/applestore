<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ORM\Table(name="categories")
 * @ORM\HasLifecycleCallbacks
 */
class Category
{
    use Timestampable;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="categories")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Apple::class, mappedBy="category")
     */
    private $apples;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $apple->setCategory($this);
        }

        return $this;
    }

    public function removeApple(Apple $apple): self
    {
        if ($this->apples->contains($apple)) {
            $this->apples->removeElement($apple);
            // set the owning side to null (unless already changed)
            if ($apple->getCategory() === $this) {
                $apple->setCategory(null);
            }
        }

        return $this;
    }
}
