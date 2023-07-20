<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DALex\Domain\Model\Frequency;
use Digicademy\DALex\Domain\Repository\FrequencyRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for frequencies
 */
class FrequencyController extends ActionController
{
    private FrequencyRepository $frequencyRepository;

    public function injectFrequencyRepository(FrequencyRepository $frequencyRepository): void
    {
        $this->frequencyRepository = $frequencyRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('frequencies', $this->frequencyRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Frequency $frequency): ResponseInterface
    {
        $this->view->assign('frequency', $frequency);
        return $this->htmlResponse();
    }
}

?>