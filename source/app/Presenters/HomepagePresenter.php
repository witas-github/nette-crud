<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Entity\Project;
use Datetime;
use Doctrine\Persistence\ObjectRepository;
use Nette;
use Nettrine\ORM\EntityManagerDecorator;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private EntityManagerDecorator $em;
    private ObjectRepository $projectRepository;

    /**
     * @param EntityManagerDecorator $em
     */
    public function __construct(EntityManagerDecorator $em)
    {
        parent::__construct();

        $this->em = $em;
        $this->projectRepository = $this->em->getRepository(Project::class);
    }

    public function renderDefault(): void
    {
        $project = new Project();
        $project->setName("Fajn projekt")
            ->setDeadline(new Datetime())
            ->setProjectType(Project::PROJECT_TYPE_TIME_LIMITED)
            ->setWebProject(false);
        $this->em->persist($project);
        $this->em->flush();

        dump($this->projectRepository->findAll());
        exit();
    }
}
