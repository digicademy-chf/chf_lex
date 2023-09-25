<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for label-type tags
 */
class LabelTypeTag extends AbstractTag
{
    /**
     * List of labels of this type
     * 
     * @var ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelTypeOfTag;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return LabelTypeTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('labelType');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asLabelTypeOfTag = new ObjectStorage();
    }

    /**
     * Get as label type of tag
     *
     * @return ObjectStorage<LabelTag>
     */
    public function getAsLabelTypeOfTag(): ObjectStorage
    {
        return $this->asLabelTypeOfTag;
    }

    /**
     * Set as label type of tag
     *
     * @param ObjectStorage<LabelTag> $asLabelTypeOfTag
     */
    public function setAsLabelTypeOfTag(ObjectStorage $asLabelTypeOfTag): void
    {
        $this->asLabelTypeOfTag = $asLabelTypeOfTag;
    }

    /**
     * Add as label type of tag
     *
     * @param LabelTag $asLabelTypeOfTag
     */
    public function addAsLabelTypeOfTag(LabelTag $asLabelTypeOfTag): void
    {
        $this->asLabelTypeOfTag->attach($asLabelTypeOfTag);
    }

    /**
     * Remove as label type of tag
     *
     * @param LabelTag $asLabelTypeOfTag
     */
    public function removeAsLabelTypeOfTag(LabelTag $asLabelTypeOfTag): void
    {
        $this->asLabelTypeOfTag->detach($asLabelTypeOfTag);
    }

    /**
     * Remove all as label type of tags
     */
    public function removeAllAsLabelTypeOfTags(): void
    {
        $asLabelTypeOfTag = clone $this->asLabelTypeOfTag;
        $this->asLabelTypeOfTag->removeAll($asLabelTypeOfTag);
    }
}

?>