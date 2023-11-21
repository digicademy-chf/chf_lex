<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\Definition;
use Digicademy\CHFLex\Domain\Repository\DefinitionRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for Definition
 */
class DefinitionController extends ActionController
{
    private DefinitionRepository $definitionRepository;

    public function injectDefinitionRepository(DefinitionRepository $definitionRepository): void
    {
        $this->definitionRepository = $definitionRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('definitions', $this->definitionRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Definition $definition): ResponseInterface
    {
        $this->view->assign('definition', $definition);
        return $this->htmlResponse();
    }
}

?>