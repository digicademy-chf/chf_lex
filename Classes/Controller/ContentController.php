<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DALex\Domain\Model\Content;
use Digicademy\DALex\Domain\Repository\ContentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for content
 */
class ContentController extends ActionController
{
    private ContentRepository $contentRepository;

    public function injectContentRepository(ContentRepository $contentRepository): void
    {
        $this->contentRepository = $contentRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('contents', $this->contentRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Content $content): ResponseInterface
    {
        $this->view->assign('content', $content);
        return $this->htmlResponse();
    }
}

?>