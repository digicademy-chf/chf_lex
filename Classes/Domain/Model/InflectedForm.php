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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for inflected forms
 */
class InflectedForm extends AbstractEntity
{
    /**
     * Text of the inflected form
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
     * Specify the type of inflection used here
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $inflectionType;

    /**
     * Define the pronunciation of the inflected form
     * 
     * @var ObjectStorage<Pronunciation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected $pronunciation;

    /**
     * Label to group the inflected form into
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

    /**
     * Construct object
     *
     * @param string $text
     * @return InflectedForm
     */
    public function __construct(string $text)
    {
        $this->initializeObject();

        $this->setText($text);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->inflectionType = new ObjectStorage();
        $this->pronunciation  = new ObjectStorage();
        $this->label          = new ObjectStorage();
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
     * Get inflection type
     *
     * @return ObjectStorage<Tag>
     */
    public function getInflectionType(): ObjectStorage
    {
        return $this->inflectionType;
    }

    /**
     * Set inflection type
     *
     * @param ObjectStorage<Tag> $inflectionType
     */
    public function setInflectionType(ObjectStorage $inflectionType): void
    {
        $this->inflectionType = $inflectionType;
    }

    /**
     * Add inflection type
     *
     * @param Tag $inflectionType
     */
    public function addInflectionType(Tag $inflectionType): void
    {
        $this->inflectionType->attach($inflectionType);
    }

    /**
     * Remove inflection type
     *
     * @param Tag $inflectionType
     */
    public function removeInflectionType(Tag $inflectionType): void
    {
        $this->inflectionType->detach($inflectionType);
    }

    /**
     * Remove all inflection types
     */
    public function removeAllInflectionTypes(): void
    {
        $inflectionType = clone $this->inflectionType;
        $this->inflectionType->removeAll($inflectionType);
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
}

?>