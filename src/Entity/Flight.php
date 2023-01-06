<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use App\Repository\FlightRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use FlightProvider;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FlightRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'get']),
        new GetCollection(normalizationContext: ['groups' => 'collection']),
        new Post(normalizationContext: ['groups' => 'post']),
    ],

)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'flightNumber' => SearchFilter::STRATEGY_EXACT,
        'company.id' => SearchFilter::STRATEGY_EXACT,
    ]
)]
class Flight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get', 'collection', 'post'])]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Groups(['get', 'collection', 'post'])]
    private ?string $flightNumber = null;

    #[Groups(['get', 'collection', 'post'])]
    #[ORM\Column(length: 255)]
    private ?string $destination = null;

    #[Groups(['get', 'collection', 'post'])]
    #[ORM\Column(length: 5)]
    private ?string $gate = null;

    #[Groups(['get', 'collection', 'post'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $departure = null;

    #[Groups(['get', 'collection', 'post'])]
    #[ORM\ManyToOne(inversedBy: 'flights')]
    private Company $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlightNumber(): ?string
    {
        return $this->flightNumber;
    }

    public function setFlightNumber(string $flightNumber): self
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getGate(): ?string
    {
        return $this->gate;
    }

    public function setGate(string $gate): self
    {
        $this->gate = $gate;

        return $this;
    }

    public function getDeparture(): ?\DateTimeInterface
    {
        return $this->departure;
    }

    public function setDeparture(\DateTimeInterface $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
