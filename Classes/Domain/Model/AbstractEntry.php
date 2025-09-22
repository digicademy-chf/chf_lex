<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractHeritage;
use Digicademy\CHFLex\Domain\Model\Traits\SimilarityRelationTrait;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractEntry
 */
class AbstractEntry extends AbstractHeritage
{
    use SimilarityRelationTrait;

    /**
     * Construct object
     *
     * @return AbstractEntry
     */
    public function __construct()
    {
        parent::__construct();
        $this->initializeObject();
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->similarityRelation = new ObjectStorage();
    }
}
