<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for contributors
 */
class Contributor extends AbstractEntity
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
     * Resource that this contributor is attached to
     * 
     * @var LazyLoadingProxy|LexicographicResource
     */
    #[Lazy()]
    protected LazyLoadingProxy|LexicographicResource $parent_id;

    /**
     * Simple identifier of this contributor as part of a single dataset
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
     * Unique identifier of the contributor
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
     * Whether the contributor should be listed above non-active ones
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $active = true;

    /**
     * Surname of the contributor
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $surname = '';

    /**
     * Forename of the contributor
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $forename = '';

    /**
     * Name of a corporate body (e.g., an organisation) used instead of forename and surname
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $corporateName = '';

    /**
     * Label to group the contributor into
     * 
     * @var ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

    /**
     * External web address to identify the contributor across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * List of contributions as an author
     * 
     * @var ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry>
     */
    #[Lazy()]
    protected ObjectStorage $asAuthor;

    /**
     * List of contributions as an editor
     * 
     * @var ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry>
     */
    #[Lazy()]
    protected ObjectStorage $asEditor;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @return Contributor
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label    = new ObjectStorage();
        $this->sameAs   = new ObjectStorage();
        $this->asAuthor = new ObjectStorage();
        $this->asEditor = new ObjectStorage();
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
     * Get parent ID
     * 
     * @return LexicographicResource
     */
    public function getParentId(): LexicographicResource
    {
        if ($this->parent_id instanceof LazyLoadingProxy) {
            $this->parent_id->_loadRealInstance();
        }
        return $this->parent_id;
    }

    /**
     * Set parent ID
     * 
     * @param LexicographicResource $parent_id
     */
    public function setParentId(LexicographicResource $parent_id): void
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
     * Get active
     *
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * Get forename
     *
     * @return string
     */
    public function getForename(): string
    {
        return $this->forename;
    }

    /**
     * Set forename
     *
     * @param string $forename
     */
    public function setForename(string $forename): void
    {
        $this->forename = $forename;
    }

    /**
     * Get corporate name
     *
     * @return string
     */
    public function getCorporateName(): string
    {
        return $this->corporateName;
    }

    /**
     * Set corporate name
     *
     * @param string $corporateName
     */
    public function setCorporateName(string $corporateName): void
    {
        $this->corporateName = $corporateName;
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
     * Get as author
     *
     * @return ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry>
     */
    public function getAsAuthor(): ObjectStorage
    {
        return $this->asAuthor;
    }

    /**
     * Set as author
     *
     * @param ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry> $asAuthor
     */
    public function setAsAuthor(ObjectStorage $asAuthor): void
    {
        $this->asAuthor = $asAuthor;
    }

    /**
     * Add as author
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry $asAuthor
     */
    public function addAsAuthor(Entry|EncyclopediaEntry|GlossaryEntry $asAuthor): void
    {
        $this->asAuthor->attach($asAuthor);
    }

    /**
     * Remove as author
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry $asAuthor
     */
    public function removeAsAuthor(Entry|EncyclopediaEntry|GlossaryEntry $asAuthor): void
    {
        $this->asAuthor->detach($asAuthor);
    }

    /**
     * Remove all as authors
     */
    public function removeAllAsAuthors(): void
    {
        $asAuthor = clone $this->asAuthor;
        $this->asAuthor->removeAll($asAuthor);
    }

    /**
     * Get as editor
     *
     * @return ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry>
     */
    public function getAsEditor(): ObjectStorage
    {
        return $this->asEditor;
    }

    /**
     * Set as editor
     *
     * @param ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry> $asEditor
     */
    public function setAsEditor(ObjectStorage $asEditor): void
    {
        $this->asEditor = $asEditor;
    }

    /**
     * Add as editor
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry $asEditor
     */
    public function addAsEditor(Entry|EncyclopediaEntry|GlossaryEntry $asEditor): void
    {
        $this->asEditor->attach($asEditor);
    }

    /**
     * Remove as editor
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry $asEditor
     */
    public function removeAsEditor(Entry|EncyclopediaEntry|GlossaryEntry $asEditor): void
    {
        $this->asEditor->detach($asEditor);
    }

    /**
     * Remove all as editors
     */
    public function removeAllAsEditors(): void
    {
        $asEditor = clone $this->asEditor;
        $this->asEditor->removeAll($asEditor);
    }
}

?>