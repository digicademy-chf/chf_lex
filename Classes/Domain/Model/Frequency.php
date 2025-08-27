<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LocationRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\Traits\SourceRelationTrait;
use Digicademy\CHFMap\Domain\Model\Traits\DistributionTrait;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractFrequency
 */
class AbstractFrequency extends AbstractEntity
{
    use HiddenTrait;
    use LocationRelationTrait;
    use ParentResourceTrait;

    /**
     * Number of occurrences
     * 
     * @var int
     */
    #[Validate([
        'validator' => 'NumberRange',
        'options' => [
            'minimum' => 0,
        ],
    ])]
    protected int $tokens = 0;

    /**
     * Occurrences in second position
     * 
     * @var ?int
     */
    #[Validate([
        'validator' => 'NumberRange',
        'options' => [
            'minimum' => 0,
        ],
    ])]
    protected ?int $tokensSecondary = null;

    /**
     * Type of occurrences
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'unknown',
                'population',
                'families',
                'births',
                'landlines',
            ],
        ],
    ])]
    protected string $tokenType = 'unknown';

    /**
     * Date when this frequency applied
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $date = null;

    /**
     * Non-standard date of the frequency
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $dateText = '';

    /**
     * Sense that this frequency is part of
     * 
     * @var Sense|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Sense|LazyLoadingProxy|null $parentSense = null;

    /**
     * Dictionary entry that this frequency is part of
     * 
     * @var DictionaryEntry|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected DictionaryEntry|LazyLoadingProxy|null $parentEntry = null;

    /**
     * Construct object
     *
     * @param int $tokens
     * @return Frequency
     */
    public function __construct(int $tokens)
    {
        $this->initializeObject();

        $this->setTokens($tokens);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->locationRelation ??= new ObjectStorage();
        $this->parentResource ??= new ObjectStorage();
    }

    /**
     * Get tokens
     *
     * @return int
     */
    public function getTokens(): int
    {
        return $this->tokens;
    }

    /**
     * Set tokens
     *
     * @param int $tokens
     */
    public function setTokens(int $tokens): void
    {
        $this->tokens = $tokens;
    }

    /**
     * Get tokens secondary
     *
     * @return int
     */
    public function getTokensSecondary(): int
    {
        return $this->tokensSecondary;
    }

    /**
     * Set tokens secondary
     *
     * @param int $tokensSecondary
     */
    public function setTokensSecondary(int $tokensSecondary): void
    {
        $this->tokensSecondary = $tokensSecondary;
    }

    /**
     * Get token type
     *
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * Set token type
     *
     * @param string $tokenType
     */
    public function setTokenType(string $tokenType): void
    {
        $this->tokenType = $tokenType;
    }

    /**
     * Get date
     *
     * @return ?\DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Get date text
     *
     * @return string
     */
    public function getDateText(): string
    {
        return $this->dateText;
    }

    /**
     * Set date text
     *
     * @param string $dateText
     */
    public function setDateText(string $dateText): void
    {
        $this->dateText = $dateText;
    }

    /**
     * Get parent sense
     * 
     * @return Sense
     */
    public function getParentSense(): Sense
    {
        if ($this->parentSense instanceof LazyLoadingProxy) {
            $this->parentSense->_loadRealInstance();
        }
        return $this->parentSense;
    }

    /**
     * Set parent sense
     * 
     * @param Sense
     */
    public function setParentSense(Sense $parentSense): void
    {
        $this->parentSense = $parentSense;
    }

    /**
     * Get parent entry
     * 
     * @return DictionaryEntry
     */
    public function getParentEntry(): DictionaryEntry
    {
        if ($this->parentEntry instanceof LazyLoadingProxy) {
            $this->parentEntry->_loadRealInstance();
        }
        return $this->parentEntry;
    }

    /**
     * Set parent entry
     * 
     * @param DictionaryEntry
     */
    public function setParentEntry(DictionaryEntry $parentEntry): void
    {
        $this->parentEntry = $parentEntry;
    }
}

# If CHF Bib and CHF Map are available
if (ExtensionManagementUtility::isLoaded('chf_bib') && ExtensionManagementUtility::isLoaded('chf_map')) {

    /**
     * Model for Frequency (with source-relation and distribution properties)
     */
    class Frequency extends AbstractFrequency
    {
        use DistributionTrait;
        use SourceRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->distribution ??= new ObjectStorage();
            $this->locationRelation ??= new ObjectStorage();
            $this->sourceRelation ??= new ObjectStorage();
        }
    }

# If only CHF Bib is available
} elseif (ExtensionManagementUtility::isLoaded('chf_bib')) {

    /**
     * Model for Frequency (with source-relation property)
     */
    class Frequency extends AbstractFrequency
    {
        use SourceRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->locationRelation ??= new ObjectStorage();
            $this->sourceRelation ??= new ObjectStorage();
        }
    }

# If only CHF Map is available
} elseif (ExtensionManagementUtility::isLoaded('chf_map')) {

    /**
     * Model for Frequency (with distribution property)
     */
    class Frequency extends AbstractFrequency
    {
        use DistributionTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->distribution ??= new ObjectStorage();
            $this->locationRelation ??= new ObjectStorage();
        }
    }

# If no relevant extensions are available
} else {

    /**
     * Model for Frequency
     */
    class Frequency extends AbstractFrequency
    {}
}
