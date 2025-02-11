<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\IriTrait;
use Digicademy\CHFBase\Domain\Model\Traits\UuidTrait;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\LabelTag;
use Digicademy\CHFBase\Domain\Model\SameAs;

defined('TYPO3') or die();

/**
 * Model for Sense
 */
class Sense extends AbstractEntity
{
    use IriTrait;
    use UuidTrait;

    /**
     * Record visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = true;

    /**
     * Specific description of the sense
     * 
     * @var ?ObjectStorage<Definition>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $definition = null;

    /**
     * Brief note differentiating this sense from the others
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $indicator = '';

    /**
     * Label to group the database record into
     * 
     * @var ?ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $label = null;

    /**
     * List of contemporary or historical examples of this sense
     * 
     * @var ?ObjectStorage<Example>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $example = null;

    /**
     * List of domestic and foreign frequency data
     * 
     * @var ?ObjectStorage<Frequency>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $frequency = null;

    /**
     * Dictionary entry that this sense belongs to
     * 
     * @var DictionaryEntry|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected DictionaryEntry|LazyLoadingProxy|null $parentEntry = null;

    /**
     * Authoritative web address to identify an entity across the web
     * 
     * @var ?ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $sameAs = null;

    /**
     * List of memberships in a lexicographic relation
     * 
     * @var ?ObjectStorage<Member>
     */
    #[Lazy()]
    protected ?ObjectStorage $asRefOfMember = null;

    /**
     * Construct object
     *
     * @param DictionaryEntry $parentEntry
     * @return Sense
     */
    public function __construct(DictionaryEntry $parentEntry)
    {
        $this->initializeObject();

        $this->setParentEntry($parentEntry);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->definition ??= new ObjectStorage();
        $this->label ??= new ObjectStorage();
        $this->example ??= new ObjectStorage();
        $this->frequency ??= new ObjectStorage();
        $this->sameAs ??= new ObjectStorage();
        $this->asRefOfMember ??= new ObjectStorage();
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
     * Get definition
     *
     * @return ObjectStorage<Definition>
     */
    public function getDefinition(): ?ObjectStorage
    {
        return $this->definition;
    }

    /**
     * Set definition
     *
     * @param ObjectStorage<Definition> $definition
     */
    public function setDefinition(ObjectStorage $definition): void
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
        $this->definition?->attach($definition);
    }

    /**
     * Remove definition
     *
     * @param Definition $definition
     */
    public function removeDefinition(Definition $definition): void
    {
        $this->definition?->detach($definition);
    }

    /**
     * Remove all definitions
     */
    public function removeAllDefinition(): void
    {
        $definition = clone $this->definition;
        $this->definition->removeAll($definition);
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

    /**
     * Get example
     *
     * @return ObjectStorage<Example>
     */
    public function getExample(): ?ObjectStorage
    {
        return $this->example;
    }

    /**
     * Set example
     *
     * @param ObjectStorage<Example> $example
     */
    public function setExample(ObjectStorage $example): void
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
        $this->example?->attach($example);
    }

    /**
     * Remove example
     *
     * @param Example $example
     */
    public function removeExample(Example $example): void
    {
        $this->example?->detach($example);
    }

    /**
     * Remove all examples
     */
    public function removeAllExample(): void
    {
        $example = clone $this->example;
        $this->example->removeAll($example);
    }

    /**
     * Get frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getFrequency(): ?ObjectStorage
    {
        return $this->frequency;
    }

    /**
     * Set frequency
     *
     * @param ObjectStorage<Frequency> $frequency
     */
    public function setFrequency(ObjectStorage $frequency): void
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
        $this->frequency?->attach($frequency);
    }

    /**
     * Remove frequency
     *
     * @param Frequency $frequency
     */
    public function removeFrequency(Frequency $frequency): void
    {
        $this->frequency?->detach($frequency);
    }

    /**
     * Remove all frequencies
     */
    public function removeAllFrequency(): void
    {
        $frequency = clone $this->frequency;
        $this->frequency->removeAll($frequency);
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
     * Get same as
     *
     * @return ObjectStorage<SameAs>
     */
    public function getSameAs(): ?ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set same as
     *
     * @param ObjectStorage<SameAs> $sameAs
     */
    public function setSameAs(ObjectStorage $sameAs): void
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
        $this->sameAs?->attach($sameAs);
    }

    /**
     * Remove same as
     *
     * @param SameAs $sameAs
     */
    public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs?->detach($sameAs);
    }

    /**
     * Remove all same as
     */
    public function removeAllSameAs(): void
    {
        $sameAs = clone $this->sameAs;
        $this->sameAs->removeAll($sameAs);
    }

    /**
     * Get as ref of member
     *
     * @return ObjectStorage<Member>
     */
    public function getAsRefOfMember(): ?ObjectStorage
    {
        return $this->asRefOfMember;
    }

    /**
     * Set as ref of member
     *
     * @param ObjectStorage<Member> $asRefOfMember
     */
    public function setAsRefOfMember(ObjectStorage $asRefOfMember): void
    {
        $this->asRefOfMember = $asRefOfMember;
    }

    /**
     * Add as ref of member
     *
     * @param Member $asRefOfMember
     */
    public function addAsRefOfMember(Member $asRefOfMember): void
    {
        $this->asRefOfMember?->attach($asRefOfMember);
    }

    /**
     * Remove as ref of member
     *
     * @param Member $asRefOfMember
     */
    public function removeAsRefOfMember(Member $asRefOfMember): void
    {
        $this->asRefOfMember?->detach($asRefOfMember);
    }

    /**
     * Remove all as ref of members
     */
    public function removeAllAsRefOfMember(): void
    {
        $asRefOfMember = clone $this->asRefOfMember;
        $this->asRefOfMember->removeAll($asRefOfMember);
    }
}
