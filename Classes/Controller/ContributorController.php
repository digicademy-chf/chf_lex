<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DALex\Domain\Model\Contributor;
use Digicademy\DALex\Domain\Repository\ContributorRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for contributors
 */
class ContributorController extends ActionController
{
    private ContributorRepository $contributorRepository;

    public function injectContributorRepository(ContributorRepository $contributorRepository): void
    {
        $this->contributorRepository = $contributorRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('contributors', $this->contributorRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Contributor $contributor): ResponseInterface
    {
        $this->view->assign('contributor', $contributor);
        return $this->htmlResponse();
    }
}

?>