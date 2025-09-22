<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model\Traits;

use Digicademy\CHFLex\Domain\Model\SimilarityRelation;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include a similarity-relation property
 */
trait SimilarityRelationTrait
{
    /**
     * Similar lexicographic entries related to this record
     * 
     * @var ObjectStorage<SimilarityRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $similarityRelation;

    /**
     * Get similarity relation
     *
     * @return ObjectStorage<SimilarityRelation>
     */
    public function getSimilarityRelation(): ObjectStorage
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
        $this->similarityRelation->attach($similarityRelation);
    }

    /**
     * Remove similarity relation
     *
     * @param SimilarityRelation $similarityRelation
     */
    public function removeSimilarityRelation(SimilarityRelation $similarityRelation): void
    {
        $this->similarityRelation->detach($similarityRelation);
    }

    /**
     * Remove all similarity relations
     */
    public function removeAllSimilarityRelation(): void
    {
        $similarityRelation = clone $this->similarityRelation;
        $this->similarityRelation->removeAll($similarityRelation);
    }
}
