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
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for DictionaryEntry
 */
class DictionaryEntry extends AbstractEntry
{
    /**
     * Lemma identifying the word discussed in the entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $headword = '';

    /**
     * Define the headword's part of speech
     * 
     * @var PartOfSpeechTag|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected PartOfSpeechTag|LazyLoadingProxy|null $partOfSpeech = null;

    /**
     * Optional number to distinguish homographs
     * 
     * @var ?int
     */
    #[Validate([
        'validator' => 'NumberRange',
        'options' => [
            'minimum' => 1,
        ],
    ])]
    protected ?int $homographNumber = null;

    /**
     * List of senses for this entry
     * 
     * @var ?ObjectStorage<Sense>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $sense = null;

    /**
     * List of contemporary or historical examples of this dictionary entry
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
     * List of possible pronunciations of the headword
     * 
     * @var ?ObjectStorage<Pronunciation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $pronunciation = null;

    /**
     * List of the headword's inflected forms
     * 
     * @var ?ObjectStorage<InflectedForm>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $inflectedForm = null;

    /**
     * Database query that identifies entries edited in a single run
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $editorialQuery = '';

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
     * @param string $headword
     * @param LexicographicResource $parentResource
     * @return DictionaryEntry
     */
    public function __construct(string $headword, LexicographicResource $parentResource)
    {
        parent::__construct($parentResource);
        $this->initializeObject();

        $this->setHeadword($headword);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->sense ??= new ObjectStorage();
        $this->example ??= new ObjectStorage();
        $this->frequency ??= new ObjectStorage();
        $this->pronunciation ??= new ObjectStorage();
        $this->inflectedForm ??= new ObjectStorage();
        $this->asRefOfMember ??= new ObjectStorage();
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
     * Get part of speech
     * 
     * @return PartOfSpeechTag
     */
    public function getPartOfSpeech(): PartOfSpeechTag
    {
        if ($this->partOfSpeech instanceof LazyLoadingProxy) {
            $this->partOfSpeech->_loadRealInstance();
        }
        return $this->partOfSpeech;
    }

    /**
     * Set part of speech
     * 
     * @param PartOfSpeechTag
     */
    public function setPartOfSpeech(PartOfSpeechTag $partOfSpeech): void
    {
        $this->partOfSpeech = $partOfSpeech;
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
     * Get sense
     *
     * @return ObjectStorage<Sense>
     */
    public function getSense(): ?ObjectStorage
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
        $this->sense?->attach($sense);
    }

    /**
     * Remove sense
     *
     * @param Sense $sense
     */
    public function removeSense(Sense $sense): void
    {
        $this->sense?->detach($sense);
    }

    /**
     * Remove all senses
     */
    public function removeAllSense(): void
    {
        $sense = clone $this->sense;
        $this->sense->removeAll($sense);
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
     * Get pronunciation
     *
     * @return ObjectStorage<Pronunciation>
     */
    public function getPronunciation(): ?ObjectStorage
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
        $this->pronunciation?->attach($pronunciation);
    }

    /**
     * Remove pronunciation
     *
     * @param Pronunciation $pronunciation
     */
    public function removePronunciation(Pronunciation $pronunciation): void
    {
        $this->pronunciation?->detach($pronunciation);
    }

    /**
     * Remove all pronunciations
     */
    public function removeAllPronunciation(): void
    {
        $pronunciation = clone $this->pronunciation;
        $this->pronunciation->removeAll($pronunciation);
    }

    /**
     * Get inflected form
     *
     * @return ObjectStorage<InflectedForm>
     */
    public function getInflectedForm(): ?ObjectStorage
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
        $this->inflectedForm?->attach($inflectedForm);
    }

    /**
     * Remove inflected form
     *
     * @param InflectedForm $inflectedForm
     */
    public function removeInflectedForm(InflectedForm $inflectedForm): void
    {
        $this->inflectedForm?->detach($inflectedForm);
    }

    /**
     * Remove all inflected forms
     */
    public function removeAllInflectedForm(): void
    {
        $inflectedForm = clone $this->inflectedForm;
        $this->inflectedForm->removeAll($inflectedForm);
    }

    /**
     * Get editorial query
     *
     * @return string
     */
    public function getEditorialQuery(): string
    {
        return $this->editorialQuery;
    }

    /**
     * Set editorial query
     *
     * @param string $editorialQuery
     */
    public function setEditorialQuery(string $editorialQuery): void
    {
        $this->editorialQuery = $editorialQuery;
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
