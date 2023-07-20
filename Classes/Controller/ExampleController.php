<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DALex\Domain\Model\Example;
use Digicademy\DALex\Domain\Repository\ExampleRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for examples
 */
class ExampleController extends ActionController
{
    private ExampleRepository $exampleRepository;

    public function injectExampleRepository(ExampleRepository $exampleRepository): void
    {
        $this->exampleRepository = $exampleRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('examples', $this->exampleRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Example $example): ResponseInterface
    {
        $this->view->assign('example', $example);
        return $this->htmlResponse();
    }
}

?>