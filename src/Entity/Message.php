<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur_envoi = null;

    #[ORM\ManyToOne(inversedBy: 'messages_recus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur_recoit = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Maison $maison_concernee = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu_message = null;

    #[ORM\Column(length: 255)]
    private ?string $date_envoi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateurEnvoi(): ?Utilisateur
    {
        return $this->utilisateur_envoi;
    }

    public function setUtilisateurEnvoi(?Utilisateur $utilisateur_envoi): self
    {
        $this->utilisateur_envoi = $utilisateur_envoi;

        return $this;
    }

    public function getUtilisateurRecoit(): ?Utilisateur
    {
        return $this->utilisateur_recoit;
    }

    public function setUtilisateurRecoit(?Utilisateur $utilisateur_recoit): self
    {
        $this->utilisateur_recoit = $utilisateur_recoit;

        return $this;
    }

    public function getMaisonConcernee(): ?Maison
    {
        return $this->maison_concernee;
    }

    public function setMaisonConcernee(?Maison $maison_concernee): self
    {
        $this->maison_concernee = $maison_concernee;

        return $this;
    }

    public function getContenuMessage(): ?string
    {
        return $this->contenu_message;
    }

    public function setContenuMessage(string $contenu_message): self
    {
        $this->contenu_message = $contenu_message;

        return $this;
    }

    public function getDateEnvoi(): ?string
    {
        return $this->date_envoi;
    }

    public function setDateEnvoi(string $date_envoi): self
    {
        $this->date_envoi = $date_envoi;

        return $this;
    }
}
