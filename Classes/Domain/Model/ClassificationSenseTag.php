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

/**
 * Model for classification tags for senses
 */
class ClassificationSenseTag extends AbstractTag
{
    /**
     * List of tags on the child level of this tag
     * 
     * @var ObjectStorage<ClassificationSenseTag>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $child;

    /**
     * List of senses with this classification
     * 
     * @var ObjectStorage<Sense>
     */
    #[Lazy()]
    protected ObjectStorage $asClassificationOfSense;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return ClassificationSenseTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('classificationSense');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->child                   = new ObjectStorage();
        $this->asClassificationOfSense = new ObjectStorage();
    }

    /**
     * Get child
     *
     * @return ObjectStorage<ClassificationSenseTag>
     */
    public function getChild(): ObjectStorage
    {
        return $this->child;
    }

    /**
     * Set child
     *
     * @param ObjectStorage<ClassificationSenseTag> $child
     */
    public function setChild(ObjectStorage $child): void
    {
        $this->child = $child;
    }

    /**
     * Add child
     *
     * @param ClassificationSenseTag $child
     */
    public function addChild(ClassificationSenseTag $child): void
    {
        $this->child->attach($child);
    }

    /**
     * Remove child
     *
     * @param ClassificationSenseTag $child
     */
    public function removeChild(ClassificationSenseTag $child): void
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
     * Get as classification of sense
     *
     * @return ObjectStorage<Sense>
     */
    public function getAsClassificationOfSense(): ObjectStorage
    {
        return $this->asClassificationOfSense;
    }

    /**
     * Set as classification of sense
     *
     * @param ObjectStorage<Sense> $asClassificationOfSense
     */
    public function setAsClassificationOfSense(ObjectStorage $asClassificationOfSense): void
    {
        $this->asClassificationOfSense = $asClassificationOfSense;
    }

    /**
     * Add as classification of sense
     *
     * @param Sense $asClassificationOfSense
     */
    public function addAsClassificationOfSense(Sense $asClassificationOfSense): void
    {
        $this->asClassificationOfSense->attach($asClassificationOfSense);
    }

    /**
     * Remove as classification of sense
     *
     * @param Sense $asClassificationOfSense
     */
    public function removeAsClassificationOfSense(Sense $asClassificationOfSense): void
    {
        $this->asClassificationOfSense->detach($asClassificationOfSense);
    }

    /**
     * Remove all as classification of sense
     */
    public function removeAllAsClassificationOfSenses(): void
    {
        $asClassificationOfSense = clone $this->asClassificationOfSense;
        $this->asClassificationOfSense->removeAll($asClassificationOfSense);
    }
}

?>