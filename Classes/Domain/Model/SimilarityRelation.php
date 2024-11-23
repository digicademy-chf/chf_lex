<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
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
     * @var DictionaryEntry|EncyclopediaEntry|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected DictionaryEntry|EncyclopediaEntry|null $record = null;

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
     * @param DictionaryEntry|EncyclopediaEntry $record
     * @param DictionaryEntry|EncyclopediaEntry $relatedRecord
     * @param LexicographicRelation $parentResource
     * @param string $uuid
     * @return SimilarityRelation
     */
    public function __construct(DictionaryEntry|EncyclopediaEntry $record, DictionaryEntry|EncyclopediaEntry $relatedRecord, LexicographicRelation $parentResource, string $uuid)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('similarityRelation');
        $this->setRecord($record);
        $this->addRelatedRecord($relatedRecord);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->relatedRecord ??= new ObjectStorage();
    }

    /**
     * Get record
     * 
     * @return DictionaryEntry|EncyclopediaEntry
     */
    public function getRecord(): DictionaryEntry|EncyclopediaEntry
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param DictionaryEntry|EncyclopediaEntry
     */
    public function setRecord(DictionaryEntry|EncyclopediaEntry $record): void
    {
        $this->record = $record;
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
