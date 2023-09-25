<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFLex\Domain\Repository\LexicographicResourceRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for lexicographic resources
 */
class LexicographicResourceController extends ActionController
{
    private LexicographicResourceRepository $lexicographicResourceRepository;

    public function injectLexicographicResourceRepository(LexicographicResourceRepository $lexicographicResourceRepository): void
    {
        $this->lexicographicResourceRepository = $lexicographicResourceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('lexicographicResources', $this->lexicographicResourceRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(LexicographicResource $lexicographicResource): ResponseInterface
    {
        $this->view->assign('lexicographicResource', $lexicographicResource);
        return $this->htmlResponse();
    }
}

?>