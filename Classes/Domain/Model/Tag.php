<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use Digicademy\DALex\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for tags
 */
class Tag extends AbstractEntity
{
    /**
     * Resource that this tag is attached to
     * 
     * @var LazyLoadingProxy|LexicographicResource|Tag
     */
    #[Lazy()]
    protected LazyLoadingProxy|LexicographicResource|Tag $parent_id;

    /**
     * Simple identifier of this tag as part of a single dataset
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
     * Unique identifier of the tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'RegularExpression',
        'options'   => [
            'regularExpression' => '^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$',
            'errorMessage'      => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:validator.regularExpression.noUuid',
        ],
    ])]
    protected string $uuid = '';

    /**
     * Name of the tag
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
    protected string $text = '';

    /**
     * Type of tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'language',
                'country',
                'region',
                'label',
                'labelType',
                'classificationEntry',
                'classificationSense',
                'relationType',
                'memberRole',
                'sourceIdentity',
                'partOfSpeech',
                'transcriptionScheme',
                'inflectedForm',
                'definitionType',
                'frequencyType',
            ],
        ],
    ])]
    protected string $type = '';

    /**
     * Brief information about the tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 2000,
        ],
    ])]
    protected string $description = '';

    /**
     * List of tags on the child level of this tag
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $child;

    /**
     * External web address to identify the tag across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * List of parts of speech that this tag may be used for
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $forPartOfSpeech;

    /**
     * Indicator of how close members of this type of relation need to be
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'any',
                'sameResource',
                'sameEntry',
            ],
        ],
    ])]
    protected string $scope = '';

    /**
     * Defines which roles members of this relation may have
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $memberRole;

    /**
     * Defines which types of members may be part of this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'any',
                'entry',
                'sense',
                'encyclopediaEntry',
                'glossaryEntry',
            ],
        ],
    ])]
    protected string $memberType = '';

    /**
     * Option to group various kinds of labels together
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $labelType;

    /**
     * Minimum number of members in this relation (leave empty to not set a limit)
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $min = null;

    /**
     * Maximum number of members in this relation (leave empty to not set a limit)
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $max = null;

    /**
     * Instructs machine agents what to do when they show this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'embed',
                'navigate',
                'none',
            ],
        ],
    ])]
    protected string $action = '';

    /**
     * List of tags with this part of speech as a constraint
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $asForPartOfSpeechOfTag;

    /**
     * List of tags with this member role
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $asMemberRoleOfTag;

    /**
     * List of entries with this label
     * 
     * @var ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfEntry;

    /**
     * List of contributors with this label
     * 
     * @var ObjectStorage<Contributor>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfContributor;

    /**
     * List of senses with this label
     * 
     * @var ObjectStorage<Sense>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfSense;

    /**
     * List of examples with this label
     * 
     * @var ObjectStorage<Example>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfExample;

    /**
     * List of inflected forms with this label
     * 
     * @var ObjectStorage<InflectedForm>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfInflectedForm;

    /**
     * List of pronunciations with this label
     * 
     * @var ObjectStorage<Pronunciation>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfPronunciation;

    /**
     * List of frequencies with this country or region
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    protected ObjectStorage $asCountryOrRegionOfFrequency;

    /**
     * List of entries annotated with this language
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asDistributionLanguageOfEntry;

    /**
     * List of entries with this main distribution
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asDistributionCountryOfEntry;

    /**
     * List of entries with this regional distribution
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asDistributionRegionOfEntry;

    /**
     * List of labels of this type
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelTypeOfTag;

    /**
     * List of definitions of this type
     * 
     * @var ObjectStorage<Definition>
     */
    #[Lazy()]
    protected ObjectStorage $asTypeOfDefinition;

    /**
     * List of inflected forms of this type
     * 
     * @var ObjectStorage<InflectedForm>
     */
    #[Lazy()]
    protected ObjectStorage $asTypeOfInflectedForm;

    /**
     * List of frequencies of this type
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    protected ObjectStorage $asTypeOfFrequency;

    /**
     * List of relations of this type
     * 
     * @var ObjectStorage<Relation>
     */
    #[Lazy()]
    protected ObjectStorage $asTypeOfRelation;

    /**
     * List of transcriptions with this scheme
     * 
     * @var ObjectStorage<Transcription>
     */
    #[Lazy()]
    protected ObjectStorage $asSchemeOfTranscription;

    /**
     * List of frequencies with this source identity
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    protected ObjectStorage $asSourceIdentityOfFrequency;

    /**
     * List of examples with this source identity
     * 
     * @var ObjectStorage<Example>
     */
    #[Lazy()]
    protected ObjectStorage $asSourceIdentityOfExample;

    /**
     * List of entries annotated with this part of speech
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asPartOfSpeechOfEntry;

    /**
     * List of relation members with this role
     * 
     * @var ObjectStorage<Member>
     */
    #[Lazy()]
    protected ObjectStorage $asRoleOfMember;

    /**
     * List of entries with this classification
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asClassificationOfEntry;

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
     * @param string $type
     * @param string $action
     * @return Tag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text, string $type, string $action)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType($type);
        $this->setAction($action);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->child                         = new ObjectStorage();
        $this->sameAs                        = new ObjectStorage();
        $this->forPartOfSpeech               = new ObjectStorage();
        $this->memberRole                    = new ObjectStorage();
        $this->labelType                     = new ObjectStorage();
        $this->asForPartOfSpeechOfTag        = new ObjectStorage();
        $this->asMemberRoleOfTag             = new ObjectStorage();
        $this->asLabelOfEntry                = new ObjectStorage();
        $this->asLabelOfContributor          = new ObjectStorage();
        $this->asLabelOfSense                = new ObjectStorage();
        $this->asLabelOfExample              = new ObjectStorage();
        $this->asLabelOfInflectedForm        = new ObjectStorage();
        $this->asLabelOfPronunciation        = new ObjectStorage();
        $this->asCountryOrRegionOfFrequency  = new ObjectStorage();
        $this->asDistributionLanguageOfEntry = new ObjectStorage();
        $this->asDistributionCountryOfEntry  = new ObjectStorage();
        $this->asDistributionRegionOfEntry   = new ObjectStorage();
        $this->asLabelTypeOfTag              = new ObjectStorage();
        $this->asTypeOfDefinition            = new ObjectStorage();
        $this->asTypeOfInflectedForm         = new ObjectStorage();
        $this->asTypeOfFrequency             = new ObjectStorage();
        $this->asTypeOfRelation              = new ObjectStorage();
        $this->asSchemeOfTranscription       = new ObjectStorage();
        $this->asSourceIdentityOfFrequency   = new ObjectStorage();
        $this->asSourceIdentityOfExample     = new ObjectStorage();
        $this->asPartOfSpeechOfEntry         = new ObjectStorage();
        $this->asRoleOfMember                = new ObjectStorage();
        $this->asClassificationOfEntry       = new ObjectStorage();
        $this->asClassificationOfSense       = new ObjectStorage();
    }

    /**
     * Get parent ID
     * 
     * @return LexicographicResource|Tag
     */
    public function getParentId(): LexicographicResource|Tag
    {
        if ($this->parent_id instanceof LazyLoadingProxy) {
            $this->parent_id->_loadRealInstance();
        }
        return $this->parent_id;
    }

    /**
     * Set parent ID
     * 
     * @param LexicographicResource|Tag $parent_id
     */
    public function setParentId(LexicographicResource|Tag $parent_id): void
    {
        $this->parent_id = $parent_id;
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
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get child
     *
     * @return ObjectStorage<Tag>
     */
    public function getChild(): ObjectStorage
    {
        return $this->child;
    }

    /**
     * Set child
     *
     * @param ObjectStorage<Tag> $child
     */
    public function setChild(ObjectStorage $child): void
    {
        $this->child = $child;
    }

    /**
     * Add child
     *
     * @param Tag $child
     */
    public function addChild(Tag $child): void
    {
        $this->child->attach($child);
    }

    /**
     * Remove child
     *
     * @param Tag $child
     */
    public function removeChild(Tag $child): void
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
     * Get for part of speech
     *
     * @return ObjectStorage<Tag>
     */
    public function getForPartOfSpeech(): ObjectStorage
    {
        return $this->forPartOfSpeech;
    }

    /**
     * Set for part of speech
     *
     * @param ObjectStorage<Tag> $forPartOfSpeech
     */
    public function setForPartOfSpeech(ObjectStorage $forPartOfSpeech): void
    {
        $this->forPartOfSpeech = $forPartOfSpeech;
    }

    /**
     * Add for part of speech
     *
     * @param Tag $forPartOfSpeech
     */
    public function addForPartOfSpeech(Tag $forPartOfSpeech): void
    {
        $this->forPartOfSpeech->attach($forPartOfSpeech);
    }

    /**
     * Remove for part of speech
     *
     * @param Tag $forPartOfSpeech
     */
    public function removeForPartOfSpeech(Tag $forPartOfSpeech): void
    {
        $this->forPartOfSpeech->detach($forPartOfSpeech);
    }

    /**
     * Remove all for part of speeches
     */
    public function removeAllForPartOfSpeeches(): void
    {
        $forPartOfSpeech = clone $this->forPartOfSpeech;
        $this->forPartOfSpeech->removeAll($forPartOfSpeech);
    }

    /**
     * Get scope
     *
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * Set scope
     *
     * @param string $scope
     */
    public function setScope(string $scope): void
    {
        $this->scope = $scope;
    }

    /**
     * Get member role
     *
     * @return ObjectStorage<Tag>
     */
    public function getMemberRole(): ObjectStorage
    {
        return $this->memberRole;
    }

    /**
     * Set member role
     *
     * @param ObjectStorage<Tag> $memberRole
     */
    public function setMemberRole(ObjectStorage $memberRole): void
    {
        $this->memberRole = $memberRole;
    }

    /**
     * Add member role
     *
     * @param Tag $memberRole
     */
    public function addMemberRole(Tag $memberRole): void
    {
        $this->memberRole->attach($memberRole);
    }

    /**
     * Remove member role
     *
     * @param Tag $memberRole
     */
    public function removeMemberRole(Tag $memberRole): void
    {
        $this->memberRole->detach($memberRole);
    }

    /**
     * Remove all member roles
     */
    public function removeAllMemberRoles(): void
    {
        $memberRole = clone $this->memberRole;
        $this->memberRole->removeAll($memberRole);
    }

    /**
     * Get member type
     *
     * @return string
     */
    public function getMemberType(): string
    {
        return $this->memberType;
    }

    /**
     * Set member type
     *
     * @param string $memberType
     */
    public function setMemberType(string $memberType): void
    {
        $this->memberType = $memberType;
    }

    /**
     * Get label type
     *
     * @return ObjectStorage<Tag>
     */
    public function getLabelType(): ObjectStorage
    {
        return $this->labelType;
    }

    /**
     * Set label type
     *
     * @param ObjectStorage<Tag> $labelType
     */
    public function setLabelType(ObjectStorage $labelType): void
    {
        $this->labelType = $labelType;
    }

    /**
     * Add label type
     *
     * @param Tag $labelType
     */
    public function addLabelType(Tag $labelType): void
    {
        $this->labelType->attach($labelType);
    }

    /**
     * Remove label type
     *
     * @param Tag $labelType
     */
    public function removeLabelType(Tag $labelType): void
    {
        $this->labelType->detach($labelType);
    }

    /**
     * Remove all label types
     */
    public function removeAllLabelTypes(): void
    {
        $labelType = clone $this->labelType;
        $this->labelType->removeAll($labelType);
    }

    /**
     * Get min
     *
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * Set min
     *
     * @param int $min
     */
    public function setMin(int $min): void
    {
        $this->min = $min;
    }

    /**
     * Get max
     *
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * Set max
     *
     * @param int $max
     */
    public function setMax(int $max): void
    {
        $this->max = $max;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * Get as for part of speech of tag
     *
     * @return ObjectStorage<Tag>
     */
    public function getAsForPartOfSpeechOfTag(): ObjectStorage
    {
        return $this->asForPartOfSpeechOfTag;
    }

    /**
     * Set as for part of speech of tag
     *
     * @param ObjectStorage<Tag> $asForPartOfSpeechOfTag
     */
    public function setAsForPartOfSpeechOfTag(ObjectStorage $asForPartOfSpeechOfTag): void
    {
        $this->asForPartOfSpeechOfTag = $asForPartOfSpeechOfTag;
    }

    /**
     * Add as for part of speech of tag
     *
     * @param Tag $asForPartOfSpeechOfTag
     */
    public function addAsForPartOfSpeechOfTag(Tag $asForPartOfSpeechOfTag): void
    {
        $this->asForPartOfSpeechOfTag->attach($asForPartOfSpeechOfTag);
    }

    /**
     * Remove as for part of speech of tag
     *
     * @param Tag $asForPartOfSpeechOfTag
     */
    public function removeAsForPartOfSpeechOfTag(Tag $asForPartOfSpeechOfTag): void
    {
        $this->asForPartOfSpeechOfTag->detach($asForPartOfSpeechOfTag);
    }

    /**
     * Remove all as for part of speech of tags
     */
    public function removeAllAsForPartOfSpeechOfTags(): void
    {
        $asForPartOfSpeechOfTag = clone $this->asForPartOfSpeechOfTag;
        $this->asForPartOfSpeechOfTag->removeAll($asForPartOfSpeechOfTag);
    }

    /**
     * Get as member role of tag
     *
     * @return ObjectStorage<Tag>
     */
    public function getAsMemberRoleOfTag(): ObjectStorage
    {
        return $this->asMemberRoleOfTag;
    }

    /**
     * Set as member role of tag
     *
     * @param ObjectStorage<Tag> $asMemberRoleOfTag
     */
    public function setAsMemberRoleOfTag(ObjectStorage $asMemberRoleOfTag): void
    {
        $this->asMemberRoleOfTag = $asMemberRoleOfTag;
    }

    /**
     * Add as member role of tag
     *
     * @param Tag $asMemberRoleOfTag
     */
    public function addAsMemberRoleOfTag(Tag $asMemberRoleOfTag): void
    {
        $this->asMemberRoleOfTag->attach($asMemberRoleOfTag);
    }

    /**
     * Remove as member role of tag
     *
     * @param Tag $asMemberRoleOfTag
     */
    public function removeAsMemberRoleOfTag(Tag $asMemberRoleOfTag): void
    {
        $this->asMemberRoleOfTag->detach($asMemberRoleOfTag);
    }

    /**
     * Remove all as member role of tags
     */
    public function removeAllAsMemberRoleOfTags(): void
    {
        $asMemberRoleOfTag = clone $this->asMemberRoleOfTag;
        $this->asMemberRoleOfTag->removeAll($asMemberRoleOfTag);
    }

    /**
     * Get as label of entry
     *
     * @return ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry>
     */
    public function getAsLabelOfEntry(): ObjectStorage
    {
        return $this->asLabelOfEntry;
    }

    /**
     * Set as label of entry
     *
     * @param ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry> $asLabelOfEntry
     */
    public function setAsLabelOfEntry(ObjectStorage $asLabelOfEntry): void
    {
        $this->asLabelOfEntry = $asLabelOfEntry;
    }

    /**
     * Add as label of entry
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry $asLabelOfEntry
     */
    public function addAsLabelOfEntry(Entry|EncyclopediaEntry|GlossaryEntry $asLabelOfEntry): void
    {
        $this->asLabelOfEntry->attach($asLabelOfEntry);
    }

    /**
     * Remove as label of entry
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry $asLabelOfEntry
     */
    public function removeAsLabelOfEntry(Entry|EncyclopediaEntry|GlossaryEntry $asLabelOfEntry): void
    {
        $this->asLabelOfEntry->detach($asLabelOfEntry);
    }

    /**
     * Remove all as label of entries
     */
    public function removeAllAsLabelOfEntries(): void
    {
        $asLabelOfEntry = clone $this->asLabelOfEntry;
        $this->asLabelOfEntry->removeAll($asLabelOfEntry);
    }

    /**
     * Get as label of contributor
     *
     * @return ObjectStorage<Contributor>
     */
    public function getAsLabelOfContributor(): ObjectStorage
    {
        return $this->asLabelOfContributor;
    }

    /**
     * Set as label of contributor
     *
     * @param ObjectStorage<Contributor> $asLabelOfContributor
     */
    public function setAsLabelOfContributor(ObjectStorage $asLabelOfContributor): void
    {
        $this->asLabelOfContributor = $asLabelOfContributor;
    }

    /**
     * Add as label of contributor
     *
     * @param Contributor $asLabelOfContributor
     */
    public function addAsLabelOfContributor(Contributor $asLabelOfContributor): void
    {
        $this->asLabelOfContributor->attach($asLabelOfContributor);
    }

    /**
     * Remove as label of contributor
     *
     * @param Contributor $asLabelOfContributor
     */
    public function removeAsLabelOfContributor(Contributor $asLabelOfContributor): void
    {
        $this->asLabelOfContributor->detach($asLabelOfContributor);
    }

    /**
     * Remove all as label of contributors
     */
    public function removeAllAsLabelOfContributors(): void
    {
        $asLabelOfContributor = clone $this->asLabelOfContributor;
        $this->asLabelOfContributor->removeAll($asLabelOfContributor);
    }

    /**
     * Get as label of sense
     *
     * @return ObjectStorage<Sense>
     */
    public function getAsLabelOfSense(): ObjectStorage
    {
        return $this->asLabelOfSense;
    }

    /**
     * Set as label of sense
     *
     * @param ObjectStorage<Sense> $asLabelOfSense
     */
    public function setAsLabelOfSense(ObjectStorage $asLabelOfSense): void
    {
        $this->asLabelOfSense = $asLabelOfSense;
    }

    /**
     * Add as label of sense
     *
     * @param Sense $asLabelOfSense
     */
    public function addAsLabelOfSense(Sense $asLabelOfSense): void
    {
        $this->asLabelOfSense->attach($asLabelOfSense);
    }

    /**
     * Remove as label of sense
     *
     * @param Sense $asLabelOfSense
     */
    public function removeAsLabelOfSense(Sense $asLabelOfSense): void
    {
        $this->asLabelOfSense->detach($asLabelOfSense);
    }

    /**
     * Remove as label of senses
     */
    public function removeAllAsLabelOfSenses(): void
    {
        $asLabelOfSense = clone $this->asLabelOfSense;
        $this->asLabelOfSense->removeAll($asLabelOfSense);
    }

    /**
     * Get asLabelOfExample
     *
     * @return ObjectStorage<Example>
     */
    public function getAsLabelOfExample(): ObjectStorage
    {
        return $this->asLabelOfExample;
    }

    /**
     * Set asLabelOfExample
     *
     * @param ObjectStorage<Example> $asLabelOfExample
     */
    public function setAsLabelOfExample(ObjectStorage $asLabelOfExample): void
    {
        $this->asLabelOfExample = $asLabelOfExample;
    }

    /**
     * Add asLabelOfExample
     *
     * @param Example $asLabelOfExample
     */
    public function addAsLabelOfExample(Example $asLabelOfExample): void
    {
        $this->asLabelOfExample->attach($asLabelOfExample);
    }

    /**
     * Remove asLabelOfExample
     *
     * @param Example $asLabelOfExample
     */
    public function removeAsLabelOfExample(Example $asLabelOfExample): void
    {
        $this->asLabelOfExample->detach($asLabelOfExample);
    }

    /**
     * Remove all asLabelOfExamples
     */
    public function removeAllAsLabelOfExamples(): void
    {
        $asLabelOfExample = clone $this->asLabelOfExample;
        $this->asLabelOfExample->removeAll($asLabelOfExample);
    }

    /**
     * Get as label of inflected form
     *
     * @return ObjectStorage<InflectedForm>
     */
    public function getAsLabelOfInflectedForm(): ObjectStorage
    {
        return $this->asLabelOfInflectedForm;
    }

    /**
     * Set as label of inflected form
     *
     * @param ObjectStorage<InflectedForm> $asLabelOfInflectedForm
     */
    public function setAsLabelOfInflectedForm(ObjectStorage $asLabelOfInflectedForm): void
    {
        $this->asLabelOfInflectedForm = $asLabelOfInflectedForm;
    }

    /**
     * Add as label of inflected form
     *
     * @param InflectedForm $asLabelOfInflectedForm
     */
    public function addAsLabelOfInflectedForm(InflectedForm $asLabelOfInflectedForm): void
    {
        $this->asLabelOfInflectedForm->attach($asLabelOfInflectedForm);
    }

    /**
     * Remove as label of inflected form
     *
     * @param InflectedForm $asLabelOfInflectedForm
     */
    public function removeAsLabelOfInflectedForm(InflectedForm $asLabelOfInflectedForm): void
    {
        $this->asLabelOfInflectedForm->detach($asLabelOfInflectedForm);
    }

    /**
     * Remove all as label of inflected forms
     */
    public function removeAllAsLabelOfInflectedForms(): void
    {
        $asLabelOfInflectedForm = clone $this->asLabelOfInflectedForm;
        $this->asLabelOfInflectedForm->removeAll($asLabelOfInflectedForm);
    }

    /**
     * Get as label of pronunciation
     *
     * @return ObjectStorage<Pronunciation>
     */
    public function getAsLabelOfPronunciation(): ObjectStorage
    {
        return $this->asLabelOfPronunciation;
    }

    /**
     * Set as label of pronunciation
     *
     * @param ObjectStorage<Pronunciation> $asLabelOfPronunciation
     */
    public function setAsLabelOfPronunciation(ObjectStorage $asLabelOfPronunciation): void
    {
        $this->asLabelOfPronunciation = $asLabelOfPronunciation;
    }

    /**
     * Add as label of pronunciation
     *
     * @param Pronunciation $asLabelOfPronunciation
     */
    public function addAsLabelOfPronunciation(Pronunciation $asLabelOfPronunciation): void
    {
        $this->asLabelOfPronunciation->attach($asLabelOfPronunciation);
    }

    /**
     * Remove as label of pronunciation
     *
     * @param Pronunciation $asLabelOfPronunciation
     */
    public function removeAsLabelOfPronunciation(Pronunciation $asLabelOfPronunciation): void
    {
        $this->asLabelOfPronunciation->detach($asLabelOfPronunciation);
    }

    /**
     * Remove all as label of pronunciations
     */
    public function removeAllAsLabelOfPronunciations(): void
    {
        $asLabelOfPronunciation = clone $this->asLabelOfPronunciation;
        $this->asLabelOfPronunciation->removeAll($asLabelOfPronunciation);
    }

    /**
     * Get as country or region of frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getAsCountryOrRegionOfFrequency(): ObjectStorage
    {
        return $this->asCountryOrRegionOfFrequency;
    }

    /**
     * Set as country or region of frequency
     *
     * @param ObjectStorage<Frequency> $asCountryOrRegionOfFrequency
     */
    public function setAsCountryOrRegionOfFrequency(ObjectStorage $asCountryOrRegionOfFrequency): void
    {
        $this->asCountryOrRegionOfFrequency = $asCountryOrRegionOfFrequency;
    }

    /**
     * Add as country or region of frequency
     *
     * @param Frequency $asCountryOrRegionOfFrequency
     */
    public function addAsCountryOrRegionOfFrequency(Frequency $asCountryOrRegionOfFrequency): void
    {
        $this->asCountryOrRegionOfFrequency->attach($asCountryOrRegionOfFrequency);
    }

    /**
     * Remove as country or region of frequency
     *
     * @param Frequency $asCountryOrRegionOfFrequency
     */
    public function removeAsCountryOrRegionOfFrequency(Frequency $asCountryOrRegionOfFrequency): void
    {
        $this->asCountryOrRegionOfFrequency->detach($asCountryOrRegionOfFrequency);
    }

    /**
     * Remove all as country or region of frequencies
     */
    public function removeAllAsCountryOrRegionOfFrequencies(): void
    {
        $asCountryOrRegionOfFrequency = clone $this->asCountryOrRegionOfFrequency;
        $this->asCountryOrRegionOfFrequency->removeAll($asCountryOrRegionOfFrequency);
    }

    /**
     * Get as distribution language of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsDistributionLanguageOfEntry(): ObjectStorage
    {
        return $this->asDistributionLanguageOfEntry;
    }

    /**
     * Set as distribution language of entry
     *
     * @param ObjectStorage<Entry> $asDistributionLanguageOfEntry
     */
    public function setAsDistributionLanguageOfEntry(ObjectStorage $asDistributionLanguageOfEntry): void
    {
        $this->asDistributionLanguageOfEntry = $asDistributionLanguageOfEntry;
    }

    /**
     * Add as distribution language of entry
     *
     * @param Entry $asDistributionLanguageOfEntry
     */
    public function addAsDistributionLanguageOfEntry(Entry $asDistributionLanguageOfEntry): void
    {
        $this->asDistributionLanguageOfEntry->attach($asDistributionLanguageOfEntry);
    }

    /**
     * Remove as distribution language of entry
     *
     * @param Entry $asDistributionLanguageOfEntry
     */
    public function removeAsDistributionLanguageOfEntry(Entry $asDistributionLanguageOfEntry): void
    {
        $this->asDistributionLanguageOfEntry->detach($asDistributionLanguageOfEntry);
    }

    /**
     * Remove all as distribution language of entries
     */
    public function removeAllAsDistributionLanguageOfEntries(): void
    {
        $asDistributionLanguageOfEntry = clone $this->asDistributionLanguageOfEntry;
        $this->asDistributionLanguageOfEntry->removeAll($asDistributionLanguageOfEntry);
    }

    /**
     * Get as distribution country of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsDistributionCountryOfEntry(): ObjectStorage
    {
        return $this->asDistributionCountryOfEntry;
    }

    /**
     * Set as distribution country of entry
     *
     * @param ObjectStorage<Entry> $asDistributionCountryOfEntry
     */
    public function setAsDistributionCountryOfEntry(ObjectStorage $asDistributionCountryOfEntry): void
    {
        $this->asDistributionCountryOfEntry = $asDistributionCountryOfEntry;
    }

    /**
     * Add as distribution country of entry
     *
     * @param Entry $asDistributionCountryOfEntry
     */
    public function addAsDistributionCountryOfEntry(Entry $asDistributionCountryOfEntry): void
    {
        $this->asDistributionCountryOfEntry->attach($asDistributionCountryOfEntry);
    }

    /**
     * Remove as distribution country of entry
     *
     * @param Entry $asDistributionCountryOfEntry
     */
    public function removeAsDistributionCountryOfEntry(Entry $asDistributionCountryOfEntry): void
    {
        $this->asDistributionCountryOfEntry->detach($asDistributionCountryOfEntry);
    }

    /**
     * Remove all as distribution country of entries
     */
    public function removeAllAsDistributionCountryOfEntries(): void
    {
        $asDistributionCountryOfEntry = clone $this->asDistributionCountryOfEntry;
        $this->asDistributionCountryOfEntry->removeAll($asDistributionCountryOfEntry);
    }

    /**
     * Get as distribution region of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsDistributionRegionOfEntry(): ObjectStorage
    {
        return $this->asDistributionRegionOfEntry;
    }

    /**
     * Set as distribution region of entry
     *
     * @param ObjectStorage<Entry> $asDistributionRegionOfEntry
     */
    public function setAsDistributionRegionOfEntry(ObjectStorage $asDistributionRegionOfEntry): void
    {
        $this->asDistributionRegionOfEntry = $asDistributionRegionOfEntry;
    }

    /**
     * Add as distribution region of entry
     *
     * @param Entry $asDistributionRegionOfEntry
     */
    public function addAsDistributionRegionOfEntry(Entry $asDistributionRegionOfEntry): void
    {
        $this->asDistributionRegionOfEntry->attach($asDistributionRegionOfEntry);
    }

    /**
     * Remove as distribution region of entry
     *
     * @param Entry $asDistributionRegionOfEntry
     */
    public function removeAsDistributionRegionOfEntry(Entry $asDistributionRegionOfEntry): void
    {
        $this->asDistributionRegionOfEntry->detach($asDistributionRegionOfEntry);
    }

    /**
     * Remove all as distribution region of entries
     */
    public function removeAllAsDistributionRegionOfEntries(): void
    {
        $asDistributionRegionOfEntry = clone $this->asDistributionRegionOfEntry;
        $this->asDistributionRegionOfEntry->removeAll($asDistributionRegionOfEntry);
    }

    /**
     * Get as label type of tag
     *
     * @return ObjectStorage<Tag>
     */
    public function getAsLabelTypeOfTag(): ObjectStorage
    {
        return $this->asLabelTypeOfTag;
    }

    /**
     * Set as label type of tag
     *
     * @param ObjectStorage<Tag> $asLabelTypeOfTag
     */
    public function setAsLabelTypeOfTag(ObjectStorage $asLabelTypeOfTag): void
    {
        $this->asLabelTypeOfTag = $asLabelTypeOfTag;
    }

    /**
     * Add as label type of tag
     *
     * @param Tag $asLabelTypeOfTag
     */
    public function addAsLabelTypeOfTag(Tag $asLabelTypeOfTag): void
    {
        $this->asLabelTypeOfTag->attach($asLabelTypeOfTag);
    }

    /**
     * Remove as label type of tag
     *
     * @param Tag $asLabelTypeOfTag
     */
    public function removeAsLabelTypeOfTag(Tag $asLabelTypeOfTag): void
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

    /**
     * Get as type of inflected form
     *
     * @return ObjectStorage<InflectedForm>
     */
    public function getAsTypeOfInflectedForm(): ObjectStorage
    {
        return $this->asTypeOfInflectedForm;
    }

    /**
     * Set as type of inflected form
     *
     * @param ObjectStorage<InflectedForm> $asTypeOfInflectedForm
     */
    public function setAsTypeOfInflectedForm(ObjectStorage $asTypeOfInflectedForm): void
    {
        $this->asTypeOfInflectedForm = $asTypeOfInflectedForm;
    }

    /**
     * Add as type of inflected form
     *
     * @param InflectedForm $asTypeOfInflectedForm
     */
    public function addAsTypeOfInflectedForm(InflectedForm $asTypeOfInflectedForm): void
    {
        $this->asTypeOfInflectedForm->attach($asTypeOfInflectedForm);
    }

    /**
     * Remove as type of inflected form
     *
     * @param InflectedForm $asTypeOfInflectedForm
     */
    public function removeAsTypeOfInflectedForm(InflectedForm $asTypeOfInflectedForm): void
    {
        $this->asTypeOfInflectedForm->detach($asTypeOfInflectedForm);
    }

    /**
     * Remove all as type of inflected forms
     */
    public function removeAllAsTypeOfInflectedForms(): void
    {
        $asTypeOfInflectedForm = clone $this->asTypeOfInflectedForm;
        $this->asTypeOfInflectedForm->removeAll($asTypeOfInflectedForm);
    }

    /**
     * Get as type of frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getAsTypeOfFrequency(): ObjectStorage
    {
        return $this->asTypeOfFrequency;
    }

    /**
     * Set as type of frequency
     *
     * @param ObjectStorage<Frequency> $asTypeOfFrequency
     */
    public function setAsTypeOfFrequency(ObjectStorage $asTypeOfFrequency): void
    {
        $this->asTypeOfFrequency = $asTypeOfFrequency;
    }

    /**
     * Add as type of frequency
     *
     * @param Frequency $asTypeOfFrequency
     */
    public function addAsTypeOfFrequency(Frequency $asTypeOfFrequency): void
    {
        $this->asTypeOfFrequency->attach($asTypeOfFrequency);
    }

    /**
     * Remove as type of frequency
     *
     * @param Frequency $asTypeOfFrequency
     */
    public function removeAsTypeOfFrequency(Frequency $asTypeOfFrequency): void
    {
        $this->asTypeOfFrequency->detach($asTypeOfFrequency);
    }

    /**
     * Remove all as type of frequencies
     */
    public function removeAllAsTypeOfFrequencies(): void
    {
        $asTypeOfFrequency = clone $this->asTypeOfFrequency;
        $this->asTypeOfFrequency->removeAll($asTypeOfFrequency);
    }

    /**
     * Get as type of relation
     *
     * @return ObjectStorage<Relation>
     */
    public function getAsTypeOfRelation(): ObjectStorage
    {
        return $this->asTypeOfRelation;
    }

    /**
     * Set as type of relation
     *
     * @param ObjectStorage<Relation> $asTypeOfRelation
     */
    public function setAsTypeOfRelation(ObjectStorage $asTypeOfRelation): void
    {
        $this->asTypeOfRelation = $asTypeOfRelation;
    }

    /**
     * Add as type of relation
     *
     * @param Relation $asTypeOfRelation
     */
    public function addAsTypeOfRelation(Relation $asTypeOfRelation): void
    {
        $this->asTypeOfRelation->attach($asTypeOfRelation);
    }

    /**
     * Remove as type of relation
     *
     * @param Relation $asTypeOfRelation
     */
    public function removeAsTypeOfRelation(Relation $asTypeOfRelation): void
    {
        $this->asTypeOfRelation->detach($asTypeOfRelation);
    }

    /**
     * Remove all as type of relations
     */
    public function removeAllAsTypeOfRelations(): void
    {
        $asTypeOfRelation = clone $this->asTypeOfRelation;
        $this->asTypeOfRelation->removeAll($asTypeOfRelation);
    }

    /**
     * Get as scheme of transcription
     *
     * @return ObjectStorage<Transcription>
     */
    public function getAsSchemeOfTranscription(): ObjectStorage
    {
        return $this->asSchemeOfTranscription;
    }

    /**
     * Set as scheme of transcription
     *
     * @param ObjectStorage<Transcription> $asSchemeOfTranscription
     */
    public function setAsSchemeOfTranscription(ObjectStorage $asSchemeOfTranscription): void
    {
        $this->asSchemeOfTranscription = $asSchemeOfTranscription;
    }

    /**
     * Add as scheme of transcription
     *
     * @param Transcription $asSchemeOfTranscription
     */
    public function addAsSchemeOfTranscription(Transcription $asSchemeOfTranscription): void
    {
        $this->asSchemeOfTranscription->attach($asSchemeOfTranscription);
    }

    /**
     * Remove as scheme of transcription
     *
     * @param Transcription $asSchemeOfTranscription
     */
    public function removeAsSchemeOfTranscription(Transcription $asSchemeOfTranscription): void
    {
        $this->asSchemeOfTranscription->detach($asSchemeOfTranscription);
    }

    /**
     * Remove all as scheme of transcriptions
     */
    public function removeAllAsSchemeOfTranscriptions(): void
    {
        $asSchemeOfTranscription = clone $this->asSchemeOfTranscription;
        $this->asSchemeOfTranscription->removeAll($asSchemeOfTranscription);
    }

    /**
     * Get as source identity of frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getAsSourceIdentityOfFrequency(): ObjectStorage
    {
        return $this->asSourceIdentityOfFrequency;
    }

    /**
     * Set as source identity of frequency
     *
     * @param ObjectStorage<Frequency> $asSourceIdentityOfFrequency
     */
    public function setAsSourceIdentityOfFrequency(ObjectStorage $asSourceIdentityOfFrequency): void
    {
        $this->asSourceIdentityOfFrequency = $asSourceIdentityOfFrequency;
    }

    /**
     * Add as source identity of frequency
     *
     * @param Frequency $asSourceIdentityOfFrequency
     */
    public function addAsSourceIdentityOfFrequency(Frequency $asSourceIdentityOfFrequency): void
    {
        $this->asSourceIdentityOfFrequency->attach($asSourceIdentityOfFrequency);
    }

    /**
     * Remove as source identity of frequency
     *
     * @param Frequency $asSourceIdentityOfFrequency
     */
    public function removeAsSourceIdentityOfFrequency(Frequency $asSourceIdentityOfFrequency): void
    {
        $this->asSourceIdentityOfFrequency->detach($asSourceIdentityOfFrequency);
    }

    /**
     * Remove all as source identity of frequencies
     */
    public function removeAllAsSourceIdentityOfFrequencies(): void
    {
        $asSourceIdentityOfFrequency = clone $this->asSourceIdentityOfFrequency;
        $this->asSourceIdentityOfFrequency->removeAll($asSourceIdentityOfFrequency);
    }

    /**
     * Get as source identity of example
     *
     * @return ObjectStorage<Example>
     */
    public function getAsSourceIdentityOfExample(): ObjectStorage
    {
        return $this->asSourceIdentityOfExample;
    }

    /**
     * Set as source identity of example
     *
     * @param ObjectStorage<Example> $asSourceIdentityOfExample
     */
    public function setAsSourceIdentityOfExample(ObjectStorage $asSourceIdentityOfExample): void
    {
        $this->asSourceIdentityOfExample = $asSourceIdentityOfExample;
    }

    /**
     * Add as source identity of example
     *
     * @param Example $asSourceIdentityOfExample
     */
    public function addAsSourceIdentityOfExample(Example $asSourceIdentityOfExample): void
    {
        $this->asSourceIdentityOfExample->attach($asSourceIdentityOfExample);
    }

    /**
     * Remove as source identity of example
     *
     * @param Example $asSourceIdentityOfExample
     */
    public function removeAsSourceIdentityOfExample(Example $asSourceIdentityOfExample): void
    {
        $this->asSourceIdentityOfExample->detach($asSourceIdentityOfExample);
    }

    /**
     * Remove all as source identity of examples
     */
    public function removeAllAsSourceIdentityOfExamples(): void
    {
        $asSourceIdentityOfExample = clone $this->asSourceIdentityOfExample;
        $this->asSourceIdentityOfExample->removeAll($asSourceIdentityOfExample);
    }

    /**
     * Get as part of speech of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsPartOfSpeechOfEntry(): ObjectStorage
    {
        return $this->asPartOfSpeechOfEntry;
    }

    /**
     * Set as part of speech of entry
     *
     * @param ObjectStorage<Entry> $asPartOfSpeechOfEntry
     */
    public function setAsPartOfSpeechOfEntry(ObjectStorage $asPartOfSpeechOfEntry): void
    {
        $this->asPartOfSpeechOfEntry = $asPartOfSpeechOfEntry;
    }

    /**
     * Add as part of speech of entry
     *
     * @param Entry $asPartOfSpeechOfEntry
     */
    public function addAsPartOfSpeechOfEntry(Entry $asPartOfSpeechOfEntry): void
    {
        $this->asPartOfSpeechOfEntry->attach($asPartOfSpeechOfEntry);
    }

    /**
     * Remove as part of speech of entry
     *
     * @param Entry $asPartOfSpeechOfEntry
     */
    public function removeAsPartOfSpeechOfEntry(Entry $asPartOfSpeechOfEntry): void
    {
        $this->asPartOfSpeechOfEntry->detach($asPartOfSpeechOfEntry);
    }

    /**
     * Remove all as part of speech of entries
     */
    public function removeAllAsPartOfSpeechOfEntries(): void
    {
        $asPartOfSpeechOfEntry = clone $this->asPartOfSpeechOfEntry;
        $this->asPartOfSpeechOfEntry->removeAll($asPartOfSpeechOfEntry);
    }

    /**
     * Get as role of member
     *
     * @return ObjectStorage<Member>
     */
    public function getAsRoleOfMember(): ObjectStorage
    {
        return $this->asRoleOfMember;
    }

    /**
     * Set as role of member
     *
     * @param ObjectStorage<Member> $asRoleOfMember
     */
    public function setAsRoleOfMember(ObjectStorage $asRoleOfMember): void
    {
        $this->asRoleOfMember = $asRoleOfMember;
    }

    /**
     * Add as role of member
     *
     * @param Member $asRoleOfMember
     */
    public function addAsRoleOfMember(Member $asRoleOfMember): void
    {
        $this->asRoleOfMember->attach($asRoleOfMember);
    }

    /**
     * Remove as role of member
     *
     * @param Member $asRoleOfMember
     */
    public function removeAsRoleOfMember(Member $asRoleOfMember): void
    {
        $this->asRoleOfMember->detach($asRoleOfMember);
    }

    /**
     * Remove all as role of members
     */
    public function removeAllAsRoleOfMembers(): void
    {
        $asRoleOfMember = clone $this->asRoleOfMember;
        $this->asRoleOfMember->removeAll($asRoleOfMember);
    }

    /**
     * Get as classification of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsClassificationOfEntry(): ObjectStorage
    {
        return $this->asClassificationOfEntry;
    }

    /**
     * Set as classification of entry
     *
     * @param ObjectStorage<Entry> $asClassificationOfEntry
     */
    public function setAsClassificationOfEntry(ObjectStorage $asClassificationOfEntry): void
    {
        $this->asClassificationOfEntry = $asClassificationOfEntry;
    }

    /**
     * Add as classification of entry
     *
     * @param Entry $asClassificationOfEntry
     */
    public function addAsClassificationOfEntry(Entry $asClassificationOfEntry): void
    {
        $this->asClassificationOfEntry->attach($asClassificationOfEntry);
    }

    /**
     * Remove as classification of entry
     *
     * @param Entry $asClassificationOfEntry
     */
    public function removeAsClassificationOfEntry(Entry $asClassificationOfEntry): void
    {
        $this->asClassificationOfEntry->detach($asClassificationOfEntry);
    }

    /**
     * Remove all as classification of entries
     */
    public function removeAllAsClassificationOfEntries(): void
    {
        $asClassificationOfEntry = clone $this->asClassificationOfEntry;
        $this->asClassificationOfEntry->removeAll($asClassificationOfEntry);
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