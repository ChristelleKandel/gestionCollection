<?php

namespace App\Entity;

use App\Repository\RecettesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecettesRepository::class)]
class Recettes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\ManyToMany(targetEntity: Ingredients::class, inversedBy: 'recettes')]
    private Collection $Ingrédients;

    public function __construct()
    {
        $this->Ingrédients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Ingredients>
     */
    public function getIngrédients(): Collection
    {
        return $this->Ingrédients;
    }

    public function addIngrDient(Ingredients $ingrDient): static
    {
        if (!$this->Ingrédients->contains($ingrDient)) {
            $this->Ingrédients->add($ingrDient);
        }

        return $this;
    }

    public function removeIngrDient(Ingredients $ingrDient): static
    {
        $this->Ingrédients->removeElement($ingrDient);

        return $this;
    }
}
