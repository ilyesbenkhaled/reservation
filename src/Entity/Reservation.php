<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_reservation;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="reservations")
     */
    private $chambre;

    /**
     * @ORM\OneToOne(targetEntity=Pax::class, mappedBy="reservation", cascade={"persist", "remove"})
     */
    private $pax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeReservation(): ?\DateTimeInterface
    {
        return $this->date_de_reservation;
    }

    public function setDateDeReservation(\DateTimeInterface $date_de_reservation): self
    {
        $this->date_de_reservation = $date_de_reservation;

        return $this;
    }

    public function getDateDeDepart(): ?\DateTimeInterface
    {
        return $this->date_de_depart;
    }

    public function setDateDeDepart(\DateTimeInterface $date_de_depart): self
    {
        $this->date_de_depart = $date_de_depart;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getPax(): ?Pax
    {
        return $this->pax;
    }

    public function setPax(?Pax $pax): self
    {
        $this->pax = $pax;

        // set (or unset) the owning side of the relation if necessary
        $newReservation = null === $pax ? null : $this;
        if ($pax->getReservation() !== $newReservation) {
            $pax->setReservation($newReservation);
        }

        return $this;
    }
}
