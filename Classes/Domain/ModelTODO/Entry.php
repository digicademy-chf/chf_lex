<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for entries
 */
class Entry extends AbstractEntry
{
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
     * Assess the entry using a given set of categories
     * 
     * @var ObjectStorage<ClassificationEntryTag>
     */
    #[Lazy()]
    protected ObjectStorage $classification;

    /**
     * Define the headword's part of speech
     * 
     * @var ObjectStorage<PartOfSpeechTag>
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
     * Languages associated with this entry
     * 
     * @var ObjectStorage<LanguageTag>
     */
    #[Lazy()]
    protected ObjectStorage $distributionLanguage;

    /**
     * Countries connected to this entry
     * 
     * @var ObjectStorage<CountryTag>
     */
    #[Lazy()]
    protected ObjectStorage $distributionCountry;

    /**
     * Regions connected to this entry
     * 
     * @var ObjectStorage<RegionTag>
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
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $headword
     * @return Entry
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $headword)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setType('entry');
        $this->setHeadword($headword);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->classification       = new ObjectStorage();
        $this->partOfSpeech         = new ObjectStorage();
        $this->inflectedForm        = new ObjectStorage();
        $this->pronunciation        = new ObjectStorage();
        $this->sense                = new ObjectStorage();
        $this->example              = new ObjectStorage();
        $this->distributionLanguage = new ObjectStorage();
        $this->distributionCountry  = new ObjectStorage();
        $this->distributionRegion   = new ObjectStorage();
        $this->frequency            = new ObjectStorage();
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
     * Get classification
     *
     * @return ObjectStorage<ClassificationEntryTag>
     */
    public function getClassification(): ObjectStorage
    {
        return $this->classification;
    }

    /**
     * Set classification
     *
     * @param ObjectStorage<ClassificationEntryTag> $classification
     */
    public function setClassification(ObjectStorage $classification): void
    {
        $this->classification = $classification;
    }

    /**
     * Add classification
     *
     * @param ClassificationEntryTag $classification
     */
    public function addClassification(ClassificationEntryTag $classification): void
    {
        $this->classification->attach($classification);
    }

    /**
     * Remove classification
     *
     * @param ClassificationEntryTag $classification
     */
    public function removeClassification(ClassificationEntryTag $classification): void
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
     * @return ObjectStorage<PartOfSpeechTag>
     */
    public function getPartOfSpeech(): ObjectStorage
    {
        return $this->partOfSpeech;
    }

    /**
     * Set part of speech
     *
     * @param ObjectStorage<PartOfSpeechTag> $partOfSpeech
     */
    public function setPartOfSpeech(ObjectStorage $partOfSpeech): void
    {
        $this->partOfSpeech = $partOfSpeech;
    }

    /**
     * Add part of speech
     *
     * @param PartOfSpeechTag $partOfSpeech
     */
    public function addPartOfSpeech(PartOfSpeechTag $partOfSpeech): void
    {
        $this->partOfSpeech->attach($partOfSpeech);
    }

    /**
     * Remove part of speech
     *
     * @param PartOfSpeechTag $partOfSpeech
     */
    public function removePartOfSpeech(PartOfSpeechTag $partOfSpeech): void
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
     * Get distribution language
     *
     * @return ObjectStorage<LanguageTag>
     */
    public function getDistributionLanguage(): ObjectStorage
    {
        return $this->distributionLanguage;
    }

    /**
     * Set distribution language
     *
     * @param ObjectStorage<LanguageTag> $distributionLanguage
     */
    public function setDistributionLanguage(ObjectStorage $distributionLanguage): void
    {
        $this->distributionLanguage = $distributionLanguage;
    }

    /**
     * Add distribution language
     *
     * @param LanguageTag $distributionLanguage
     */
    public function addDistributionLanguage(LanguageTag $distributionLanguage): void
    {
        $this->distributionLanguage->attach($distributionLanguage);
    }

    /**
     * Remove distribution language
     *
     * @param LanguageTag $distributionLanguage
     */
    public function removeDistributionLanguage(LanguageTag $distributionLanguage): void
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
     * @return ObjectStorage<CountryTag>
     */
    public function getDistributionCountry(): ObjectStorage
    {
        return $this->distributionCountry;
    }

    /**
     * Set distribution country
     *
     * @param ObjectStorage<CountryTag> $distributionCountry
     */
    public function setDistributionCountry(ObjectStorage $distributionCountry): void
    {
        $this->distributionCountry = $distributionCountry;
    }

    /**
     * Add distribution country
     *
     * @param CountryTag $distributionCountry
     */
    public function addDistributionCountry(CountryTag $distributionCountry): void
    {
        $this->distributionCountry->attach($distributionCountry);
    }

    /**
     * Remove distribution country
     *
     * @param CountryTag $distributionCountry
     */
    public function removeDistributionCountry(CountryTag $distributionCountry): void
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
     * @return ObjectStorage<RegionTag>
     */
    public function getDistributionRegion(): ObjectStorage
    {
        return $this->distributionRegion;
    }

    /**
     * Set distribution region
     *
     * @param ObjectStorage<RegionTag> $distributionRegion
     */
    public function setDistributionRegion(ObjectStorage $distributionRegion): void
    {
        $this->distributionRegion = $distributionRegion;
    }

    /**
     * Add distribution region
     *
     * @param RegionTag $distributionRegion
     */
    public function addDistributionRegion(RegionTag $distributionRegion): void
    {
        $this->distributionRegion->attach($distributionRegion);
    }

    /**
     * Remove distribution region
     *
     * @param RegionTag $distributionRegion
     */
    public function removeDistributionRegion(RegionTag $distributionRegion): void
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
}
