<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Entity\Project;
use App\Forms\ProjectFormFactory;
use App\Repository\ProjectRepository;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Doctrine\Persistence\ObjectRepository;
use Nette;
use Nettrine\ORM\EntityManagerDecorator;


final class ProjectPresenter extends BasePresenter
{
    private EntityManagerDecorator $em;
    /** @var ProjectRepository $projectRepository */
    private ObjectRepository $projectRepository;
    private ProjectFormFactory $projectFormFactory;

    private ?int $formId = null;
    private ?int $page = null;

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

    public function actionDefault(?int $id = null, ?int $page = null)
    {
        $this->formId = $id;
        $this->page = $page;

        $this->template->projectView = true;
    }

    /**
     * @throws Nette\Application\AbortException
     * @throws Nette\Application\UI\InvalidLinkException
     */
    public function handleEditModal(): void
    {
        $this->template->showEditModal = true;
        $this->redrawSnippets(['modal'], ['id' => null, 'page' => $this->page]);
    }

    /**
     * @param int $id
     * @throws Nette\Application\AbortException
     * @throws Nette\Application\UI\InvalidLinkException
     */
    public function handleDeleteProject(int $id): void
    {
        $project = $this->projectRepository->getProjectById($id);
        $project->setDeleted(true);
        $this->em->flush();
        $this->flashMessage('Project has been deleted', 'success');
        $this->redrawSnippets(['projects', 'flashes'], ['id' => null, 'page' => $this->page]);
    }

    /**
     * @param int|null $page
     * @throws Nette\Application\AbortException
     */
    public function renderDefault(?int $page = null): void
    {
        if ($page === null) {
            $page = 1;
        }

        try {
            $projectsCount = $this->projectRepository->count(['deleted' => false]);
        } catch (TableNotFoundException $tableNotFoundException){
            $this->redirect('Project:Migrate');
        }

        $paginator = new Nette\Utils\Paginator;
        $paginator->setItemCount($projectsCount);
        $paginator->setItemsPerPage(20);
        $paginator->setPage($page);

        $this->template->projects = $this->projectRepository->findBy(
            ['deleted' => false],
            ['id' => 'desc'],
            $paginator->getItemsPerPage(),
            $paginator->getOffset()
        );
        $this->template->paginator = $paginator;
        if ($this->isAjax()) {
            $this->redrawControl('projects');
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
            $this->redrawSnippets(['flashes', 'modal', 'projects']);
        };

        return $projectForm;
    }

    public function actionMigrate(){
    }

    /**
     * @throws Nette\Application\AbortException
     */
    public function handleRunMigration(){
        shell_exec("/var/www/html/bin/console migrations:migrate --no-interaction");
        sleep(1);
        $this->flashMessage("Migrations done!", "success");
        $this->redirect("Project:Default");
    }


}
