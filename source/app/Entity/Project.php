<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    public const PROJECT_TYPE_TIME_LIMITED = 1;
    public const PROJECT_TYPE_CONTINUOUS_INTEGRATION = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @phpstan-ignore-next-line */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $deadline;

    /**
     * @ORM\Column(type="integer")
     */
    private int $projectType;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $webProject;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Project
     */
    public function setName(string $name): Project
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDeadline(): DateTime
    {
        return $this->deadline;
    }

    /**
     * @param DateTime $deadline
     * @return Project
     */
    public function setDeadline(DateTime $deadline): Project
    {
        $this->deadline = $deadline;
        return $this;
    }

    /**
     * @return int
     */
    public function getProjectType(): int
    {
        return $this->projectType;
    }

    /**
     * @param int $projectType
     * @return Project
     */
    public function setProjectType(int $projectType): Project
    {
        $this->projectType = $projectType;
        return $this;
    }

    /**
     * @return bool
     */
    public function isWebProject(): bool
    {
        return $this->webProject;
    }

    /**
     * @param bool $webProject
     * @return Project
     */
    public function setWebProject(bool $webProject): Project
    {
        $this->webProject = $webProject;
        return $this;
    }
}