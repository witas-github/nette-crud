<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Service\ProjectService;
use App\Setting;
use Exception;
use Nette;

final class HomepagePresenter extends BasePresenter
{
    /** @var ProjectService @inject */
    public ProjectService $projectService;

    public function __construct()
    {
        parent::__construct();
    }

    public function actionDefault(){
        $this->template->homepageView = true;
    }

    /**
     * @throws Nette\Application\AbortException
     * @throws Exception
     */
    public function handleGenerateProjects()
    {
        $this->projectService->generateRandomProject(Setting::NUMBER_OF_GENERATED_PROJECT);
        $this->flashMessage(Setting::NUMBER_OF_GENERATED_PROJECT . ' projects was created!', 'success');
        $this->redirect('this');
    }

}
