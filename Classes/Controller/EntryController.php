<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DALex\Domain\Model\Entry;
use Digicademy\DALex\Domain\Repository\EntryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for entries
 */
class EntryController extends ActionController
{
    private EntryRepository $entryRepository;

    public function injectEntryRepository(EntryRepository $entryRepository): void
    {
        $this->entryRepository = $entryRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('entries', $this->entryRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Entry $entry): ResponseInterface
    {
        $this->view->assign('entry', $entry);
        return $this->htmlResponse();
    }
}

?>