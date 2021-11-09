<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Entity\Project;
use Doctrine\Persistence\ObjectRepository;
use Nette;
use Nettrine\ORM\EntityManagerDecorator;


final class ProjectPresenter extends Nette\Application\UI\Presenter
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

    public function actionDefault(){
        $this->template->projectView = true;
    }

    public function renderDefault(): void
    {
        $this->template->projects = $this->projectRepository->findAll();
    }


}
