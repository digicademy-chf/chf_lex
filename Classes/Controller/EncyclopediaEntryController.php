<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use Digicademy\CHFLex\Domain\Repository\EncyclopediaEntryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for EncyclopediaEntry
 */
class EncyclopediaEntryController extends ActionController
{
    private EncyclopediaEntryRepository $encyclopediaEntryRepository;

    public function injectEncyclopediaEntryRepository(EncyclopediaEntryRepository $encyclopediaEntryRepository): void
    {
        $this->encyclopediaEntryRepository = $encyclopediaEntryRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('encyclopediaEntries', $this->encyclopediaEntryRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(EncyclopediaEntry $entry): ResponseInterface
    {
        $this->view->assign('encyclopediaEntry', $entry);
        return $this->htmlResponse();
    }
}
