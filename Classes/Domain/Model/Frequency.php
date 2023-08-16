<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use DateTime;
use Digicademy\DABib\Domain\Model\Reference;
use Digicademy\DAMap\Domain\Model\Feature;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for frequencies
 */
class Frequency extends AbstractEntity
{
    /**
     * Type of frequency
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $type;

    /**
     * Number of occurrences
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $tokens = null;

    /**
     * Occurrences in second position
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $tokensSecondary = null;

    /**
     * Place that the frequency is accounted for
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $countryOrRegion;

    /**
     * Approximate date that the frequency is accounted for
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $dateCirca = '';

    /**
     * Exact onset of the period that the frequency is accounted for
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $dateStart = null;

    /**
     * Exact ending of the period that the frequency is accounted for
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $dateEnd = null;

    /**
     * Token to identify a source
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $sourceIdentity;

    /**
     * Detailed reference, e.g., a page number
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $sourceElaboration = '';

    /**
     * Full-blown reference as a source of the frequency
     * 
     * @var ObjectStorage<Reference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $source;

    /**
     * Option to connect a geographical feature
     * 
     * @var ObjectStorage<Feature>
     */
    #[Lazy()]
    protected ObjectStorage $geodata;

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
        $this->type            = new ObjectStorage();
        $this->countryOrRegion = new ObjectStorage();
        $this->sourceIdentity  = new ObjectStorage();
        $this->source          = new ObjectStorage();
        $this->geodata         = new ObjectStorage();
    }

    /**
     * Get type
     *
     * @return ObjectStorage<Tag>
     */
    public function getType(): ObjectStorage
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param ObjectStorage<Tag> $type
     */
    public function setType(ObjectStorage $type): void
    {
        $this->type = $type;
    }

    /**
     * Add type
     *
     * @param Tag $type
     */
    public function addType(Tag $type): void
    {
        $this->type->attach($type);
    }

    /**
     * Remove type
     *
     * @param Tag $type
     */
    public function removeType(Tag $type): void
    {
        $this->type->detach($type);
    }

    /**
     * Remove all types
     */
    public function removeAllTypes(): void
    {
        $type = clone $this->type;
        $this->type->removeAll($type);
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
     * Get country or region
     *
     * @return ObjectStorage<Tag>
     */
    public function getCountryOrRegion(): ObjectStorage
    {
        return $this->countryOrRegion;
    }

    /**
     * Set country or region
     *
     * @param ObjectStorage<Tag> $countryOrRegion
     */
    public function setCountryOrRegion(ObjectStorage $countryOrRegion): void
    {
        $this->countryOrRegion = $countryOrRegion;
    }

    /**
     * Add country or region
     *
     * @param Tag $countryOrRegion
     */
    public function addCountryOrRegion(Tag $countryOrRegion): void
    {
        $this->countryOrRegion->attach($countryOrRegion);
    }

    /**
     * Remove country or region
     *
     * @param Tag $countryOrRegion
     */
    public function removeCountryOrRegion(Tag $countryOrRegion): void
    {
        $this->countryOrRegion->detach($countryOrRegion);
    }

    /**
     * Remove all countries or regions
     */
    public function removeAllCountriesOrRegions(): void
    {
        $countryOrRegion = clone $this->countryOrRegion;
        $this->countryOrRegion->removeAll($countryOrRegion);
    }

    /**
     * Get date circa
     *
     * @return string
     */
    public function getDateCirca(): string
    {
        return $this->dateCirca;
    }

    /**
     * Set date circa
     *
     * @param string $dateCirca
     */
    public function setDateCirca(string $dateCirca): void
    {
        $this->dateCirca = $dateCirca;
    }

    /**
     * Get date start
     *
     * @return DateTime
     */
    public function getDateStart(): DateTime
    {
        return $this->dateStart;
    }

    /**
     * Set date start
     *
     * @param DateTime $dateStart
     */
    public function setDateStart(DateTime $dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    /**
     * Get date end
     *
     * @return DateTime
     */
    public function getDateEnd(): DateTime
    {
        return $this->dateEnd;
    }

    /**
     * Set date end
     *
     * @param DateTime $dateEnd
     */
    public function setDateEnd(DateTime $dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * Get source identity
     *
     * @return ObjectStorage<Tag>
     */
    public function getSourceIdentity(): ObjectStorage
    {
        return $this->sourceIdentity;
    }

    /**
     * Set source identity
     *
     * @param ObjectStorage<Tag> $sourceIdentity
     */
    public function setSourceIdentity(ObjectStorage $sourceIdentity): void
    {
        $this->sourceIdentity = $sourceIdentity;
    }

    /**
     * Add source identity
     *
     * @param Tag $sourceIdentity
     */
    public function addSourceIdentity(Tag $sourceIdentity): void
    {
        $this->sourceIdentity->attach($sourceIdentity);
    }

    /**
     * Remove source identity
     *
     * @param Tag $sourceIdentity
     */
    public function removeSourceIdentity(Tag $sourceIdentity): void
    {
        $this->sourceIdentity->detach($sourceIdentity);
    }

    /**
     * Remove all source identities
     */
    public function removeAllSourceIdentities(): void
    {
        $sourceIdentity = clone $this->sourceIdentity;
        $this->sourceIdentity->removeAll($sourceIdentity);
    }

    /**
     * Get source elaboration
     *
     * @return string
     */
    public function getSourceElaboration(): string
    {
        return $this->sourceElaboration;
    }

    /**
     * Set source elaboration
     *
     * @param string $sourceElaboration
     */
    public function setSourceElaboration(string $sourceElaboration): void
    {
        $this->sourceElaboration = $sourceElaboration;
    }

    /**
     * Get source
     *
     * @return ObjectStorage<Reference>
     */
    public function getSource(): ObjectStorage
    {
        return $this->source;
    }

    /**
     * Set source
     *
     * @param ObjectStorage<Reference> $source
     */
    public function setSource(ObjectStorage $source): void
    {
        $this->source = $source;
    }

    /**
     * Add source
     *
     * @param Reference $source
     */
    public function addSource(Reference $source): void
    {
        $this->source->attach($source);
    }

    /**
     * Remove source
     *
     * @param Reference $source
     */
    public function removeSource(Reference $source): void
    {
        $this->source->detach($source);
    }

    /**
     * Remove all sources
     */
    public function removeAllSources(): void
    {
        $source = clone $this->source;
        $this->source->removeAll($source);
    }

    /**
     * Get geodata
     *
     * @return ObjectStorage<Feature>
     */
    public function getGeodata(): ObjectStorage
    {
        return $this->geodata;
    }

    /**
     * Set geodata
     *
     * @param ObjectStorage<Feature> $geodata
     */
    public function setGeodata(ObjectStorage $geodata): void
    {
        $this->geodata = $geodata;
    }

    /**
     * Add geodata
     *
     * @param Feature $geodata
     */
    public function addGeodata(Feature $geodata): void
    {
        $this->geodata->attach($geodata);
    }

    /**
     * Remove geodata
     *
     * @param Feature $geodata
     */
    public function removeGeodata(Feature $geodata): void
    {
        $this->geodata->detach($geodata);
    }

    /**
     * Remove all geodatas
     */
    public function removeAllGeodatas(): void
    {
        $geodata = clone $this->geodata;
        $this->geodata->removeAll($geodata);
    }
}

?>