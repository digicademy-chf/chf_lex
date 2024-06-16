<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\DictionaryEntry;
use Digicademy\CHFLex\Domain\Repository\DictionaryEntryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for DictionaryEntry
 */
class DictionaryEntryController extends ActionController
{
    private DictionaryEntryRepository $dictionaryEntryRepository;

    public function injectDictionaryEntryRepository(DictionaryEntryRepository $dictionaryEntryRepository): void
    {
        $this->dictionaryEntryRepository = $dictionaryEntryRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('dictionaryEntries', $this->dictionaryEntryRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(DictionaryEntry $entry): ResponseInterface
    {
        $this->view->assign('dictionaryEntry', $entry);
        return $this->htmlResponse();
    }
}
