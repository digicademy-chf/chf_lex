<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\Sense;
use Digicademy\CHFLex\Domain\Repository\SenseRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for senses
 */
class SenseController extends ActionController
{
    private SenseRepository $senseRepository;

    public function injectSenseRepository(SenseRepository $senseRepository): void
    {
        $this->senseRepository = $senseRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('senses', $this->senseRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Sense $sense): ResponseInterface
    {
        $this->view->assign('sense', $sense);
        return $this->htmlResponse();
    }
}

?>