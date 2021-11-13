<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Entity\Project;
use App\Forms\ProjectFormFactory;
use Doctrine\Persistence\ObjectRepository;
use Nette;
use Nettrine\ORM\EntityManagerDecorator;


final class ProjectPresenter extends BasePresenter
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
        ProjectFormFactory     $projectFormFactory
    )
    {
        parent::__construct();

        $this->em = $em;
        $this->projectRepository = $this->em->getRepository(Project::class);
        $this->projectFormFactory = $projectFormFactory;
    }

    public function actionDefault(?int $id = null)
    {
        $this->formId = $id;
        $this->template->projectView = true;
    }

    /**
     * @throws Nette\Application\AbortException
     * @throws Nette\Application\UI\InvalidLinkException
     */
    public function handleEditModal()
    {
        $this->template->showEditModal = true;
        if ($this->isAjax()) {
            $this->redrawControl('modal');
            $this->payload->postGet = TRUE;
            $this->payload->url = $this->link('this');
        } else {
            $this->redirect('this');
        }
    }

    public function renderDefault(?int $page = null): void
    {
        if ($page === null) {
            $page = 1;
        }

        $projectsCount = $this->projectRepository->count([]);

        $paginator = new Nette\Utils\Paginator;
        $paginator->setItemCount($projectsCount);
        $paginator->setItemsPerPage(50);
        $paginator->setPage($page);

        $this->template->projects = $this->projectRepository->findBy(
            [],
            ['id' => 'desc'],
            $paginator->getItemsPerPage(),
            $paginator->getOffset()
        );
        $this->template->paginator = $paginator;

        if ($this->isAjax()) {
            $this->redrawControl();
        }
    }

    /**
     * @return Nette\Application\UI\Form
     */
    public function createComponentProjectForm(): Nette\Application\UI\Form
    {
        $projectForm = $this->projectFormFactory->create($this->formId);
        $projectForm->onSuccess[] = function () {
            $this->flashMessage("Form has been saved", "success");
        };
        $projectForm->onError[] = function () {
            $this->flashMessage("Something went wrong", "danger");
        };

        $projectForm->onSuccess[] = function () {
            if ($this->isAjax()) {
                $this->redrawControl('modal');
                $this->redrawControl('projects');
            }
        };

        return $projectForm;
    }


}
