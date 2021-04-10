<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $nom_auteur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      notInRangeMessage = "A Note value must be within  {{ min }} and {{ max }}",
     * )
     */
    private $note;

    /**
     * @ORM\Column(type="text")
     */
    private $txt_commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etablissement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAuteur(): ?string
    {
        return $this->nom_auteur;
    }

    public function setNomAuteur(string $nom_auteur): self
    {
        $this->nom_auteur = $nom_auteur;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getTxtCommentaire(): ?string
    {
        return $this->txt_commentaire;
    }

    public function setTxtCommentaire(string $txt_commentaire): self
    {
        $this->txt_commentaire = $txt_commentaire;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }
}
