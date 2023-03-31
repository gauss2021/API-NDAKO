<?php

namespace App\Entity;

use App\Repository\MaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaisonRepository::class)]
class Maison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'maisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_maison = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_maison = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse_maison = null;

    #[ORM\Column(length: 255)]
    private ?string $ville_maison = null;

    #[ORM\Column(length: 255)]
    private ?string $quartier = null;

    #[ORM\Column]
    private ?int $prix_maison = null;

    #[ORM\Column]
    private ?int $nombre_quotient = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $photo_maison = null;

    #[ORM\OneToMany(mappedBy: 'maison', targetEntity: Reservation::class, orphanRemoval: true)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'maison_concernee', targetEntity: Message::class, orphanRemoval: true)]
    private Collection $messages;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getTitreMaison(): ?string
    {
        return $this->titre_maison;
    }

    public function setTitreMaison(string $titre_maison): self
    {
        $this->titre_maison = $titre_maison;

        return $this;
    }

    public function getDescriptionMaison(): ?string
    {
        return $this->description_maison;
    }

    public function setDescriptionMaison(string $description_maison): self
    {
        $this->description_maison = $description_maison;

        return $this;
    }

    public function getAdresseMaison(): ?string
    {
        return $this->adresse_maison;
    }

    public function setAdresseMaison(?string $adresse_maison): self
    {
        $this->adresse_maison = $adresse_maison;

        return $this;
    }

    public function getVilleMaison(): ?string
    {
        return $this->ville_maison;
    }

    public function setVilleMaison(string $ville_maison): self
    {
        $this->ville_maison = $ville_maison;

        return $this;
    }

    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    public function setQuartier(string $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    public function getPrixMaison(): ?int
    {
        return $this->prix_maison;
    }

    public function setPrixMaison(int $prix_maison): self
    {
        $this->prix_maison = $prix_maison;

        return $this;
    }

    public function getNombreQuotient(): ?int
    {
        return $this->nombre_quotient;
    }

    public function setNombreQuotient(int $nombre_quotient): self
    {
        $this->nombre_quotient = $nombre_quotient;

        return $this;
    }

    public function getPhotoMaison(): ?string
    {
        return $this->photo_maison;
    }

    public function setPhotoMaison(string $photo_maison): self
    {
        $this->photo_maison = $photo_maison;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setMaison($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getMaison() === $this) {
                $reservation->setMaison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setMaisonConcernee($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getMaisonConcernee() === $this) {
                $message->setMaisonConcernee(null);
            }
        }

        return $this;
    }
}
