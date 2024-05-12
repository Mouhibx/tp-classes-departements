<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
class Departement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, SalleDeClasse>
     */
    #[ORM\OneToMany(targetEntity: SalleDeClasse::class, mappedBy: 'departement')]
    private Collection $salleDeClasses;

    public function __construct()
    {
        $this->salleDeClasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, SalleDeClasse>
     */
    public function getSalleDeClasses(): Collection
    {
        return $this->salleDeClasses;
    }

    public function addSalleDeClass(SalleDeClasse $salleDeClass): static
    {
        if (!$this->salleDeClasses->contains($salleDeClass)) {
            $this->salleDeClasses->add($salleDeClass);
            $salleDeClass->setDepartement($this);
        }

        return $this;
    }

    public function removeSalleDeClass(SalleDeClasse $salleDeClass): static
    {
        if ($this->salleDeClasses->removeElement($salleDeClass)) {
            // set the owning side to null (unless already changed)
            if ($salleDeClass->getDepartement() === $this) {
                $salleDeClass->setDepartement(null);
            }
        }

        return $this;
    }
}
