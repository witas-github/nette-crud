<?php

namespace App\Service;

use App\Entity\Project;
use DateTime;
use Exception;
use Nettrine\ORM\EntityManagerDecorator;

class ProjectService
{
    private EntityManagerDecorator $em;

    public function __construct(EntityManagerDecorator $em)
    {
        $this->em = $em;
    }

    /**
     * @throws Exception
     */
    public function generateRandomProject(int $amount): void
    {
        $batchSize = 20;
        for ($i = 1; $i <= $amount; ++$i) {
            $project = new Project();
            $project->setName('Project-' . uniqid());
            $project->setProjectType(random_int(1, 2));
            $project->setWebProject(random_int(0, 1));
            $project->setDeadline(new DateTime());

            $this->em->persist($project);
            if (($i % $batchSize) === 0) {
                $this->em->flush();
                $this->em->clear();
            }
        }
        $this->em->flush();
        $this->em->clear();
    }

}