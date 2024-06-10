<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for language tags
 */
class LanguageTag extends AbstractTag
{
    /**
     * List of entries annotated with this language
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asDistributionLanguageOfEntry;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return LanguageTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('language');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asDistributionLanguageOfEntry = new ObjectStorage();
    }

    /**
     * Get as distribution language of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsDistributionLanguageOfEntry(): ObjectStorage
    {
        return $this->asDistributionLanguageOfEntry;
    }

    /**
     * Set as distribution language of entry
     *
     * @param ObjectStorage<Entry> $asDistributionLanguageOfEntry
     */
    public function setAsDistributionLanguageOfEntry(ObjectStorage $asDistributionLanguageOfEntry): void
    {
        $this->asDistributionLanguageOfEntry = $asDistributionLanguageOfEntry;
    }

    /**
     * Add as distribution language of entry
     *
     * @param Entry $asDistributionLanguageOfEntry
     */
    public function addAsDistributionLanguageOfEntry(Entry $asDistributionLanguageOfEntry): void
    {
        $this->asDistributionLanguageOfEntry->attach($asDistributionLanguageOfEntry);
    }

    /**
     * Remove as distribution language of entry
     *
     * @param Entry $asDistributionLanguageOfEntry
     */
    public function removeAsDistributionLanguageOfEntry(Entry $asDistributionLanguageOfEntry): void
    {
        $this->asDistributionLanguageOfEntry->detach($asDistributionLanguageOfEntry);
    }

    /**
     * Remove all as distribution language of entries
     */
    public function removeAllAsDistributionLanguageOfEntries(): void
    {
        $asDistributionLanguageOfEntry = clone $this->asDistributionLanguageOfEntry;
        $this->asDistributionLanguageOfEntry->removeAll($asDistributionLanguageOfEntry);
    }
}
