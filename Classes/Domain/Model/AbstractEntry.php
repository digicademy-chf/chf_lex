<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractHeritage;

defined('TYPO3') or die();

/**
 * Model for AbstractEntry
 */
class AbstractEntry extends AbstractHeritage
{
    /**
     * Similar lexicographic entries related to this record
     * 
     * @var ?ObjectStorage<SimilarityRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $similarityRelation = null;

    /**
     * List of similarity relations that use this entry as a related record
     * 
     * @var ?ObjectStorage<SimilarityRelation>
     */
    #[Lazy()]
    protected ?ObjectStorage $asRelatedRecordOfSimilarityRelation = null;

    /**
     * Construct object
     *
     * @param LexicographicResource $parentResource
     * @param string $iri
     * @param string $uuid
     * @return AbstractEntry
     */
    public function __construct(LexicographicResource $parentResource, string $iri, string $uuid)
    {
        parent::__construct($parentResource, $iri, $uuid);
        $this->initializeObject();
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->similarityRelation ??= new ObjectStorage();
        $this->asRelatedRecordOfSimilarityRelation ??= new ObjectStorage();
    }

    /**
     * Get similarity relation
     *
     * @return ObjectStorage<SimilarityRelation>
     */
    public function getSimilarityRelation(): ?ObjectStorage
    {
        return $this->similarityRelation;
    }

    /**
     * Set similarity relation
     *
     * @param ObjectStorage<SimilarityRelation> $similarityRelation
     */
    public function setSimilarityRelation(ObjectStorage $similarityRelation): void
    {
        $this->similarityRelation = $similarityRelation;
    }

    /**
     * Add similarity relation
     *
     * @param SimilarityRelation $similarityRelation
     */
    public function addSimilarityRelation(SimilarityRelation $similarityRelation): void
    {
        $this->similarityRelation?->attach($similarityRelation);
    }

    /**
     * Remove similarity relation
     *
     * @param SimilarityRelation $similarityRelation
     */
    public function removeSimilarityRelation(SimilarityRelation $similarityRelation): void
    {
        $this->similarityRelation?->detach($similarityRelation);
    }

    /**
     * Remove all similarity relations
     */
    public function removeAllSimilarityRelation(): void
    {
        $similarityRelation = clone $this->similarityRelation;
        $this->similarityRelation->removeAll($similarityRelation);
    }

    /**
     * Get as related record of similarity relation
     *
     * @return ObjectStorage<SimilarityRelation>
     */
    public function getAsRelatedRecordOfSimilarityRelation(): ?ObjectStorage
    {
        return $this->asRelatedRecordOfSimilarityRelation;
    }

    /**
     * Set as related record of similarity relation
     *
     * @param ObjectStorage<SimilarityRelation> $asRelatedRecordOfSimilarityRelation
     */
    public function setAsRelatedRecordOfSimilarityRelation(ObjectStorage $asRelatedRecordOfSimilarityRelation): void
    {
        $this->asRelatedRecordOfSimilarityRelation = $asRelatedRecordOfSimilarityRelation;
    }

    /**
     * Add as related record of similarity relation
     *
     * @param SimilarityRelation $asRelatedRecordOfSimilarityRelation
     */
    public function addAsRelatedRecordOfSimilarityRelation(SimilarityRelation $asRelatedRecordOfSimilarityRelation): void
    {
        $this->asRelatedRecordOfSimilarityRelation?->attach($asRelatedRecordOfSimilarityRelation);
    }

    /**
     * Remove as related record of similarity relation
     *
     * @param SimilarityRelation $asRelatedRecordOfSimilarityRelation
     */
    public function removeAsRelatedRecordOfSimilarityRelation(SimilarityRelation $asRelatedRecordOfSimilarityRelation): void
    {
        $this->asRelatedRecordOfSimilarityRelation?->detach($asRelatedRecordOfSimilarityRelation);
    }

    /**
     * Remove all as related record of similarity relations
     */
    public function removeAllAsRelatedRecordOfSimilarityRelation(): void
    {
        $asRelatedRecordOfSimilarityRelation = clone $this->asRelatedRecordOfSimilarityRelation;
        $this->asRelatedRecordOfSimilarityRelation->removeAll($asRelatedRecordOfSimilarityRelation);
    }
}
