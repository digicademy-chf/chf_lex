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
 * Model for part-of-speech tags
 */
class PartOfSpeechTag extends AbstractTag
{
    /**
     * List of tags with this part of speech as a constraint
     * 
     * @var ObjectStorage<LabelTag|InflectedFormTag>
     */
    #[Lazy()]
    protected ObjectStorage $asForPartOfSpeechOfTag;

    /**
     * List of entries annotated with this part of speech
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asPartOfSpeechOfEntry;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return PartOfSpeechTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('partOfSpeech');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asForPartOfSpeechOfTag = new ObjectStorage();
        $this->asPartOfSpeechOfEntry  = new ObjectStorage();
    }

    /**
     * Get as for part of speech of tag
     *
     * @return ObjectStorage<LabelTag|InflectedFormTag>
     */
    public function getAsForPartOfSpeechOfTag(): ObjectStorage
    {
        return $this->asForPartOfSpeechOfTag;
    }

    /**
     * Set as for part of speech of tag
     *
     * @param ObjectStorage<LabelTag|InflectedFormTag> $asForPartOfSpeechOfTag
     */
    public function setAsForPartOfSpeechOfTag(ObjectStorage $asForPartOfSpeechOfTag): void
    {
        $this->asForPartOfSpeechOfTag = $asForPartOfSpeechOfTag;
    }

    /**
     * Add as for part of speech of tag
     *
     * @param LabelTag|InflectedFormTag $asForPartOfSpeechOfTag
     */
    public function addAsForPartOfSpeechOfTag(LabelTag|InflectedFormTag $asForPartOfSpeechOfTag): void
    {
        $this->asForPartOfSpeechOfTag->attach($asForPartOfSpeechOfTag);
    }

    /**
     * Remove as for part of speech of tag
     *
     * @param LabelTag|InflectedFormTag $asForPartOfSpeechOfTag
     */
    public function removeAsForPartOfSpeechOfTag(LabelTag|InflectedFormTag $asForPartOfSpeechOfTag): void
    {
        $this->asForPartOfSpeechOfTag->detach($asForPartOfSpeechOfTag);
    }

    /**
     * Remove all as for part of speech of tags
     */
    public function removeAllAsForPartOfSpeechOfTags(): void
    {
        $asForPartOfSpeechOfTag = clone $this->asForPartOfSpeechOfTag;
        $this->asForPartOfSpeechOfTag->removeAll($asForPartOfSpeechOfTag);
    }

    /**
     * Get as part of speech of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsPartOfSpeechOfEntry(): ObjectStorage
    {
        return $this->asPartOfSpeechOfEntry;
    }

    /**
     * Set as part of speech of entry
     *
     * @param ObjectStorage<Entry> $asPartOfSpeechOfEntry
     */
    public function setAsPartOfSpeechOfEntry(ObjectStorage $asPartOfSpeechOfEntry): void
    {
        $this->asPartOfSpeechOfEntry = $asPartOfSpeechOfEntry;
    }

    /**
     * Add as part of speech of entry
     *
     * @param Entry $asPartOfSpeechOfEntry
     */
    public function addAsPartOfSpeechOfEntry(Entry $asPartOfSpeechOfEntry): void
    {
        $this->asPartOfSpeechOfEntry->attach($asPartOfSpeechOfEntry);
    }

    /**
     * Remove as part of speech of entry
     *
     * @param Entry $asPartOfSpeechOfEntry
     */
    public function removeAsPartOfSpeechOfEntry(Entry $asPartOfSpeechOfEntry): void
    {
        $this->asPartOfSpeechOfEntry->detach($asPartOfSpeechOfEntry);
    }

    /**
     * Remove all as part of speech of entries
     */
    public function removeAllAsPartOfSpeechOfEntries(): void
    {
        $asPartOfSpeechOfEntry = clone $this->asPartOfSpeechOfEntry;
        $this->asPartOfSpeechOfEntry->removeAll($asPartOfSpeechOfEntry);
    }
}
