<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractRelation;

defined('TYPO3') or die();

/**
 * Model for SimilarityRelation
 */
class SimilarityRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var ?ObjectStorage<object>
     */
    #[Lazy()]
    protected ?ObjectStorage $record;

    /**
     * Similar record to connect the previous record to
     * 
     * @var ?ObjectStorage<DictionaryEntry|EncyclopediaEntry>
     */
    #[Lazy()]
    protected ?ObjectStorage $relatedRecord;

    /**
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @param object $record
     * @param DictionaryEntry|EncyclopediaEntry $relatedRecord
     * @return SimilarityRelation
     */
    public function __construct(object $parentResource, string $uuid, object $record, DictionaryEntry|EncyclopediaEntry $relatedRecord)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('similarityRelation');
        $this->addRecord($record);
        $this->addRelatedRecord($relatedRecord);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->record ??= new ObjectStorage();
        $this->relatedRecord ??= new ObjectStorage();
    }

    /**
     * Get record
     *
     * @return ObjectStorage<object>
     */
    public function getRecord(): ?ObjectStorage
    {
        return $this->record;
    }

    /**
     * Set record
     *
     * @param ObjectStorage<object> $record
     */
    public function setRecord(ObjectStorage $record): void
    {
        $this->record = $record;
    }

    /**
     * Add record
     *
     * @param object $record
     */
    public function addRecord(object $record): void
    {
        $this->record?->attach($record);
    }

    /**
     * Remove record
     *
     * @param object $record
     */
    public function removeRecord(object $record): void
    {
        $this->record?->detach($record);
    }

    /**
     * Remove all records
     */
    public function removeAllRecord(): void
    {
        $record = clone $this->record;
        $this->record->removeAll($record);
    }

    /**
     * Get related record
     *
     * @return ObjectStorage<DictionaryEntry|EncyclopediaEntry>
     */
    public function getRelatedRecord(): ?ObjectStorage
    {
        return $this->relatedRecord;
    }

    /**
     * Set related record
     *
     * @param ObjectStorage<DictionaryEntry|EncyclopediaEntry> $relatedRecord
     */
    public function setRelatedRecord(ObjectStorage $relatedRecord): void
    {
        $this->relatedRecord = $relatedRecord;
    }

    /**
     * Add related record
     *
     * @param DictionaryEntry|EncyclopediaEntry $relatedRecord
     */
    public function addRelatedRecord(DictionaryEntry|EncyclopediaEntry $relatedRecord): void
    {
        $this->relatedRecord?->attach($relatedRecord);
    }

    /**
     * Remove related record
     *
     * @param DictionaryEntry|EncyclopediaEntry $relatedRecord
     */
    public function removeRelatedRecord(DictionaryEntry|EncyclopediaEntry $relatedRecord): void
    {
        $this->relatedRecord?->detach($relatedRecord);
    }

    /**
     * Remove all related records
     */
    public function removeAllRelatedRecord(): void
    {
        $relatedRecord = clone $this->relatedRecord;
        $this->relatedRecord->removeAll($relatedRecord);
    }
}
