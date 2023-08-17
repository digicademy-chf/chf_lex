<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for classification tags for entries
 */
class ClassificationEntryTag extends AbstractTag
{
    /**
     * List of tags on the child level of this tag
     * 
     * @var ObjectStorage<ClassificationEntryTag>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $child;

    /**
     * List of entries with this classification
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asClassificationOfEntry;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return ClassificationEntryTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('classificationEntry');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->child                   = new ObjectStorage();
        $this->asClassificationOfEntry = new ObjectStorage();
    }

    /**
     * Get child
     *
     * @return ObjectStorage<ClassificationEntryTag>
     */
    public function getChild(): ObjectStorage
    {
        return $this->child;
    }

    /**
     * Set child
     *
     * @param ObjectStorage<ClassificationEntryTag> $child
     */
    public function setChild(ObjectStorage $child): void
    {
        $this->child = $child;
    }

    /**
     * Add child
     *
     * @param ClassificationEntryTag $child
     */
    public function addChild(ClassificationEntryTag $child): void
    {
        $this->child->attach($child);
    }

    /**
     * Remove child
     *
     * @param ClassificationEntryTag $child
     */
    public function removeChild(ClassificationEntryTag $child): void
    {
        $this->child->detach($child);
    }

    /**
     * Remove all children
     */
    public function removeAllChildren(): void
    {
        $child = clone $this->child;
        $this->child->removeAll($child);
    }

    /**
     * Get as classification of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsClassificationOfEntry(): ObjectStorage
    {
        return $this->asClassificationOfEntry;
    }

    /**
     * Set as classification of entry
     *
     * @param ObjectStorage<Entry> $asClassificationOfEntry
     */
    public function setAsClassificationOfEntry(ObjectStorage $asClassificationOfEntry): void
    {
        $this->asClassificationOfEntry = $asClassificationOfEntry;
    }

    /**
     * Add as classification of entry
     *
     * @param Entry $asClassificationOfEntry
     */
    public function addAsClassificationOfEntry(Entry $asClassificationOfEntry): void
    {
        $this->asClassificationOfEntry->attach($asClassificationOfEntry);
    }

    /**
     * Remove as classification of entry
     *
     * @param Entry $asClassificationOfEntry
     */
    public function removeAsClassificationOfEntry(Entry $asClassificationOfEntry): void
    {
        $this->asClassificationOfEntry->detach($asClassificationOfEntry);
    }

    /**
     * Remove all as classification of entries
     */
    public function removeAllAsClassificationOfEntries(): void
    {
        $asClassificationOfEntry = clone $this->asClassificationOfEntry;
        $this->asClassificationOfEntry->removeAll($asClassificationOfEntry);
    }
}

?>