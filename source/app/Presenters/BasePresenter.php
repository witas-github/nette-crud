<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use stdClass;

/**
 * @property-read Nette\Bridges\ApplicationLatte\Template|stdClass $template
 */
Abstract class BasePresenter extends Nette\Application\UI\Presenter
{

}