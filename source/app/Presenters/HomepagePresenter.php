<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Service\ProjectService;
use App\Setting;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Exception;
use Nette;
use Nettrine\ORM\EntityManagerDecorator;

final class HomepagePresenter extends BasePresenter
{
    /** @var ProjectService @inject */
    public ProjectService $projectService;

    private EntityManagerDecorator $em;

    public function __construct(EntityManagerDecorator $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    public function actionDefault(): void
    {
        $this->template->homepageView = true;
    }

    public function renderDefault(): void {
        try {
            $this->em->getConnection()->connect();
        } catch (\Exception $e) {
            $this->template->dbError = true;
            $this->flashMessage("Database connection failure!", "danger");
        }
    }

    /**
     * @throws Nette\Application\AbortException
     * @throws Exception
     */
    public function handleGenerateProjects(): void
    {
        try {
            $this->projectService->generateRandomProject(Setting::NUMBER_OF_GENERATED_PROJECT);
        } catch (TableNotFoundException $tableNotFoundException){
            $this->redirect('Project:Migrate');
        }

        $this->flashMessage(Setting::NUMBER_OF_GENERATED_PROJECT . ' projects was created!', 'success');
        $this->redirect('this');
    }

}
