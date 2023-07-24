<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use DateTime;
use Digicademy\DABib\Domain\Reference;
use Digicademy\DAMap\Domain\Feature;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for frequencies
 */
class Frequency extends AbstractEntity
{
    #[Lazy()]
    /**
     * Type of frequency
     * 
     * @var ObjectStorage<Tag>
     */
    protected $type;

    /**
     * Number of occurrences
     * 
     * @var int
     */
    protected int $tokens;

    /**
     * Occurrences in second position
     * 
     * @var int
     */
    protected int $tokensSecondary;

    #[Lazy()]
    /**
     * Place that the frequency is accounted for
     * 
     * @var ObjectStorage<Tag>
     */
    protected $countryOrRegion;

    /**
     * Date that the frequency is accounted for
     * 
     * @var DateTime
     */
    protected $date;

    #[Lazy()]
    /**
     * Token to identify a source
     * 
     * @var ObjectStorage<Tag>
     */
    protected $sourceIdentity;

    /**
     * Detailed reference, e.g., a page number
     * 
     * @var string
     */
    protected string $sourceElaboration = '';

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Full-blown reference as a source of the example
     * 
     * @var ObjectStorage<Reference>
     */
    protected $source;

    #[Lazy()]
    /**
     * Option to connect a geographical feature
     * 
     * @var ObjectStorage<Feature>
     */
    protected $geodata;

    /**
     * Initialize object
     *
     * @return Frequency
     */
    public function __construct()
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
     * @return ObjectStorage|null
     */
    public function getType(): ?ObjectStorage
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param ObjectStorage $type
     */
    public function setType($type): void
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
     * @return ObjectStorage|null
     */
    public function getCountryOrRegion(): ?ObjectStorage
    {
        return $this->countryOrRegion;
    }

    /**
     * Set country or region
     *
     * @param ObjectStorage $countryOrRegion
     */
    public function setCountryOrRegion($countryOrRegion): void
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
     * Get date
     *
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Get source identity
     *
     * @return ObjectStorage|null
     */
    public function getSourceIdentity(): ?ObjectStorage
    {
        return $this->sourceIdentity;
    }

    /**
     * Set source identity
     *
     * @param ObjectStorage $sourceIdentity
     */
    public function setSourceIdentity($sourceIdentity): void
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
     * @return ObjectStorage|null
     */
    public function getSource(): ?ObjectStorage
    {
        return $this->source;
    }

    /**
     * Set source
     *
     * @param ObjectStorage $source
     */
    public function setSource($source): void
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
     * Get geodata
     *
     * @return ObjectStorage|null
     */
    public function getLabel(): ?ObjectStorage
    {
        return $this->geodata;
    }

    /**
     * Set geodata
     *
     * @param ObjectStorage $geodata
     */
    public function setLabel($geodata): void
    {
        $this->geodata = $geodata;
    }

    /**
     * Add geodata
     *
     * @param Feature $geodata
     */
    public function addLabel(Feature $geodata): void
    {
        $this->geodata->attach($geodata);
    }

    /**
     * Remove geodata
     *
     * @param Feature $geodata
     */
    public function removeLabel(Feature $geodata): void
    {
        $this->geodata->detach($geodata);
    }
}

?>