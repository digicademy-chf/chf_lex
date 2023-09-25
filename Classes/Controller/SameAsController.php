<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\SameAs;
use Digicademy\CHFLex\Domain\Repository\SameAsRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for same as
 */
class SameAsController extends ActionController
{
    private SameAsRepository $sameAsRepository;

    public function injectSameAsRepository(SameAsRepository $sameAsRepository): void
    {
        $this->sameAsRepository = $sameAsRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('sameAss', $this->sameAsRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(SameAs $sameAs): ResponseInterface
    {
        $this->view->assign('sameAs', $sameAs);
        return $this->htmlResponse();
    }
}

?>