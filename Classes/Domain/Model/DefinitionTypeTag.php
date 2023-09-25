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
 * Model for definition-type tags
 */
class DefinitionTypeTag extends AbstractTag
{
    /**
     * List of definitions of this type
     * 
     * @var ObjectStorage<Definition>
     */
    #[Lazy()]
    protected ObjectStorage $asTypeOfDefinition;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return DefinitionTypeTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('definitionType');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asTypeOfDefinition = new ObjectStorage();
    }

    /**
     * Get as type of definition
     *
     * @return ObjectStorage<Definition>
     */
    public function getAsTypeOfDefinition(): ObjectStorage
    {
        return $this->asTypeOfDefinition;
    }

    /**
     * Set as type of definition
     *
     * @param ObjectStorage<Definition> $asTypeOfDefinition
     */
    public function setAsTypeOfDefinition(ObjectStorage $asTypeOfDefinition): void
    {
        $this->asTypeOfDefinition = $asTypeOfDefinition;
    }

    /**
     * Add as type of definition
     *
     * @param Definition $asTypeOfDefinition
     */
    public function addAsTypeOfDefinition(Definition $asTypeOfDefinition): void
    {
        $this->asTypeOfDefinition->attach($asTypeOfDefinition);
    }

    /**
     * Remove as type of definition
     *
     * @param Definition $asTypeOfDefinition
     */
    public function removeAsTypeOfDefinition(Definition $asTypeOfDefinition): void
    {
        $this->asTypeOfDefinition->detach($asTypeOfDefinition);
    }

    /**
     * Remove all as type of definitions
     */
    public function removeAllAsTypeOfDefinitions(): void
    {
        $asTypeOfDefinition = clone $this->asTypeOfDefinition;
        $this->asTypeOfDefinition->removeAll($asTypeOfDefinition);
    }
}

?>