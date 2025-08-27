<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model\Traits;

use Digicademy\CHFLex\Domain\Model\Frequency;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

defined('TYPO3') or die();

/**
 * Trait for models to include a parent-frequency property
 */
trait ParentFrequencyTrait
{
    /**
     * Frequency that this distribution is part of
     * 
     * @var Frequency|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Frequency|LazyLoadingProxy|null $parentFrequency = null;

    /**
     * Get parent frequency
     * 
     * @return Frequency
     */
    public function getParentFrequency(): Frequency
    {
        if ($this->parentFrequency instanceof LazyLoadingProxy) {
            $this->parentFrequency->_loadRealInstance();
        }
        return $this->parentFrequency;
    }

    /**
     * Set parent frequency
     * 
     * @param Frequency
     */
    public function setParentFrequency(Frequency $parentFrequency): void
    {
        $this->parentFrequency = $parentFrequency;
    }
}
