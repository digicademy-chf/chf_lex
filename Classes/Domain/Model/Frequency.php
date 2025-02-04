<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\LocationRelation;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\SourceRelation;
use Digicademy\CHFMap\Domain\Model\Distribution;

defined('TYPO3') or die();

/**
 * Model for Frequency
 */
class Frequency extends AbstractEntity
{
    /**
     * Record visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = true;

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
     * Geographic distribution of this frequency
     * 
     * @var ?ObjectStorage<Distribution>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $distribution = null;

    /**
     * Location related to this record
     * 
     * @var ?ObjectStorage<LocationRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $locationRelation = null;

    /**
     * Sources of this database record
     * 
     * @var ?ObjectStorage<SourceRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $sourceRelation = null;

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
        $this->distribution ??= new ObjectStorage();
        $this->locationRelation ??= new ObjectStorage();
        $this->sourceRelation ??= new ObjectStorage();
    }

    /**
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Set hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
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
     * Get distribution
     *
     * @return ObjectStorage<Distribution>
     */
    public function getDistribution(): ?ObjectStorage
    {
        return $this->distribution;
    }

    /**
     * Set distribution
     *
     * @param ObjectStorage<Distribution> $distribution
     */
    public function setDistribution(ObjectStorage $distribution): void
    {
        $this->distribution = $distribution;
    }

    /**
     * Add distribution
     *
     * @param Distribution $distribution
     */
    public function addDistribution(Distribution $distribution): void
    {
        $this->distribution?->attach($distribution);
    }

    /**
     * Remove distribution
     *
     * @param Distribution $distribution
     */
    public function removeDistribution(Distribution $distribution): void
    {
        $this->distribution?->detach($distribution);
    }

    /**
     * Remove all distributions
     */
    public function removeAllDistribution(): void
    {
        $distribution = clone $this->distribution;
        $this->distribution->removeAll($distribution);
    }

    /**
     * Get location relation
     *
     * @return ObjectStorage<LocationRelation>
     */
    public function getLocationRelation(): ?ObjectStorage
    {
        return $this->locationRelation;
    }

    /**
     * Set location relation
     *
     * @param ObjectStorage<LocationRelation> $locationRelation
     */
    public function setLocationRelation(ObjectStorage $locationRelation): void
    {
        $this->locationRelation = $locationRelation;
    }

    /**
     * Add location relation
     *
     * @param LocationRelation $locationRelation
     */
    public function addLocationRelation(LocationRelation $locationRelation): void
    {
        $this->locationRelation?->attach($locationRelation);
    }

    /**
     * Remove location relation
     *
     * @param LocationRelation $locationRelation
     */
    public function removeLocationRelation(LocationRelation $locationRelation): void
    {
        $this->locationRelation?->detach($locationRelation);
    }

    /**
     * Remove all location relations
     */
    public function removeAllLocationRelation(): void
    {
        $locationRelation = clone $this->locationRelation;
        $this->locationRelation->removeAll($locationRelation);
    }

    /**
     * Get source relation
     *
     * @return ObjectStorage<SourceRelation>
     */
    public function getSourceRelation(): ?ObjectStorage
    {
        return $this->sourceRelation;
    }

    /**
     * Set source relation
     *
     * @param ObjectStorage<SourceRelation> $sourceRelation
     */
    public function setSourceRelation(ObjectStorage $sourceRelation): void
    {
        $this->sourceRelation = $sourceRelation;
    }

    /**
     * Add source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function addSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->attach($sourceRelation);
    }

    /**
     * Remove source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function removeSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->detach($sourceRelation);
    }

    /**
     * Remove all source relations
     */
    public function removeAllSourceRelation(): void
    {
        $sourceRelation = clone $this->sourceRelation;
        $this->sourceRelation->removeAll($sourceRelation);
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
