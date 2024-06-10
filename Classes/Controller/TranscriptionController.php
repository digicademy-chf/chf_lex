<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\Transcription;
use Digicademy\CHFLex\Domain\Repository\TranscriptionRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Transcription
 */
class TranscriptionController extends ActionController
{
    private TranscriptionRepository $transcriptionRepository;

    public function injectTranscriptionRepository(TranscriptionRepository $transcriptionRepository): void
    {
        $this->transcriptionRepository = $transcriptionRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('transcriptions', $this->transcriptionRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Transcription $transcription): ResponseInterface
    {
        $this->view->assign('transcription', $transcription);
        return $this->htmlResponse();
    }
}
