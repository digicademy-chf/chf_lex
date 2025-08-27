<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractResource;
use Digicademy\CHFGloss\Domain\Model\Traits\GlossaryTrait;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

/**
 * Model for AbstractLexicographicResource
 */
class AbstractLexicographicResource extends AbstractResource
{
    /**
     * Construct object
     *
     * @param string $langCode
     * @return LexicographicResource
     */
    public function __construct(string $langCode)
    {
        parent::__construct($langCode);

        $this->setType('lexicographicResource');
    }
}

# If CHF Gloss is available
if (ExtensionManagementUtility::isLoaded('chf_gloss')) {

    /**
     * Model for LexicographicResource (with glossary property)
     */
    class LexicographicResource extends AbstractLexicographicResource
    {
        use GlossaryTrait;
    }

# If no relevant extensions are available
} else {

    /**
     * Model for LexicographicResource
     */
    class LexicographicResource extends AbstractLexicographicResource
    {}
}
