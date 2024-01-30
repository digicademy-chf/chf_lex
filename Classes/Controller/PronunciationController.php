<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\Pronunciation;
use Digicademy\CHFLex\Domain\Repository\PronunciationRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for Pronunciation
 */
class PronunciationController extends ActionController
{
    private PronunciationRepository $pronunciationRepository;

    public function injectPronunciationRepository(PronunciationRepository $pronunciationRepository): void
    {
        $this->pronunciationRepository = $pronunciationRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('pronunciations', $this->pronunciationRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Pronunciation $pronunciation): ResponseInterface
    {
        $this->view->assign('pronunciation', $pronunciation);
        return $this->htmlResponse();
    }
}
