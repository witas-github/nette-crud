<?php
namespace App\Forms;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Setting;
use DateTime;
use Doctrine\Persistence\ObjectRepository;
use Nette\Application\UI;
use Nettrine\ORM\EntityManagerDecorator;

class ProjectFormFactory
{
    private EntityManagerDecorator $em;

    /** @var ProjectRepository projectRepository */
    private ObjectRepository $projectRepository;

    public function __construct(EntityManagerDecorator $em)
    {
        $this->em = $em;
        $this->projectRepository = $this->em->getRepository(Project::class);
    }

    public function create(?int $id): UI\Form
    {
        $form = new UI\Form;
        $form->getElementPrototype()->class('ajax');
        $project = $this->projectRepository->getProjectById($id);

        $form->addHidden('id', $id);
        $form->addText('name', 'Project name')
            ->setRequired('Field %label is required');
        $form->addText('deadline', 'Deadline')
            ->setRequired('Field %label is required');
        $form->addSelect('projectType','Type of project', Project::$projectTypeNames)
            ->setRequired('Field %label is required');
        $form->addCheckbox('webProject','Web project')
            ->setHtmlAttribute('class','form-check-input')
            ->setDefaultValue(false);

        $form->addSubmit('send', 'Send');
        $form->onSuccess[] = [$this, 'processForm'];

        if ($project !== null) {
            $form->setDefaults($project->toArray());
        }

        return $form;
    }

    public function processForm(array $values)
    {
        if (empty($values['id'])) {
            $project = new Project();
        } else {
            $projectRepository = $this->em->getRepository(Project::class);
            $project = $projectRepository->findOneBy(['id'=>$values['id']]);
        }
        $values['deadline'] = DateTime::createFromFormat(Setting::DATE_FORMAT, $values['deadline']);
        $project->fillFromArray($values);
        $this->em->persist($project);
        $this->em->flush();
    }
}
