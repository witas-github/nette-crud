<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    public const ITEM_COUNT = 100;

    public function __construct()
    {
        parent::__construct();
    }

    public function handleGenerator()
    {


    }

}
