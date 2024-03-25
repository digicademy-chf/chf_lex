<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\AbstractEntry;
use Digicademy\CHFLex\Domain\Repository\AbstractEntryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for AbstractEntry
 */
class AbstractEntryController extends ActionController
{
    private AbstractEntryRepository $abstractEntryRepository;

    public function injectAbstractEntryRepository(AbstractEntryRepository $abstractEntryRepository): void
    {
        $this->abstractEntryRepository = $abstractEntryRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('dictionaryEntries', $this->abstractEntryRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(AbstractEntry $entry): ResponseInterface
    {
        $this->view->assign('dictionaryEntry', $entry);
        return $this->htmlResponse();
    }
}
