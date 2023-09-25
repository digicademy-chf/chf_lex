<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\AbstractTag;
use Digicademy\CHFLex\Domain\Repository\AbstractTagRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for tags
 */
class AbstractTagController extends ActionController
{
    private AbstractTagRepository $abstractTagRepository;

    public function injectAbstractTagRepository(AbstractTagRepository $abstractTagRepository): void
    {
        $this->abstractTagRepository = $abstractTagRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('tags', $this->abstractTagRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(AbstractTag $tag): ResponseInterface
    {
        $this->view->assign('tag', $tag);
        return $this->htmlResponse();
    }
}

?>