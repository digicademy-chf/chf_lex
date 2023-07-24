<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use DateTime;
use Digicademy\DABib\Domain\Reference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for entries
 */
class Entry extends AbstractEntity
{
    /**
     * Simple identifier of this entry as part of a single dataset
     * 
     * @var string
     */
    protected string $id = '';

    /**
     * Unique entry identifier
     * 
     * @var string
     */
    protected string $uuid = '';

    /**
     * Type of entry
     * 
     * @var string
     */
    protected string $type = '';

    /**
     * Single lemma identifying the word discussed in the entry
     * 
     * @var string
     */
    protected string $headword = '';

    /**
     * Optional number to distinguish lemmas that are spelled the same
     * 
     * @var int
     */
    protected string $homographNumber;

    /**
     * Name of the entry
     * 
     * @var string
     */
    protected string $title = '';

    /**
     * List of comma-separated strings to link to this glossary entry
     * 
     * @var string
     */
    protected string $annotateStrings = '';

    #[Lazy()]
    /**
     * Label to group the entry into
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * External web address to identify the entry across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    protected $sameAs;

    #[Lazy()]
    /**
     * List of authors of this entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $author;

    #[Lazy()]
    /**
     * List of editors of this entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $editor;

    /**
     * Counter to increase when the entry is changed significantly
     * 
     * @var int
     */
    protected string $revisionNumber;

    /**
     * Date when the last significant edit was made
     * 
     * @var DateTime
     */
    protected $revisionDate;

    /**
     * Query that identifies a set of entries edited in a single run
     * 
     * @var string
     */
    protected string $databaseQuery = '';

    /**
     * Date when the entry was published on the web
     * 
     * @var DateTime
     */
    protected $publicationDate;

    /**
     * Indicator of the entry's publication status
     * 
     * @var string
     */
    protected string $publicationSteps = '';

    /**
     * Indicator of the steps taken in writing the entry
     * 
     * @var string
     */
    protected string $editingSteps = '';

    /**
     * Comments that support the editorial process
     * 
     * @var string
     */
    protected string $editingNotes = '';

    /**
     * Assess the entry using a given set of categories
     * 
     * @var string
     */
    protected string $classification = '';

    #[Lazy()]
    /**
     * Define the headword's part of speech
     * 
     * @var ObjectStorage<Tag>
     */
    protected $partOfSpeech;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Define the headword's inflected forms
     * 
     * @var ObjectStorage<InflectedForm>
     */
    protected $inflectedForm;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Define the pronunciation of the headword
     * 
     * @var ObjectStorage<Pronunciation>
     */
    protected $pronunciation;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * List of senses for this entry
     * 
     * @var ObjectStorage<Sense>
     */
    protected $sense;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Contemporary or historical examples of this entry
     * 
     * @var ObjectStorage<Example>
     */
    protected $example;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Content blocks that make up the content of this entry
     * 
     * @var ObjectStorage<TtContent>
     */
    protected $contentElements;

    #[Lazy()]
    /**
     * Languages associated with this entry
     * 
     * @var ObjectStorage<Tag>
     */
    protected $distributionLanguage;

    #[Lazy()]
    /**
     * Countries connected to this entry
     * 
     * @var ObjectStorage<Tag>
     */
    protected $distributionCountry;

    #[Lazy()]
    /**
     * Regions connected to this entry
     * 
     * @var ObjectStorage<Tag>
     */
    protected $distributionRegion;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * List of domestic and foreign frequency data
     * 
     * @var ObjectStorage<Frequency>
     */
    protected $frequency;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * List of references for this entry
     * 
     * @var ObjectStorage<Reference>
     */
    protected $source;

    /**
     * Content of the file used to populate this record
     * 
     * @var string
     */
    protected string $import = '';

    /**
     * Initialize object
     *
     * @return Entry
     */
    public function __construct()
    {
        $this->label                = new ObjectStorage();
        $this->sameAs               = new ObjectStorage();
        $this->author               = new ObjectStorage();
        $this->editor               = new ObjectStorage();
        $this->partOfSpeech         = new ObjectStorage();
        $this->inflectedForm        = new ObjectStorage();
        $this->pronunciation        = new ObjectStorage();
        $this->sense                = new ObjectStorage();
        $this->example              = new ObjectStorage();
        $this->contentElements      = new ObjectStorage();
        $this->distributionLanguage = new ObjectStorage();
        $this->distributionCountry  = new ObjectStorage();
        $this->distributionRegion   = new ObjectStorage();
        $this->frequency            = new ObjectStorage();
        $this->source               = new ObjectStorage();
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

    /**
     * Get author
     *
     * @return ObjectStorage|null
     */
    public function getAuthor(): ?ObjectStorage
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param ObjectStorage $author
     */
    public function setAuthor($author): void
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
     * Get editor
     *
     * @return ObjectStorage|null
     */
    public function getEditor(): ?ObjectStorage
    {
        return $this->editor;
    }

    /**
     * Set editor
     *
     * @param ObjectStorage $editor
     */
    public function setEditor($editor): void
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
     * @return string
     */
    public function getClassification(): string
    {
        return $this->classification;
    }

    /**
     * Set classification
     *
     * @param string $classification
     */
    public function setClassification(string $classification): void
    {
        $this->classification = $classification;
    }

    /**
     * Get part of speech
     *
     * @return ObjectStorage|null
     */
    public function getPartOfSpeech(): ?ObjectStorage
    {
        return $this->partOfSpeech;
    }

    /**
     * Set part of speech
     *
     * @param ObjectStorage $partOfSpeech
     */
    public function setPartOfSpeech($partOfSpeech): void
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
     * Get inflected form
     *
     * @return ObjectStorage|null
     */
    public function getInflectedForm(): ?ObjectStorage
    {
        return $this->inflectedForm;
    }

    /**
     * Set inflected form
     *
     * @param ObjectStorage $inflectedForm
     */
    public function setInflectedForm($inflectedForm): void
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
     * Get pronunciation
     *
     * @return ObjectStorage|null
     */
    public function getPronunciation(): ?ObjectStorage
    {
        return $this->pronunciation;
    }

    /**
     * Set pronunciation
     *
     * @param ObjectStorage $pronunciation
     */
    public function setPronunciation($pronunciation): void
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
     * Get sense
     *
     * @return ObjectStorage|null
     */
    public function getSense(): ?ObjectStorage
    {
        return $this->sense;
    }

    /**
     * Set sense
     *
     * @param ObjectStorage $sense
     */
    public function setSense($sense): void
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
     * Get content elements
     *
     * @return ObjectStorage|null
     */
    public function getContentElements(): ?ObjectStorage
    {
        return $this->contentElements;
    }

    /**
     * Set content elements
     *
     * @param ObjectStorage $contentElements
     */
    public function setContentElements($contentElements): void
    {
        $this->contentElements = $contentElements;
    }

    /**
     * Add content elements
     *
     * @param TtContent $contentElements
     */
    public function addContentElements(TtContent $contentElements): void
    {
        $this->contentElements->attach($contentElements);
    }

    /**
     * Remove content elements
     *
     * @param TtContent $contentElements
     */
    public function removeContentElements(TtContent $contentElements): void
    {
        $this->contentElements->detach($contentElements);
    }

    /**
     * Get distribution language
     *
     * @return ObjectStorage|null
     */
    public function getDistributionLanguage(): ?ObjectStorage
    {
        return $this->distributionLanguage;
    }

    /**
     * Set distribution language
     *
     * @param ObjectStorage $distributionLanguage
     */
    public function setDistributionLanguage($distributionLanguage): void
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
     * Get distribution country
     *
     * @return ObjectStorage|null
     */
    public function getDistributionCountry(): ?ObjectStorage
    {
        return $this->distributionCountry;
    }

    /**
     * Set distribution country
     *
     * @param ObjectStorage $distributionCountry
     */
    public function setDistributionCountry($distributionCountry): void
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
     * Get distribution region
     *
     * @return ObjectStorage|null
     */
    public function getDistributionRegion(): ?ObjectStorage
    {
        return $this->distributionRegion;
    }

    /**
     * Set distribution region
     *
     * @param ObjectStorage $distributionRegion
     */
    public function setDistributionRegion($distributionRegion): void
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
     * Get source
     *
     * @return ObjectStorage|null
     */
    public function getSource(): ?ObjectStorage
    {
        return $this->source;
    }

    /**
     * Set source
     *
     * @param ObjectStorage $source
     */
    public function setSource($source): void
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
}

?>