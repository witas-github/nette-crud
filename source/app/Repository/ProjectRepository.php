<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    public function getProjectById(?int $id): ?Project {
        if ($id !== null) {
            return $this->find($id);
        }
        return null;
    }

}