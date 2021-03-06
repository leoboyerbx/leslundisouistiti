<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'integer')]
    private $seats;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Application::class)]
    private $applications;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $title;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): self
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function getParticipants() {
        return $this->getApplicationsByStatus('accepted');
    }
    public function getPendingApplications() {
        return $this->getApplicationsByStatus('pending');
    }

    private function getApplicationsByStatus(string $status) {
        $applications = array_filter($this->getApplications()->toArray(), function($application) use ($status) {
            return $application->getStatus() === $status;
        });
        return array_map(function($application) {
            return $application->getUser();
        }, $applications);
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setEvent($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getEvent() === $this) {
                $application->setEvent(null);
            }
        }

        return $this;
    }

    public function getParticipantsCount() {
        return count($this->getParticipants());
    }
    public function getPendingApplicationsCount() {
        return count($this->getPendingApplications());
    }
    public function getApplicationsCount() {
        return count($this->getApplications());
    }

    public function getTitle(): ?string
    {
        if ($this->title) {
            return $this->title;
        }
        $date = $this->getDate() ?? new \DateTime();
        return 'Lundi ouistiti du ' . $date->format('d F Y');
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
