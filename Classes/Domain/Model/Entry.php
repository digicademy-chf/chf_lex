<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use DateTime;
use Digicademy\DABib\Domain\Reference;
use Digicademy\DALex\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for entries
 */
class Entry extends AbstractEntity
{
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
     * Single lemma identifying the word discussed in the entry
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
    protected string $headword = '';

    /**
     * Optional number to distinguish lemmas that are spelled the same
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $homographNumber = null;

    /**
     * Name of the entry
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
    protected string $title = '';

    /**
     * List of comma-separated strings to link to this glossary entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $annotateStrings = '';

    /**
     * Label to group the entry into
     * 
     * @var ObjectStorage<Tag>
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
     * Query that identifies a set of entries edited in a single run
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $databaseQuery = '';

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
     * Assess the entry using a given set of categories
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $classification;

    /**
     * Define the headword's part of speech
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $partOfSpeech;

    /**
     * Define the headword's inflected forms
     * 
     * @var ObjectStorage<InflectedForm>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $inflectedForm;

    /**
     * Define the pronunciation of the headword
     * 
     * @var ObjectStorage<Pronunciation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $pronunciation;

    /**
     * List of senses for this entry
     * 
     * @var ObjectStorage<Sense>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sense;

    /**
     * Contemporary or historical examples of this entry
     * 
     * @var ObjectStorage<Example>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $example;

    /**
     * Content blocks that make up the content of this entry
     * 
     * @var ObjectStorage<Content>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $contentElements;

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
     * Languages associated with this entry
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $distributionLanguage;

    /**
     * Countries connected to this entry
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $distributionCountry;

    /**
     * Regions connected to this entry
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $distributionRegion;

    /**
     * List of domestic and foreign frequency data
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $frequency;

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
     * @param string $headword
     * @param string $title
     * @return Entry
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $type, string $headword, string $title)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setType($type);
        $this->setHeadword($headword);
        $this->setTitle($title);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label                = new ObjectStorage();
        $this->sameAs               = new ObjectStorage();
        $this->author               = new ObjectStorage();
        $this->editor               = new ObjectStorage();
        $this->classification       = new ObjectStorage();
        $this->partOfSpeech         = new ObjectStorage();
        $this->inflectedForm        = new ObjectStorage();
        $this->pronunciation        = new ObjectStorage();
        $this->sense                = new ObjectStorage();
        $this->example              = new ObjectStorage();
        $this->contentElements      = new ObjectStorage();
        $this->image                = new ObjectStorage();
        $this->file                 = new ObjectStorage();
        $this->distributionLanguage = new ObjectStorage();
        $this->distributionCountry  = new ObjectStorage();
        $this->distributionRegion   = new ObjectStorage();
        $this->frequency            = new ObjectStorage();
        $this->source               = new ObjectStorage();
        $this->asMember             = new ObjectStorage();
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
     * Get headword
     *
     * @return string
     */
    public function getHeadword(): string
    {
        return $this->headword;
    }

    /**
     * Set headword
     *
     * @param string $headword
     */
    public function setHeadword(string $headword): void
    {
        $this->headword = $headword;
    }

    /**
     * Get homograph number
     *
     * @return int
     */
    public function getHomographNumber(): int
    {
        return $this->homographNumber;
    }

    /**
     * Set homograph number
     *
     * @param int $homographNumber
     */
    public function setHomographNumber(int $homographNumber): void
    {
        $this->homographNumber = $homographNumber;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get annotate strings
     *
     * @return string
     */
    public function getAnnotateStrings(): string
    {
        return $this->annotateStrings;
    }

    /**
     * Set annotate strings
     *
     * @param string $annotateStrings
     */
    public function setAnnotateStrings(string $annotateStrings): void
    {
        $this->annotateStrings = $annotateStrings;
    }

    /**
     * Get label
     *
     * @return ObjectStorage<Tag>
     */
    public function getLabel(): ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage<Tag> $label
     */
    public function setLabel(ObjectStorage $label): void
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
     * Get database query
     *
     * @return string
     */
    public function getDatabaseQuery(): string
    {
        return $this->databaseQuery;
    }

    /**
     * Set database query
     *
     * @param string $databaseQuery
     */
    public function setDatabaseQuery(string $databaseQuery): void
    {
        $this->databaseQuery = $databaseQuery;
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
     * Get classification
     *
     * @return ObjectStorage<Tag>
     */
    public function getClassification(): ObjectStorage
    {
        return $this->classification;
    }

    /**
     * Set classification
     *
     * @param ObjectStorage<Tag> $classification
     */
    public function setClassification(ObjectStorage $classification): void
    {
        $this->classification = $classification;
    }

    /**
     * Add classification
     *
     * @param Tag $classification
     */
    public function addClassification(Tag $classification): void
    {
        $this->classification->attach($classification);
    }

    /**
     * Remove classification
     *
     * @param Tag $classification
     */
    public function removeClassification(Tag $classification): void
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
     * Get part of speech
     *
     * @return ObjectStorage<Tag>
     */
    public function getPartOfSpeech(): ObjectStorage
    {
        return $this->partOfSpeech;
    }

    /**
     * Set part of speech
     *
     * @param ObjectStorage<Tag> $partOfSpeech
     */
    public function setPartOfSpeech(ObjectStorage $partOfSpeech): void
    {
        $this->partOfSpeech = $partOfSpeech;
    }

    /**
     * Add part of speech
     *
     * @param Tag $partOfSpeech
     */
    public function addPartOfSpeech(Tag $partOfSpeech): void
    {
        $this->partOfSpeech->attach($partOfSpeech);
    }

    /**
     * Remove part of speech
     *
     * @param Tag $partOfSpeech
     */
    public function removePartOfSpeech(Tag $partOfSpeech): void
    {
        $this->partOfSpeech->detach($partOfSpeech);
    }

    /**
     * Remove all parts of speech
     */
    public function removeAllPartsOfSpeech(): void
    {
        $partOfSpeech = clone $this->partOfSpeech;
        $this->partOfSpeech->removeAll($partOfSpeech);
    }

    /**
     * Get inflected form
     *
     * @return ObjectStorage<InflectedForm>
     */
    public function getInflectedForm(): ObjectStorage
    {
        return $this->inflectedForm;
    }

    /**
     * Set inflected form
     *
     * @param ObjectStorage<InflectedForm> $inflectedForm
     */
    public function setInflectedForm(ObjectStorage $inflectedForm): void
    {
        $this->inflectedForm = $inflectedForm;
    }

    /**
     * Add inflected form
     *
     * @param InflectedForm $inflectedForm
     */
    public function addInflectedForm(InflectedForm $inflectedForm): void
    {
        $this->inflectedForm->attach($inflectedForm);
    }

    /**
     * Remove inflected form
     *
     * @param InflectedForm $inflectedForm
     */
    public function removeInflectedForm(InflectedForm $inflectedForm): void
    {
        $this->inflectedForm->detach($inflectedForm);
    }

    /**
     * Remove all inflected forms
     */
    public function removeAllInflectedForms(): void
    {
        $inflectedForm = clone $this->inflectedForm;
        $this->inflectedForm->removeAll($inflectedForm);
    }

    /**
     * Get pronunciation
     *
     * @return ObjectStorage<Pronunciation>
     */
    public function getPronunciation(): ObjectStorage
    {
        return $this->pronunciation;
    }

    /**
     * Set pronunciation
     *
     * @param ObjectStorage<Pronunciation> $pronunciation
     */
    public function setPronunciation(ObjectStorage $pronunciation): void
    {
        $this->pronunciation = $pronunciation;
    }

    /**
     * Add pronunciation
     *
     * @param Pronunciation $pronunciation
     */
    public function addPronunciation(Pronunciation $pronunciation): void
    {
        $this->pronunciation->attach($pronunciation);
    }

    /**
     * Remove pronunciation
     *
     * @param Pronunciation $pronunciation
     */
    public function removePronunciation(Pronunciation $pronunciation): void
    {
        $this->pronunciation->detach($pronunciation);
    }

    /**
     * Remove all pronunciations
     */
    public function removeAllPronunciations(): void
    {
        $pronunciation = clone $this->pronunciation;
        $this->pronunciation->removeAll($pronunciation);
    }

    /**
     * Get sense
     *
     * @return ObjectStorage<Sense>
     */
    public function getSense(): ObjectStorage
    {
        return $this->sense;
    }

    /**
     * Set sense
     *
     * @param ObjectStorage<Sense> $sense
     */
    public function setSense(ObjectStorage $sense): void
    {
        $this->sense = $sense;
    }

    /**
     * Add sense
     *
     * @param Sense $sense
     */
    public function addSense(Sense $sense): void
    {
        $this->sense->attach($sense);
    }

    /**
     * Remove sense
     *
     * @param Sense $sense
     */
    public function removeSense(Sense $sense): void
    {
        $this->sense->detach($sense);
    }

    /**
     * Remove all senses
     */
    public function removeAllSenses(): void
    {
        $sense = clone $this->sense;
        $this->sense->removeAll($sense);
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
     * Get content elements
     *
     * @return ObjectStorage<Content>
     */
    public function getContentElements(): ObjectStorage
    {
        return $this->contentElements;
    }

    /**
     * Set content elements
     *
     * @param ObjectStorage<Content> $contentElements
     */
    public function setContentElements(ObjectStorage $contentElements): void
    {
        $this->contentElements = $contentElements;
    }

    /**
     * Add content elements
     *
     * @param Content $contentElements
     */
    public function addContentElements(Content $contentElements): void
    {
        $this->contentElements->attach($contentElements);
    }

    /**
     * Remove content elements
     *
     * @param Content $contentElements
     */
    public function removeContentElements(Content $contentElements): void
    {
        $this->contentElements->detach($contentElements);
    }

    /**
     * Remove all content elements
     */
    public function removeAllContentElements(): void
    {
        $contentElements = clone $this->contentElements;
        $this->contentElements->removeAll($contentElements);
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
     * Get distribution language
     *
     * @return ObjectStorage<Tag>
     */
    public function getDistributionLanguage(): ObjectStorage
    {
        return $this->distributionLanguage;
    }

    /**
     * Set distribution language
     *
     * @param ObjectStorage<Tag> $distributionLanguage
     */
    public function setDistributionLanguage(ObjectStorage $distributionLanguage): void
    {
        $this->distributionLanguage = $distributionLanguage;
    }

    /**
     * Add distribution language
     *
     * @param Tag $distributionLanguage
     */
    public function addDistributionLanguage(Tag $distributionLanguage): void
    {
        $this->distributionLanguage->attach($distributionLanguage);
    }

    /**
     * Remove distribution language
     *
     * @param Tag $distributionLanguage
     */
    public function removeDistributionLanguage(Tag $distributionLanguage): void
    {
        $this->distributionLanguage->detach($distributionLanguage);
    }

    /**
     * Remove all distribution languages
     */
    public function removeAllDistributionLanguages(): void
    {
        $distributionLanguage = clone $this->distributionLanguage;
        $this->distributionLanguage->removeAll($distributionLanguage);
    }

    /**
     * Get distribution country
     *
     * @return ObjectStorage<Tag>
     */
    public function getDistributionCountry(): ObjectStorage
    {
        return $this->distributionCountry;
    }

    /**
     * Set distribution country
     *
     * @param ObjectStorage<Tag> $distributionCountry
     */
    public function setDistributionCountry(ObjectStorage $distributionCountry): void
    {
        $this->distributionCountry = $distributionCountry;
    }

    /**
     * Add distribution country
     *
     * @param Tag $distributionCountry
     */
    public function addDistributionCountry(Tag $distributionCountry): void
    {
        $this->distributionCountry->attach($distributionCountry);
    }

    /**
     * Remove distribution country
     *
     * @param Tag $distributionCountry
     */
    public function removeDistributionCountry(Tag $distributionCountry): void
    {
        $this->distributionCountry->detach($distributionCountry);
    }

    /**
     * Remove all distribution countries
     */
    public function removeAllDistributionCountries(): void
    {
        $distributionCountry = clone $this->distributionCountry;
        $this->distributionCountry->removeAll($distributionCountry);
    }

    /**
     * Get distribution region
     *
     * @return ObjectStorage<Tag>
     */
    public function getDistributionRegion(): ObjectStorage
    {
        return $this->distributionRegion;
    }

    /**
     * Set distribution region
     *
     * @param ObjectStorage<Tag> $distributionRegion
     */
    public function setDistributionRegion(ObjectStorage $distributionRegion): void
    {
        $this->distributionRegion = $distributionRegion;
    }

    /**
     * Add distribution region
     *
     * @param Tag $distributionRegion
     */
    public function addDistributionRegion(Tag $distributionRegion): void
    {
        $this->distributionRegion->attach($distributionRegion);
    }

    /**
     * Remove distribution region
     *
     * @param Tag $distributionRegion
     */
    public function removeDistributionRegion(Tag $distributionRegion): void
    {
        $this->distributionRegion->detach($distributionRegion);
    }

    /**
     * Remove all distribution regions
     */
    public function removeAllDistributionRegions(): void
    {
        $distributionRegion = clone $this->distributionRegion;
        $this->distributionRegion->removeAll($distributionRegion);
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