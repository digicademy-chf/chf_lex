<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AgentRelation;
use Digicademy\CHFBase\Domain\Model\LocationRelation;
use Digicademy\CHFBase\Domain\Model\LabelTag;
use Digicademy\CHFBase\Domain\Model\Period;
use Digicademy\CHFBib\Domain\Model\SourceRelation;

defined('TYPO3') or die();

/**
 * Model for Example
 */
class Example extends AbstractEntity
{
    /**
     * Whether the record should be visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = true;

    /**
     * Dictionary entry that this example is part of
     * 
     * @var DictionaryEntry|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected DictionaryEntry|LazyLoadingProxy|null $parentEntry = null;

    /**
     * Sense that this example is part of
     * 
     * @var Sense|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Sense|LazyLoadingProxy|null $parentSense = null;

    /**
     * String that exemplifies the headword or the sense
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $text = '';

    /**
     * Date when this example was in use
     * 
     * @var Period|LazyLoadingProxy|null
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected Period|LazyLoadingProxy|null $date = null;

    /**
     * Agent of this database record described by a relation
     * 
     * @var ?ObjectStorage<AgentRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $agentRelation = null;

    /**
     * Location of this database record described by a relation
     * 
     * @var ?ObjectStorage<LocationRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $locationRelation = null;

    /**
     * File that reads out the example
     * 
     * @var FileReference|LazyLoadingProxy|null
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected FileReference|LazyLoadingProxy|null $soundFile = null;

    /**
     * Source of this database record described by a relation
     * 
     * @var ?ObjectStorage<SourceRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $sourceRelation = null;

    /**
     * Label to group the database record into
     * 
     * @var ?ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $label = null;

    /**
     * Construct object
     *
     * @param string $text
     * @return Example
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
        $this->agentRelation ??= new ObjectStorage();
        $this->locationRelation ??= new ObjectStorage();
        $this->sourceRelation ??= new ObjectStorage();
        $this->label ??= new ObjectStorage();
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
     * Get parent entry
     * 
     * @return DictionaryEntry
     */
    public function getParentEntry(): DictionaryEntry
    {
        if ($this->parentEntry instanceof LazyLoadingProxy) {
            $this->parentEntry->_loadRealInstance();
        }
        return $this->parentEntry;
    }

    /**
     * Set parent entry
     * 
     * @param DictionaryEntry
     */
    public function setParentEntry(DictionaryEntry $parentEntry): void
    {
        $this->parentEntry = $parentEntry;
    }

    /**
     * Get parent sense
     * 
     * @return Sense
     */
    public function getParentSense(): Sense
    {
        if ($this->parentSense instanceof LazyLoadingProxy) {
            $this->parentSense->_loadRealInstance();
        }
        return $this->parentSense;
    }

    /**
     * Set parent sense
     * 
     * @param Sense
     */
    public function setParentSense(Sense $parentSense): void
    {
        $this->parentSense = $parentSense;
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
     * Get date
     * 
     * @return Period
     */
    public function getDate(): Period
    {
        if ($this->date instanceof LazyLoadingProxy) {
            $this->date->_loadRealInstance();
        }
        return $this->date;
    }

    /**
     * Set date
     * 
     * @param Period
     */
    public function setDate(Period $date): void
    {
        $this->date = $date;
    }

    /**
     * Get agent relation
     *
     * @return ObjectStorage<AgentRelation>
     */
    public function getAgentRelation(): ?ObjectStorage
    {
        return $this->agentRelation;
    }

    /**
     * Set agent relation
     *
     * @param ObjectStorage<AgentRelation> $agentRelation
     */
    public function setAgentRelation(ObjectStorage $agentRelation): void
    {
        $this->agentRelation = $agentRelation;
    }

    /**
     * Add agent relation
     *
     * @param AgentRelation $agentRelation
     */
    public function addAgentRelation(AgentRelation $agentRelation): void
    {
        $this->agentRelation?->attach($agentRelation);
    }

    /**
     * Remove agent relation
     *
     * @param AgentRelation $agentRelation
     */
    public function removeAgentRelation(AgentRelation $agentRelation): void
    {
        $this->agentRelation?->detach($agentRelation);
    }

    /**
     * Remove all agent relations
     */
    public function removeAllAgentRelation(): void
    {
        $agentRelation = clone $this->agentRelation;
        $this->agentRelation->removeAll($agentRelation);
    }

    /**
     * Get location relation
     *
     * @return ObjectStorage<LocationRelation>
     */
    public function getLocationRelation(): ?ObjectStorage
    {
        return $this->locationRelation;
    }

    /**
     * Set location relation
     *
     * @param ObjectStorage<LocationRelation> $locationRelation
     */
    public function setLocationRelation(ObjectStorage $locationRelation): void
    {
        $this->locationRelation = $locationRelation;
    }

    /**
     * Add location relation
     *
     * @param LocationRelation $locationRelation
     */
    public function addLocationRelation(LocationRelation $locationRelation): void
    {
        $this->locationRelation?->attach($locationRelation);
    }

    /**
     * Remove location relation
     *
     * @param LocationRelation $locationRelation
     */
    public function removeLocationRelation(LocationRelation $locationRelation): void
    {
        $this->locationRelation?->detach($locationRelation);
    }

    /**
     * Remove all location relations
     */
    public function removeAllLocationRelation(): void
    {
        $locationRelation = clone $this->locationRelation;
        $this->locationRelation->removeAll($locationRelation);
    }

    /**
     * Get sound file
     * 
     * @return FileReference
     */
    public function getSoundFile(): FileReference
    {
        if ($this->soundFile instanceof LazyLoadingProxy) {
            $this->soundFile->_loadRealInstance();
        }
        return $this->soundFile;
    }

    /**
     * Set sound file
     * 
     * @param FileReference
     */
    public function setSoundFile(FileReference $soundFile): void
    {
        $this->soundFile = $soundFile;
    }

    /**
     * Get source relation
     *
     * @return ObjectStorage<SourceRelation>
     */
    public function getSourceRelation(): ?ObjectStorage
    {
        return $this->sourceRelation;
    }

    /**
     * Set source relation
     *
     * @param ObjectStorage<SourceRelation> $sourceRelation
     */
    public function setSourceRelation(ObjectStorage $sourceRelation): void
    {
        $this->sourceRelation = $sourceRelation;
    }

    /**
     * Add source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function addSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->attach($sourceRelation);
    }

    /**
     * Remove source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function removeSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->detach($sourceRelation);
    }

    /**
     * Remove all source relations
     */
    public function removeAllSourceRelation(): void
    {
        $sourceRelation = clone $this->sourceRelation;
        $this->sourceRelation->removeAll($sourceRelation);
    }

    /**
     * Get label
     *
     * @return ObjectStorage<LabelTag>
     */
    public function getLabel(): ?ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage<LabelTag> $label
     */
    public function setLabel(ObjectStorage $label): void
    {
        $this->label = $label;
    }

    /**
     * Add label
     *
     * @param LabelTag $label
     */
    public function addLabel(LabelTag $label): void
    {
        $this->label?->attach($label);
    }

    /**
     * Remove label
     *
     * @param LabelTag $label
     */
    public function removeLabel(LabelTag $label): void
    {
        $this->label?->detach($label);
    }

    /**
     * Remove all labels
     */
    public function removeAllLabel(): void
    {
        $label = clone $this->label;
        $this->label->removeAll($label);
    }
}
