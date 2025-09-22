<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use Digicademy\CHFLex\Domain\Model\DictionaryEntry;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Dictionary
 */
class DictionaryController extends ActionController
{
    /**
     * Constructor takes care of dependency injection
     */
    public function __construct(
        protected readonly AbstractResourceRepository $abstractResourceRepository,
    ) {}

    /**
     * Show dictionary entry list
     *
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        // Get resource
        $resourceIdentifier = $this->settings['resource'];
        $this->view->assign('resource', $this->abstractResourceRepository->findByIdentifier($resourceIdentifier));

        // Create response
        return $this->htmlResponse();
    }

    /**
     * Show single dictionary entry
     *
     * @param DictionaryEntry $dictionaryEntry
     * @return ResponseInterface
     */
    public function showAction(DictionaryEntry $dictionaryEntry): ResponseInterface
    {
        // Get dictionary entry
        $this->view->assign('dictionaryEntry', $dictionaryEntry);

        // Create response
        return $this->htmlResponse();
    }
}
