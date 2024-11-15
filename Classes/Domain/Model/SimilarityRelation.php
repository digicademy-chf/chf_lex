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
     * @var object|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected object|null $record = null;

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
     * @param object $record
     * @param DictionaryEntry|EncyclopediaEntry $relatedRecord
     * @param object $parentResource
     * @param string $uuid
     * @return SimilarityRelation
     */
    public function __construct(object $record, DictionaryEntry|EncyclopediaEntry $relatedRecord, object $parentResource, string $uuid)
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
     * @return object
     */
    public function getRecord(): object
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param object
     */
    public function setRecord(object $record): void
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
