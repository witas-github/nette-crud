<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use stdClass;

/**
 * @property-read Nette\Bridges\ApplicationLatte\Template|stdClass $template
 * @property-read stdClass $payload
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

    /**
     * @param array $snippets
     * @param array|null $params
     * @throws Nette\Application\AbortException
     * @throws Nette\Application\UI\InvalidLinkException
     */
    public function redrawSnippets(array $snippets, ?array $params = null): void
    {
        if ($this->isAjax()) {
            foreach ($snippets as $snippet) {
                $this->redrawControl($snippet);
            }
            $this->payload->postGet = TRUE;
            $this->payload->url = $this->link('this', $params);
        } else {
            $this->redirect('this');
        }
    }

}