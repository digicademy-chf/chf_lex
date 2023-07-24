<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for senses
 */
class Sense extends AbstractEntity
{
    /**
     * Unique string, number, or combination of these to identify this sense
     * 
     * @var string
     */
    protected string $id = '';

    /**
     * Unique sense identifier
     * 
     * @var string
     */
    protected string $uuid = '';

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Specific description of the sense
     * 
     * @var ObjectStorage<Definition>
     */
    protected $definition;

    /**
     * Brief indicator differentiating this sense from the others
     * 
     * @var string
     */
    protected string $indicator = '';

    /**
     * Category tree to differentiate this sense from the others
     * 
     * @var string
     */
    protected string $structuredIndicator = '';

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Contemporary or historical examples of this sense
     * 
     * @var ObjectStorage<Example>
     */
    protected $example;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Frequency data for different countries or regions
     * 
     * @var ObjectStorage<Frequency>
     */
    protected $frequency;

    #[Lazy()]
    /**
     * Label to group the sense into
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * External web address to identify the sense across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    protected $sameAs;

    /**
     * Initialize object
     *
     * @return Sense
     */
    public function __construct()
    {
        $this->definition = new ObjectStorage();
        $this->example    = new ObjectStorage();
        $this->frequency  = new ObjectStorage();
        $this->label      = new ObjectStorage();
        $this->sameAs     = new ObjectStorage();
    }

    /**
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
     *
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * Get UUID
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set UUID
     *
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * Get definition
     *
     * @return ObjectStorage|null
     */
    public function getDefinition(): ?ObjectStorage
    {
        return $this->definition;
    }

    /**
     * Set definition
     *
     * @param ObjectStorage $definition
     */
    public function setDefinition($definition): void
    {
        $this->definition = $definition;
    }

    /**
     * Add definition
     *
     * @param Definition $definition
     */
    public function addDefinition(Definition $definition): void
    {
        $this->definition->attach($definition);
    }

    /**
     * Remove definition
     *
     * @param Definition $definition
     */
    public function removeDefinition(Definition $definition): void
    {
        $this->definition->detach($definition);
    }

    /**
     * Get indicator
     *
     * @return string
     */
    public function getIndicator(): string
    {
        return $this->indicator;
    }

    /**
     * Set indicator
     *
     * @param string $indicator
     */
    public function setIndicator(string $indicator): void
    {
        $this->indicator = $indicator;
    }

    /**
     * Get structured indicator
     *
     * @return string
     */
    public function getStructuredIndicator(): string
    {
        return $this->structuredIndicator;
    }

    /**
     * Set structured indicator
     *
     * @param string $structuredIndicator
     */
    public function setStructuredIndicator(string $structuredIndicator): void
    {
        $this->structuredIndicator = $structuredIndicator;
    }

    /**
     * Get example
     *
     * @return ObjectStorage|null
     */
    public function getExample(): ?ObjectStorage
    {
        return $this->example;
    }

    /**
     * Set example
     *
     * @param ObjectStorage $example
     */
    public function setExample($example): void
    {
        $this->example = $example;
    }

    /**
     * Add example
     *
     * @param Example $example
     */
    public function addExample(Example $example): void
    {
        $this->example->attach($example);
    }

    /**
     * Remove example
     *
     * @param Example $example
     */
    public function removeExample(Example $example): void
    {
        $this->example->detach($example);
    }

    /**
     * Get frequency
     *
     * @return ObjectStorage|null
     */
    public function getFrequency(): ?ObjectStorage
    {
        return $this->frequency;
    }

    /**
     * Set frequency
     *
     * @param ObjectStorage $frequency
     */
    public function setFrequency($frequency): void
    {
        $this->frequency = $frequency;
    }

    /**
     * Add frequency
     *
     * @param Frequency $frequency
     */
    public function addFrequency(Frequency $frequency): void
    {
        $this->frequency->attach($frequency);
    }

    /**
     * Remove frequency
     *
     * @param Frequency $frequency
     */
    public function removeFrequency(Frequency $frequency): void
    {
        $this->frequency->detach($frequency);
    }

    /**
     * Get label
     *
     * @return ObjectStorage|null
     */
    public function getLabel(): ?ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage $label
     */
    public function setLabel($label): void
    {
        $this->label = $label;
    }

    /**
     * Add label
     *
     * @param Tag $label
     */
    public function addLabel(Tag $label): void
    {
        $this->label->attach($label);
    }

    /**
     * Remove label
     *
     * @param Tag $label
     */
    public function removeLabel(Tag $label): void
    {
        $this->label->detach($label);
    }

    /**
     * Get same as
     *
     * @return ObjectStorage|null
     */
    public function getSameAs(): ?ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set same as
     *
     * @param ObjectStorage $sameAs
     */
    public function setSameAs($sameAs): void
    {
        $this->sameAs = $sameAs;
    }

    /**
     * Add same as
     *
     * @param SameAs $sameAs
     */
    public function addSameAs(SameAs $sameAs): void
    {
        $this->sameAs->attach($sameAs);
    }

    /**
     * Remove same as
     *
     * @param SameAs $sameAs
     */
    public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs->detach($sameAs);
    }
}

?>