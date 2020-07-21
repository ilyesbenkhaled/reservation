<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
 
/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 * @ORM\Table(name="chambre")
 * @UniqueEntity(fields="numero", message="Room is already Reserved.")
 */


class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
     
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix_de_base;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix_exeptionnel;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_de_personne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $etage;

    /**
     * @ORM\OneToOne(targetEntity=Pax::class, mappedBy="Chambre", cascade={"persist", "remove"})
     */
    private $Nbr_chambre;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="chambre")
     */
    private $reservations;

    /**
     * @ORM\Column(type="integer")
     */
    private $step;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="Chambre")
     */
    private $hotel;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPrixDeBase(): ?string
    {
        return $this->prix_de_base;
    }

    public function setPrixDeBase(string $prix_de_base): self
    {
        $this->prix_de_base = $prix_de_base;

        return $this;
    }

    public function getPrixExeptionnel(): ?string
    {
        return $this->prix_exeptionnel;
    }

    public function setPrixExeptionnel(string $prix_exeptionnel): self
    {
        $this->prix_exeptionnel = $prix_exeptionnel;

        return $this;
    }

    public function getNombreDePersonne(): ?int
    {
        return $this->nombre_de_personne;
    }

    public function setNombreDePersonne(int $nombre_de_personne): self
    {
        $this->nombre_de_personne = $nombre_de_personne;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getNbrChambre(): ?Pax
    {
        return $this->Nbr_chambre;
    }

    public function setNbrChambre(?Pax $Nbr_chambre): self
    {
        $this->Nbr_chambre = $Nbr_chambre;

        // set (or unset) the owning side of the relation if necessary
        $newChambre = null === $Nbr_chambre ? null : $this;
        if ($Nbr_chambre->getChambre() !== $newChambre) {
            $Nbr_chambre->setChambre($newChambre);
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setChambre($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getChambre() === $this) {
                $reservation->setChambre(null);
            }
        }

        return $this;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(int $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
