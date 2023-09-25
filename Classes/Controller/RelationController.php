<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\Relation;
use Digicademy\CHFLex\Domain\Repository\RelationRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for relations
 */
class RelationController extends ActionController
{
    private RelationRepository $relationRepository;

    public function injectRelationRepository(RelationRepository $relationRepository): void
    {
        $this->relationRepository = $relationRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('relations', $this->relationRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Relation $relation): ResponseInterface
    {
        $this->view->assign('relation', $relation);
        return $this->htmlResponse();
    }
}

?>