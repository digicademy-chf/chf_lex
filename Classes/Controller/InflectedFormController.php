<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\InflectedForm;
use Digicademy\CHFLex\Domain\Repository\InflectedFormRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for InflectedForm
 */
class InflectedFormController extends ActionController
{
    private InflectedFormRepository $inflectedFormRepository;

    public function injectInflectedFormRepository(InflectedFormRepository $inflectedFormRepository): void
    {
        $this->inflectedFormRepository = $inflectedFormRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('inflectedForms', $this->inflectedFormRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(InflectedForm $inflectedForm): ResponseInterface
    {
        $this->view->assign('inflectedForm', $inflectedForm);
        return $this->htmlResponse();
    }
}
