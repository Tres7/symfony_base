<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;





    /**
     * @var Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'burger')]
    private Collection $commentaire;

    #[ORM\ManyToOne(inversedBy: 'burgers')]
    private ?Pain $pain = null;

    /**
     * @var Collection<int, Oignon>
     */
    #[ORM\ManyToMany(targetEntity: Oignon::class, inversedBy: 'burgers')]
    private Collection $oignon;

    /**
     * @var Collection<int, Sauce>
     */
    #[ORM\ManyToMany(targetEntity: Sauce::class, inversedBy: 'burgers')]
    private Collection $sauce;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    public function __construct()
    {
        $this->commentaire = new ArrayCollection();
        $this->oignon = new ArrayCollection();
        $this->sauce = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire->add($commentaire);
            $commentaire->setBurger($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getBurger() === $this) {
                $commentaire->setBurger(null);
            }
        }

        return $this;
    }

    public function getPain(): ?Pain
    {
        return $this->pain;
    }

    public function setPain(?Pain $pain): static
    {
        $this->pain = $pain;

        return $this;
    }

    /**
     * @return Collection<int, Oignon>
     */
    public function getOignon(): Collection
    {
        return $this->oignon;
    }

    public function addOignon(Oignon $oignon): static
    {
        if (!$this->oignon->contains($oignon)) {
            $this->oignon->add($oignon);
        }

        return $this;
    }

    public function removeOignon(Oignon $oignon): static
    {
        $this->oignon->removeElement($oignon);

        return $this;
    }

    /**
     * @return Collection<int, Sauce>
     */
    public function getSauce(): Collection
    {
        return $this->sauce;
    }

    public function addSauce(Sauce $sauce): static
    {
        if (!$this->sauce->contains($sauce)) {
            $this->sauce->add($sauce);
        }

        return $this;
    }

    public function removeSauce(Sauce $sauce): static
    {
        $this->sauce->removeElement($sauce);

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }
}
