<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use DateTime;
use Digicademy\CHFBib\Domain\Reference;
use Digicademy\CHFLex\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Abstract model for entries
 */
class AbstractEntry extends AbstractEntity
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
     * Resource that this entry is attached to
     * 
     * @var LazyLoadingProxy|LexicographicResource
     */
    #[Lazy()]
    protected LazyLoadingProxy|LexicographicResource $parent_id;

    /**
     * Simple identifier of this entry as part of a single dataset
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
     * Unique identifier of the entry
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
     * Type of entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'entry',
                'encyclopediaEntry',
                'glossaryEntry',
            ],
        ],
    ])]
    protected string $type = '';

    /**
     * Label to group the entry into
     * 
     * @var ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

    /**
     * External web address to identify the entry across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * List of authors of this entry
     * 
     * @var ObjectStorage<Contributor>
     */
    #[Lazy()]
    protected ObjectStorage $author;

    /**
     * List of editors of this entry
     * 
     * @var ObjectStorage<Contributor>
     */
    #[Lazy()]
    protected ObjectStorage $editor;

    /**
     * Counter to increase when the entry is changed significantly
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $revisionNumber = null;

    /**
     * Date when the last significant edit was made
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $revisionDate = null;

    /**
     * Date when the entry was published on the web
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $publicationDate = null;

    /**
     * Indicator of the entry's publication status
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String', # Generic validator because this may contain comma-separated values
    ])]
    protected string $publicationSteps = '';

    /**
     * Indicator of the steps taken in writing the entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String', # Generic validator because this may contain comma-separated values
    ])]
    protected string $editingSteps = '';

    /**
     * Comments that support the editorial process
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 2000,
        ],
    ])]
    protected string $editingNotes = '';

    /**
     * Images depicting the entry
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $image;

    /**
     * Files that contains, for example, content of the entry
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $file;

    /**
     * List of references for this entry
     * 
     * @var ObjectStorage<Reference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $source;

    /**
     * Content of the file used to populate this record
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 100000,
        ],
    ])]
    protected string $import = '';

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
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $type
     * @return AbstractEntry
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $type)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setType($type);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label    = new ObjectStorage();
        $this->sameAs   = new ObjectStorage();
        $this->author   = new ObjectStorage();
        $this->editor   = new ObjectStorage();
        $this->image    = new ObjectStorage();
        $this->file     = new ObjectStorage();
        $this->source   = new ObjectStorage();
        $this->asMember = new ObjectStorage();
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
     * Get author
     *
     * @return ObjectStorage<Contributor>
     */
    public function getAuthor(): ObjectStorage
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param ObjectStorage<Contributor> $author
     */
    public function setAuthor(ObjectStorage $author): void
    {
        $this->author = $author;
    }

    /**
     * Add author
     *
     * @param Contributor $author
     */
    public function addAuthor(Contributor $author): void
    {
        $this->author->attach($author);
    }

    /**
     * Remove author
     *
     * @param Contributor $author
     */
    public function removeAuthor(Contributor $author): void
    {
        $this->author->detach($author);
    }

    /**
     * Remove all authors
     */
    public function removeAllAuthors(): void
    {
        $author = clone $this->author;
        $this->author->removeAll($author);
    }

    /**
     * Get editor
     *
     * @return ObjectStorage<Contributor>
     */
    public function getEditor(): ObjectStorage
    {
        return $this->editor;
    }

    /**
     * Set editor
     *
     * @param ObjectStorage<Contributor> $editor
     */
    public function setEditor(ObjectStorage $editor): void
    {
        $this->editor = $editor;
    }

    /**
     * Add editor
     *
     * @param Contributor $editor
     */
    public function addEditor(Contributor $editor): void
    {
        $this->editor->attach($editor);
    }

    /**
     * Remove editor
     *
     * @param Contributor $editor
     */
    public function removeEditor(Contributor $editor): void
    {
        $this->editor->detach($editor);
    }

    /**
     * Remove all editors
     */
    public function removeAllEditors(): void
    {
        $editor = clone $this->editor;
        $this->editor->removeAll($editor);
    }

    /**
     * Get revision number
     *
     * @return int
     */
    public function getRevisionNumber(): int
    {
        return $this->revisionNumber;
    }

    /**
     * Set revision number
     *
     * @param int $revisionNumber
     */
    public function setRevisionNumber(int $revisionNumber): void
    {
        $this->revisionNumber = $revisionNumber;
    }

    /**
     * Get revision date
     *
     * @return DateTime
     */
    public function getRevisionDate(): DateTime
    {
        return $this->revisionDate;
    }

    /**
     * Set revision date
     *
     * @param DateTime $revisionDate
     */
    public function setRevisionDate(DateTime $revisionDate): void
    {
        $this->revisionDate = $revisionDate;
    }

    /**
     * Get publication date
     *
     * @return DateTime
     */
    public function getPublicationDate(): DateTime
    {
        return $this->publicationDate;
    }

    /**
     * Set publication date
     *
     * @param DateTime $publicationDate
     */
    public function setPublicationDate(DateTime $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * Get publication steps
     *
     * @return string
     */
    public function getPublicationSteps(): string
    {
        return $this->publicationSteps;
    }

    /**
     * Set publication steps
     *
     * @param string $publicationSteps
     */
    public function setPublicationSteps(string $publicationSteps): void
    {
        $this->publicationSteps = $publicationSteps;
    }

    /**
     * Get editing steps
     *
     * @return string
     */
    public function getEditingSteps(): string
    {
        return $this->editingSteps;
    }

    /**
     * Set editing steps
     *
     * @param string $editingSteps
     */
    public function setEditingSteps(string $editingSteps): void
    {
        $this->editingSteps = $editingSteps;
    }

    /**
     * Get editing notes
     *
     * @return string
     */
    public function getEditingNotes(): string
    {
        return $this->editingNotes;
    }

    /**
     * Set editing notes
     *
     * @param string $editingNotes
     */
    public function setEditingNotes(string $editingNotes): void
    {
        $this->editingNotes = $editingNotes;
    }

    /**
     * Get image
     *
     * @return ObjectStorage<FileReference>
     */
    public function getImage(): ObjectStorage
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param ObjectStorage<FileReference> $image
     */
    public function setImage(ObjectStorage $image): void
    {
        $this->image = $image;
    }

    /**
     * Add image
     *
     * @param FileReference $image
     */
    public function addImage(FileReference $image): void
    {
        $this->image->attach($image);
    }

    /**
     * Remove image
     *
     * @param FileReference $image
     */
    public function removeImage(FileReference $image): void
    {
        $this->image->detach($image);
    }

    /**
     * Remove all images
     */
    public function removeAllImages(): void
    {
        $image = clone $this->image;
        $this->image->removeAll($image);
    }

    /**
     * Get file
     *
     * @return ObjectStorage<FileReference>
     */
    public function getFile(): ObjectStorage
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param ObjectStorage<FileReference> $file
     */
    public function setFile(ObjectStorage $file): void
    {
        $this->file = $file;
    }

    /**
     * Add file
     *
     * @param FileReference $file
     */
    public function addFile(FileReference $file): void
    {
        $this->file->attach($file);
    }

    /**
     * Remove file
     *
     * @param FileReference $file
     */
    public function removeFile(FileReference $file): void
    {
        $this->file->detach($file);
    }

    /**
     * Remove all files
     */
    public function removeAllFiles(): void
    {
        $file = clone $this->file;
        $this->file->removeAll($file);
    }

    /**
     * Get source
     *
     * @return ObjectStorage<Reference>
     */
    public function getSource(): ObjectStorage
    {
        return $this->source;
    }

    /**
     * Set source
     *
     * @param ObjectStorage<Reference> $source
     */
    public function setSource(ObjectStorage $source): void
    {
        $this->source = $source;
    }

    /**
     * Add source
     *
     * @param Reference $source
     */
    public function addSource(Reference $source): void
    {
        $this->source->attach($source);
    }

    /**
     * Remove source
     *
     * @param Reference $source
     */
    public function removeSource(Reference $source): void
    {
        $this->source->detach($source);
    }

    /**
     * Remove all sources
     */
    public function removeAllSources(): void
    {
        $source = clone $this->source;
        $this->source->removeAll($source);
    }

    /**
     * Get import
     *
     * @return string
     */
    public function getImport(): string
    {
        return $this->import;
    }

    /**
     * Set import
     *
     * @param string $import
     */
    public function setImport(string $import): void
    {
        $this->import = $import;
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