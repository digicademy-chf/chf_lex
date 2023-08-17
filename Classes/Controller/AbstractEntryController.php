<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DALex\Domain\Model\AbstractEntry;
use Digicademy\DALex\Domain\Repository\AbstractEntryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for entries
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
        $this->view->assign('entries', $this->abstractEntryRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(AbstractEntry $entry): ResponseInterface
    {
        $this->view->assign('entry', $entry);
        return $this->htmlResponse();
    }
}

?>