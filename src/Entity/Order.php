<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Reader::class, inversedBy="orders")
     */
    private $reader;

    /**
     * @ORM\ManyToOne(targetEntity=Library::class, inversedBy="orders")
     */
    private $library;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $api_status_response;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $methodpayment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReader(): ?Reader
    {
        return $this->reader;
    }

    public function setReader(?Reader $reader): self
    {
        $this->reader = $reader;

        return $this;
    }

    public function getLibrary(): ?Library
    {
        return $this->library;
    }

    public function setLibrary(?Library $library): self
    {
        $this->library = $library;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getApiStatusResponse(): ?string
    {
        return $this->api_status_response;
    }

    public function setApiStatusResponse(?string $api_status_response): self
    {
        $this->api_status_response = $api_status_response;

        return $this;
    }

    public function getMethodpayment(): ?string
    {
        return $this->methodpayment;
    }

    public function setMethodpayment(string $methodpayment): self
    {
        $this->methodpayment = $methodpayment;

        return $this;
    }
}
