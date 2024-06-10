<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for label tags
 */
class LabelTag extends AbstractTag
{
    /**
     * List of parts of speech that this tag may be used for
     * 
     * @var ObjectStorage<PartOfSpeechTag>
     */
    #[Lazy()]
    protected ObjectStorage $forPartOfSpeech;

    /**
     * Option to group various kinds of labels together
     * 
     * @var ObjectStorage<LabelTypeTag>
     */
    #[Lazy()]
    protected ObjectStorage $labelType;

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
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return LabelTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('label');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->forPartOfSpeech        = new ObjectStorage();
        $this->labelType              = new ObjectStorage();
        $this->asLabelOfEntry         = new ObjectStorage();
        $this->asLabelOfContributor   = new ObjectStorage();
        $this->asLabelOfSense         = new ObjectStorage();
        $this->asLabelOfExample       = new ObjectStorage();
        $this->asLabelOfInflectedForm = new ObjectStorage();
        $this->asLabelOfPronunciation = new ObjectStorage();
    }

    /**
     * Get for part of speech
     *
     * @return ObjectStorage<PartOfSpeechTag>
     */
    public function getForPartOfSpeech(): ObjectStorage
    {
        return $this->forPartOfSpeech;
    }

    /**
     * Set for part of speech
     *
     * @param ObjectStorage<PartOfSpeechTag> $forPartOfSpeech
     */
    public function setForPartOfSpeech(ObjectStorage $forPartOfSpeech): void
    {
        $this->forPartOfSpeech = $forPartOfSpeech;
    }

    /**
     * Add for part of speech
     *
     * @param PartOfSpeechTag $forPartOfSpeech
     */
    public function addForPartOfSpeech(PartOfSpeechTag $forPartOfSpeech): void
    {
        $this->forPartOfSpeech->attach($forPartOfSpeech);
    }

    /**
     * Remove for part of speech
     *
     * @param PartOfSpeechTag $forPartOfSpeech
     */
    public function removeForPartOfSpeech(PartOfSpeechTag $forPartOfSpeech): void
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
     * Get label type
     *
     * @return ObjectStorage<LabelTypeTag>
     */
    public function getLabelType(): ObjectStorage
    {
        return $this->labelType;
    }

    /**
     * Set label type
     *
     * @param ObjectStorage<LabelTypeTag> $labelType
     */
    public function setLabelType(ObjectStorage $labelType): void
    {
        $this->labelType = $labelType;
    }

    /**
     * Add label type
     *
     * @param LabelTypeTag $labelType
     */
    public function addLabelType(LabelTypeTag $labelType): void
    {
        $this->labelType->attach($labelType);
    }

    /**
     * Remove label type
     *
     * @param LabelTypeTag $labelType
     */
    public function removeLabelType(LabelTypeTag $labelType): void
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
     * Get label tag (alias of label type for DMLex conformity)
     *
     * @return ObjectStorage<LabelTypeTag>
     */
    public function getLabelTag(): ObjectStorage
    {
        return $this->getLabelType();
    }

    /**
     * Set label tag (alias of label type for DMLex conformity)
     *
     * @param ObjectStorage<LabelTypeTag> $labelTag
     */
    public function setLabelTag(ObjectStorage $labelTag): void
    {
        $this->setLabelType($labelTag);
    }

    /**
     * Add label tag (alias of label type for DMLex conformity)
     *
     * @param LabelTypeTag $labelTag
     */
    public function addLabelTag(LabelTypeTag $labelTag): void
    {
        $this->addLabelType($labelTag);
    }

    /**
     * Remove label tag (alias of label type for DMLex conformity)
     *
     * @param LabelTypeTag $labelTag
     */
    public function removeLabelTag(LabelTypeTag $labelTag): void
    {
        $this->removeLabelType($labelTag);
    }

    /**
     * Remove all label tags (alias of label type for DMLex conformity)
     */
    public function removeAllLabelTags(): void
    {
        $this->removeAllLabelTypes();
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
}
