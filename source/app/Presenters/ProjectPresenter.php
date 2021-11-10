<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Entity\Project;
use App\Forms\ProjectFormFactory;
use Doctrine\Persistence\ObjectRepository;
use Nette;
use Nettrine\ORM\EntityManagerDecorator;


final class ProjectPresenter extends Nette\Application\UI\Presenter
{
    private EntityManagerDecorator $em;
    private ObjectRepository $projectRepository;
    private ProjectFormFactory $projectFormFactory;

    private ?int $formId = null;

    /**
     * @param EntityManagerDecorator $em
     * @param ProjectFormFactory $projectFormFactory
     */
    public function __construct(
        EntityManagerDecorator $em,
        ProjectFormFactory $projectFormFactory
    )
    {
        parent::__construct();

        $this->em = $em;
        $this->projectRepository = $this->em->getRepository(Project::class);
        $this->projectFormFactory = $projectFormFactory;
    }

    public function actionDefault(?int $id = null){
        $this->formId = $id;
        $this->template->projectView = true;
    }

    public function renderDefault(): void
    {
        $this->template->projects = $this->projectRepository->findBy([], ['id'=>'desc']);
    }

    /**
     * @return Nette\Application\UI\Form
     */
    public function createComponentProjectForm(): Nette\Application\UI\Form
    {
        return $this->projectFormFactory->create($this->formId);
    }


}
