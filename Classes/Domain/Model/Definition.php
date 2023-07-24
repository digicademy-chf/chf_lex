<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for definitions
 */
class Definition extends AbstractEntity
{
    /**
     * Definition of the headword
     * 
     * @var string
     */
    protected string $text = '';

    #[Lazy()]
    /**
     * May be used to differentiate between different tiers of definitions
     * 
     * @var ObjectStorage<Tag>
     */
    protected $definitionType;

    /**
     * Initialize object
     *
     * @return Definition
     */
    public function __construct()
    {
        $this->definitionType = new ObjectStorage();
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
     * @return ObjectStorage|null
     */
    public function getDefinitionType(): ?ObjectStorage
    {
        return $this->definitionType;
    }

    /**
     * Set definition type
     *
     * @param ObjectStorage $definitionType
     */
    public function setDefinitionType($definitionType): void
    {
        $this->definitionType = $definitionType;
    }

    /**
     * Add definition type
     *
     * @param Tag $definitionType
     */
    public function addDefinitionType(Tag $definitionType): void
    {
        $this->definitionType->attach($definitionType);
    }

    /**
     * Remove definition type
     *
     * @param Tag $definitionType
     */
    public function removeDefinitionType(Tag $definitionType): void
    {
        $this->definitionType->detach($definitionType);
    }
}

?>