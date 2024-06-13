<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractHeritage;

defined('TYPO3') or die();

/**
 * Model for AbstractEntry
 */
class AbstractEntry extends AbstractHeritage
{
    /**
     * Steps taken in creating the entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $editorialSteps = '';

    /**
     * The entry's publication status
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $publicationSteps = '';

    /**
     * Similarities relevant to this entry described by a relation
     * 
     * @var ?ObjectStorage<SimilarityRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $similarityRelation = null;

    /**
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @return AbstractEntry
     */
    public function __construct(object $parentResource, string $uuid)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->similarityRelation ??= new ObjectStorage();
    }

    /**
     * Get editorial steps
     *
     * @return string
     */
    public function getEditorialSteps(): string
    {
        return $this->editorialSteps;
    }

    /**
     * Set editorial steps
     *
     * @param string $editorialSteps
     */
    public function setEditorialSteps(string $editorialSteps): void
    {
        $this->editorialSteps = $editorialSteps;
    }

    /**
     * Get publication steps
     *
     * @return string
     */
    public function getPublicationSteps(): string
    {
        return $this->publicationSteps;
    }

    /**
     * Set publication steps
     *
     * @param string $publicationSteps
     */
    public function setPublicationSteps(string $publicationSteps): void
    {
        $this->publicationSteps = $publicationSteps;
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
}
