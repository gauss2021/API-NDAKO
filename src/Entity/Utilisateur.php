<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $email_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $tel_utilisateur = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mot_de_passe_utilisateur = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Maison::class, orphanRemoval: true)]
    private Collection $maisons;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Reservation::class, orphanRemoval: true)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'utilisateur_envoi', targetEntity: Message::class, orphanRemoval: true)]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: 'utilisateur_recoit', targetEntity: Message::class, orphanRemoval: true)]
    private Collection $messages_recus;

    public function __construct()
    {
        $this->maisons = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->messages_recus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(string $nom_utilisateur): self
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenom_utilisateur;
    }

    public function setPrenomUtilisateur(string $prenom_utilisateur): self
    {
        $this->prenom_utilisateur = $prenom_utilisateur;

        return $this;
    }

    public function getEmailUtilisateur(): ?string
    {
        return $this->email_utilisateur;
    }

    public function setEmailUtilisateur(string $email_utilisateur): self
    {
        $this->email_utilisateur = $email_utilisateur;

        return $this;
    }

    public function getAdresseUtilisateur(): ?string
    {
        return $this->adresse_utilisateur;
    }

    public function setAdresseUtilisateur(string $adresse_utilisateur): self
    {
        $this->adresse_utilisateur = $adresse_utilisateur;

        return $this;
    }

    public function getTelUtilisateur(): ?string
    {
        return $this->tel_utilisateur;
    }

    public function setTelUtilisateur(string $tel_utilisateur): self
    {
        $this->tel_utilisateur = $tel_utilisateur;

        return $this;
    }

    public function getMotDePasseUtilisateur(): ?string
    {
        return $this->mot_de_passe_utilisateur;
    }

    public function setMotDePasseUtilisateur(string $mot_de_passe_utilisateur): self
    {
        $this->mot_de_passe_utilisateur = $mot_de_passe_utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Maison>
     */
    public function getMaisons(): Collection
    {
        return $this->maisons;
    }

    public function addMaison(Maison $maison): self
    {
        if (!$this->maisons->contains($maison)) {
            $this->maisons->add($maison);
            $maison->setUtilisateur($this);
        }

        return $this;
    }

    public function removeMaison(Maison $maison): self
    {
        if ($this->maisons->removeElement($maison)) {
            // set the owning side to null (unless already changed)
            if ($maison->getUtilisateur() === $this) {
                $maison->setUtilisateur(null);
            }
        }

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
            $reservation->setUtilisateur($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUtilisateur() === $this) {
                $reservation->setUtilisateur(null);
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
            $message->setUtilisateurEnvoi($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getUtilisateurEnvoi() === $this) {
                $message->setUtilisateurEnvoi(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesRecus(): Collection
    {
        return $this->messages_recus;
    }

    public function addMessagesRecu(Message $messagesRecu): self
    {
        if (!$this->messages_recus->contains($messagesRecu)) {
            $this->messages_recus->add($messagesRecu);
            $messagesRecu->setUtilisateurRecoit($this);
        }

        return $this;
    }

    public function removeMessagesRecu(Message $messagesRecu): self
    {
        if ($this->messages_recus->removeElement($messagesRecu)) {
            // set the owning side to null (unless already changed)
            if ($messagesRecu->getUtilisateurRecoit() === $this) {
                $messagesRecu->setUtilisateurRecoit(null);
            }
        }

        return $this;
    }
}
