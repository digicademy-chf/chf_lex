<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for definitions
 */
class Definition extends AbstractEntity
{
    /**
     * Whether the record should be visisible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = false;

    /**
     * Definition of the headword
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $text = '';

    /**
     * May be used to differentiate between different tiers of definitions
     * 
     * @var ObjectStorage<DefinitionTypeTag>
     */
    #[Lazy()]
    protected ObjectStorage $definitionType;

    /**
     * Construct object
     *
     * @param string $text
     * @return Definition
     */
    public function __construct(string $text)
    {
        $this->initializeObject();

        $this->setText($text);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->definitionType = new ObjectStorage();
    }

    /**
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Set hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Get definition type
     *
     * @return ObjectStorage<DefinitionTypeTag>
     */
    public function getDefinitionType(): ObjectStorage
    {
        return $this->definitionType;
    }

    /**
     * Set definition type
     *
     * @param ObjectStorage<DefinitionTypeTag> $definitionType
     */
    public function setDefinitionType(ObjectStorage $definitionType): void
    {
        $this->definitionType = $definitionType;
    }

    /**
     * Add definition type
     *
     * @param DefinitionTypeTag $definitionType
     */
    public function addDefinitionType(DefinitionTypeTag $definitionType): void
    {
        $this->definitionType->attach($definitionType);
    }

    /**
     * Remove definition type
     *
     * @param DefinitionTypeTag $definitionType
     */
    public function removeDefinitionType(DefinitionTypeTag $definitionType): void
    {
        $this->definitionType->detach($definitionType);
    }

    /**
     * Remove all definition types
     */
    public function removeAllDefinitionTypes(): void
    {
        $definitionType = clone $this->definitionType;
        $this->definitionType->removeAll($definitionType);
    }
}
