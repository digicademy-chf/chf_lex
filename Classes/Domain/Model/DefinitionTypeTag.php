<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractTag;

defined('TYPO3') or die();

/**
 * Model for DefinitionTypeTag
 */
class DefinitionTypeTag extends AbstractTag
{
    /**
     * List of definitions that use this definition type
     * 
     * @var ?ObjectStorage<Definition>
     */
    #[Lazy()]
    protected ?ObjectStorage $asDefinitionTypeOfDefinition;

    /**
     * Construct object
     *
     * @param LexicographicResource $parentResource
     * @param string $uuid
     * @param string $code
     * @param string $text
     * @return DefinitionTypeTag
     */
    public function __construct(LexicographicResource $parentResource, string $uuid, string $code, string $text)
    {
        parent::__construct($parentResource, $uuid, $code, $text);
        $this->initializeObject();

        $this->setType('definitionTypeTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->asDefinitionTypeOfDefinition ??= new ObjectStorage();
    }

    /**
     * Get as definition type of definition
     *
     * @return ObjectStorage<Definition>
     */
    public function getAsDefinitionTypeOfDefinition(): ?ObjectStorage
    {
        return $this->asDefinitionTypeOfDefinition;
    }

    /**
     * Set as definition type of definition
     *
     * @param ObjectStorage<Definition> $asDefinitionTypeOfDefinition
     */
    public function setAsDefinitionTypeOfDefinition(ObjectStorage $asDefinitionTypeOfDefinition): void
    {
        $this->asDefinitionTypeOfDefinition = $asDefinitionTypeOfDefinition;
    }

    /**
     * Add as definition type of definition
     *
     * @param Definition $asDefinitionTypeOfDefinition
     */
    public function addAsDefinitionTypeOfDefinition(Definition $asDefinitionTypeOfDefinition): void
    {
        $this->asDefinitionTypeOfDefinition?->attach($asDefinitionTypeOfDefinition);
    }

    /**
     * Remove as definition type of definition
     *
     * @param Definition $asDefinitionTypeOfDefinition
     */
    public function removeAsDefinitionTypeOfDefinition(Definition $asDefinitionTypeOfDefinition): void
    {
        $this->asDefinitionTypeOfDefinition?->detach($asDefinitionTypeOfDefinition);
    }

    /**
     * Remove all as definition type of definitions
     */
    public function removeAllAsDefinitionTypeOfDefinition(): void
    {
        $asDefinitionTypeOfDefinition = clone $this->asDefinitionTypeOfDefinition;
        $this->asDefinitionTypeOfDefinition->removeAll($asDefinitionTypeOfDefinition);
    }
}
