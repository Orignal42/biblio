<?php

namespace App\Entity;

use App\Repository\ReaderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReaderRepository::class)
 */
class Reader
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="string", length=255,  nullable=true)
    */
    private $username;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $newsletter;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="reader")
     */
    private $orders;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="reader", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;




 

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setReader($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getReader() === $this) {
                $order->setReader(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
//pour la relation entre les 2 tables en OneToOne il faut mettre yes pour que l'échange se fassent entre les 2 classes



}
