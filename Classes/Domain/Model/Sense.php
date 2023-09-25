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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for senses
 */
class Sense extends AbstractEntity
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
     * Simple identifier of this sense as part of a single dataset
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'minimum' => 1,
            'maximum' => 255,
        ],
    ])]
    protected string $id = '';

    /**
     * Unique identifier of the sense
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'RegularExpression',
        'options'   => [
            'regularExpression' => '^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$',
            'errorMessage'      => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:validator.regularExpression.noUuid',
        ],
    ])]
    protected string $uuid = '';

    /**
     * Specific description of the sense
     * 
     * @var ObjectStorage<Definition>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $definition;

    /**
     * Brief indicator differentiating this sense from the others
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
     * Assess the sense using a given set of categories
     * 
     * @var ObjectStorage<ClassificationSenseTag>
     */
    #[Lazy()]
    protected ObjectStorage $classification;

    /**
     * Contemporary or historical examples of this sense
     * 
     * @var ObjectStorage<Example>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $example;

    /**
     * Frequency data for different countries or regions
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $frequency;

    /**
     * Label to group the sense into
     * 
     * @var ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

    /**
     * External web address to identify the sense across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * List of memberships in a relation
     * 
     * @var ObjectStorage<Member>
     */
    #[Lazy()]
    protected ObjectStorage $asMember;

    /**
     * Construct object
     *
     * @param string $id
     * @param string $uuid
     * @return Sense
     */
    public function __construct(string $id, string $uuid)
    {
        $this->initializeObject();

        $this->setId($id);
        $this->setUuid($uuid);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->definition     = new ObjectStorage();
        $this->classification = new ObjectStorage();
        $this->example        = new ObjectStorage();
        $this->frequency      = new ObjectStorage();
        $this->label          = new ObjectStorage();
        $this->sameAs         = new ObjectStorage();
        $this->asMember       = new ObjectStorage();
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
     * @return ObjectStorage<Definition>
     */
    public function getDefinition(): ObjectStorage
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
     * Remove all definitions
     */
    public function removeAllDefinitions(): void
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
     * Get classification
     *
     * @return ObjectStorage<ClassificationSenseTag>
     */
    public function getClassification(): ObjectStorage
    {
        return $this->classification;
    }

    /**
     * Set classification
     *
     * @param ObjectStorage<ClassificationSenseTag> $classification
     */
    public function setClassification(ObjectStorage $classification): void
    {
        $this->classification = $classification;
    }

    /**
     * Add classification
     *
     * @param ClassificationSenseTag $classification
     */
    public function addClassification(ClassificationSenseTag $classification): void
    {
        $this->classification->attach($classification);
    }

    /**
     * Remove classification
     *
     * @param ClassificationSenseTag $classification
     */
    public function removeClassification(ClassificationSenseTag $classification): void
    {
        $this->classification->detach($classification);
    }

    /**
     * Remove all classifications
     */
    public function removeAllClassifications(): void
    {
        $classification = clone $this->classification;
        $this->classification->removeAll($classification);
    }

    /**
     * Get example
     *
     * @return ObjectStorage<Example>
     */
    public function getExample(): ObjectStorage
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
     * Remove all examples
     */
    public function removeAllExamples(): void
    {
        $example = clone $this->example;
        $this->example->removeAll($example);
    }

    /**
     * Get frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getFrequency(): ObjectStorage
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
     * Remove all frequencies
     */
    public function removeAllFrequencies(): void
    {
        $frequency = clone $this->frequency;
        $this->frequency->removeAll($frequency);
    }

    /**
     * Get label
     *
     * @return ObjectStorage<LabelTag>
     */
    public function getLabel(): ObjectStorage
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
        $this->label->attach($label);
    }

    /**
     * Remove label
     *
     * @param LabelTag $label
     */
    public function removeLabel(LabelTag $label): void
    {
        $this->label->detach($label);
    }

    /**
     * Remove all labels
     */
    public function removeAllLabels(): void
    {
        $label = clone $this->label;
        $this->label->removeAll($label);
    }

    /**
     * Get same as
     *
     * @return ObjectStorage<SameAs>
     */
    public function getSameAs(): ObjectStorage
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

    /**
     * Remove all same as
     */
    public function removeAllSameAs(): void
    {
        $sameAs = clone $this->sameAs;
        $this->sameAs->removeAll($sameAs);
    }

    /**
     * Get as member
     *
     * @return ObjectStorage<Member>
     */
    public function getAsMember(): ObjectStorage
    {
        return $this->asMember;
    }

    /**
     * Set as member
     *
     * @param ObjectStorage<Member> $asMember
     */
    public function setAsMember(ObjectStorage $asMember): void
    {
        $this->asMember = $asMember;
    }

    /**
     * Add as member
     *
     * @param Member $asMember
     */
    public function addAsMember(Member $asMember): void
    {
        $this->asMember->attach($asMember);
    }

    /**
     * Remove as member
     *
     * @param Member $asMember
     */
    public function removeAsMember(Member $asMember): void
    {
        $this->asMember->detach($asMember);
    }

    /**
     * Remove all as members
     */
    public function removeAllAsMembers(): void
    {
        $asMember = clone $this->asMember;
        $this->asMember->removeAll($asMember);
    }
}

?>