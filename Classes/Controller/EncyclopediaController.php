<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Cache\CacheTag;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Encyclopedia
 */
class EncyclopediaController extends ActionController
{
    private AbstractResourceRepository $abstractResourceRepository;

    public function injectAbstractResourceRepository(AbstractResourceRepository $abstractResourceRepository): void
    {
        $this->abstractResourceRepository = $abstractResourceRepository;
    }

    /**
     * Show encyclopedia entry list
     *
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        // Get resource
        $resourceIdentifier = $this->settings['resource'];
        $this->view->assign('resource', $this->abstractResourceRepository->findByIdentifier($resourceIdentifier));

        // Set cache tag
        $cacheDataCollector = $this->request->getAttribute('frontend.cache.collector');
        $cacheDataCollector->addCacheTags(
            new CacheTag('chf')
        );

        // Create response
        return $this->htmlResponse();
    }

    /**
     * Show single encyclopedia entry
     *
     * @param EncyclopediaEntry $encyclopediaEntry
     * @return ResponseInterface
     */
    public function showAction(EncyclopediaEntry $encyclopediaEntry): ResponseInterface
    {
        // Get encyclopedia entry
        $this->view->assign('encyclopediaEntry', $encyclopediaEntry);

        // Set cache tag
        $cacheDataCollector = $this->request->getAttribute('frontend.cache.collector');
        $cacheDataCollector->addCacheTags(
            new CacheTag('chf')
        );

        // Create response
        return $this->htmlResponse();
    }
}
