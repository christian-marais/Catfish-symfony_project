<?php

namespace App\Entity;

use App\Repository\HobbieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HobbieRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Hobbie
{   
    use TimestampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Désignation = null;

    #[ORM\ManyToMany(targetEntity: Personne::class, mappedBy: 'hobbies')]
    private Collection $personnes;

    public function __construct()
    {
        $this->personnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDésignation(): ?string
    {
        return $this->Désignation;
    }

    public function setDésignation(string $Désignation): self
    {
        $this->Désignation = $Désignation;

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes->add($personne);
            $personne->addHobby($this);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): self
    {
        if ($this->personnes->removeElement($personne)) {
            $personne->removeHobby($this);
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->Désignation;
    }
}
