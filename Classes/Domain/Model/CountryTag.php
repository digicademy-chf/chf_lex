<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for country tags
 */
class CountryTag extends AbstractTag
{
    /**
     * List of frequencies with this country or region
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    protected ObjectStorage $asCountryOrRegionOfFrequency;

    /**
     * List of entries with this main distribution
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asDistributionCountryOfEntry;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return CountryTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('country');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asCountryOrRegionOfFrequency  = new ObjectStorage();
        $this->asDistributionCountryOfEntry  = new ObjectStorage();
    }

    /**
     * Get as country or region of frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getAsCountryOrRegionOfFrequency(): ObjectStorage
    {
        return $this->asCountryOrRegionOfFrequency;
    }

    /**
     * Set as country or region of frequency
     *
     * @param ObjectStorage<Frequency> $asCountryOrRegionOfFrequency
     */
    public function setAsCountryOrRegionOfFrequency(ObjectStorage $asCountryOrRegionOfFrequency): void
    {
        $this->asCountryOrRegionOfFrequency = $asCountryOrRegionOfFrequency;
    }

    /**
     * Add as country or region of frequency
     *
     * @param Frequency $asCountryOrRegionOfFrequency
     */
    public function addAsCountryOrRegionOfFrequency(Frequency $asCountryOrRegionOfFrequency): void
    {
        $this->asCountryOrRegionOfFrequency->attach($asCountryOrRegionOfFrequency);
    }

    /**
     * Remove as country or region of frequency
     *
     * @param Frequency $asCountryOrRegionOfFrequency
     */
    public function removeAsCountryOrRegionOfFrequency(Frequency $asCountryOrRegionOfFrequency): void
    {
        $this->asCountryOrRegionOfFrequency->detach($asCountryOrRegionOfFrequency);
    }

    /**
     * Remove all as country or region of frequencies
     */
    public function removeAllAsCountryOrRegionOfFrequencies(): void
    {
        $asCountryOrRegionOfFrequency = clone $this->asCountryOrRegionOfFrequency;
        $this->asCountryOrRegionOfFrequency->removeAll($asCountryOrRegionOfFrequency);
    }

    /**
     * Get as distribution country of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsDistributionCountryOfEntry(): ObjectStorage
    {
        return $this->asDistributionCountryOfEntry;
    }

    /**
     * Set as distribution country of entry
     *
     * @param ObjectStorage<Entry> $asDistributionCountryOfEntry
     */
    public function setAsDistributionCountryOfEntry(ObjectStorage $asDistributionCountryOfEntry): void
    {
        $this->asDistributionCountryOfEntry = $asDistributionCountryOfEntry;
    }

    /**
     * Add as distribution country of entry
     *
     * @param Entry $asDistributionCountryOfEntry
     */
    public function addAsDistributionCountryOfEntry(Entry $asDistributionCountryOfEntry): void
    {
        $this->asDistributionCountryOfEntry->attach($asDistributionCountryOfEntry);
    }

    /**
     * Remove as distribution country of entry
     *
     * @param Entry $asDistributionCountryOfEntry
     */
    public function removeAsDistributionCountryOfEntry(Entry $asDistributionCountryOfEntry): void
    {
        $this->asDistributionCountryOfEntry->detach($asDistributionCountryOfEntry);
    }

    /**
     * Remove all as distribution country of entries
     */
    public function removeAllAsDistributionCountryOfEntries(): void
    {
        $asDistributionCountryOfEntry = clone $this->asDistributionCountryOfEntry;
        $this->asDistributionCountryOfEntry->removeAll($asDistributionCountryOfEntry);
    }
}

?>