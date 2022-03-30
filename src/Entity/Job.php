<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $expression;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailNotif;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $nextDateExec;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, inversedBy="listSousJobs")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\Column(type="array", nullable=true)
     */
    private $listSousJobs = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $command;




    public function getId(): ?int
    {
        return $this->id;
    }



    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getExpression(): ?string
    {
        return $this->expression;
    }

    public function setExpression(?string $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getEmailNotif(): ?string
    {
        return $this->emailNotif;
    }

    public function setEmailNotif(?string $emailNotif): self
    {
        $this->emailNotif = $emailNotif;

        return $this;
    }

    public function getNextDateExec(): ?\DateTimeInterface
    {
        return $this->nextDateExec;
    }

    public function setNextDateExec(?\DateTimeInterface $nextDateExec): self
    {
        $this->nextDateExec = $nextDateExec;

        return $this;
    }

    public function getListSousJobs(): ?array
    {
        return $this->listSousJobs;
    }

    public function setListSousJobs(?array $listSousJobs): self
    {
        $this->listSousJobs = $listSousJobs;

        return $this;
    }

    public function getCommand(): ?string
    {
        return $this->command;
    }

    public function setCommand(string $command): self
    {
        $this->command = $command;

        return $this;
    }
}
