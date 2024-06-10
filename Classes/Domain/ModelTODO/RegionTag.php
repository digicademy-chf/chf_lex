<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for region tags
 */
class RegionTag extends AbstractTag
{
    /**
     * List of frequencies with this country or region
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    protected ObjectStorage $asCountryOrRegionOfFrequency;

    /**
     * List of entries with this regional distribution
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asDistributionRegionOfEntry;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return RegionTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('region');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asCountryOrRegionOfFrequency  = new ObjectStorage();
        $this->asDistributionRegionOfEntry   = new ObjectStorage();
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
     * Get as distribution region of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsDistributionRegionOfEntry(): ObjectStorage
    {
        return $this->asDistributionRegionOfEntry;
    }

    /**
     * Set as distribution region of entry
     *
     * @param ObjectStorage<Entry> $asDistributionRegionOfEntry
     */
    public function setAsDistributionRegionOfEntry(ObjectStorage $asDistributionRegionOfEntry): void
    {
        $this->asDistributionRegionOfEntry = $asDistributionRegionOfEntry;
    }

    /**
     * Add as distribution region of entry
     *
     * @param Entry $asDistributionRegionOfEntry
     */
    public function addAsDistributionRegionOfEntry(Entry $asDistributionRegionOfEntry): void
    {
        $this->asDistributionRegionOfEntry->attach($asDistributionRegionOfEntry);
    }

    /**
     * Remove as distribution region of entry
     *
     * @param Entry $asDistributionRegionOfEntry
     */
    public function removeAsDistributionRegionOfEntry(Entry $asDistributionRegionOfEntry): void
    {
        $this->asDistributionRegionOfEntry->detach($asDistributionRegionOfEntry);
    }

    /**
     * Remove all as distribution region of entries
     */
    public function removeAllAsDistributionRegionOfEntries(): void
    {
        $asDistributionRegionOfEntry = clone $this->asDistributionRegionOfEntry;
        $this->asDistributionRegionOfEntry->removeAll($asDistributionRegionOfEntry);
    }
}
