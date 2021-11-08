<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette\Database\Connection;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function renderDefault(){

        print_r($this->connection->query("SHOW DATABASES;")->fetchAll());
        exit();
    }
}
