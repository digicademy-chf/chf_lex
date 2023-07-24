<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
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
    protected string $text = '';

    #[Lazy()]
    /**
     * Specify the type of inflection used here
     * 
     * @var ObjectStorage<Tag>
     */
    protected $inflectionType;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Define the pronunciation of the inflected form
     * 
     * @var ObjectStorage<Pronunciation>
     */
    protected $pronunciation;

    #[Lazy()]
    /**
     * Label to group the inflected form into
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    /**
     * Initialize object
     *
     * @return InflectedForm
     */
    public function __construct()
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
     * @return ObjectStorage|null
     */
    public function getInflectionType(): ?ObjectStorage
    {
        return $this->inflectionType;
    }

    /**
     * Set inflection type
     *
     * @param ObjectStorage $inflectionType
     */
    public function setInflectionType($inflectionType): void
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
}

?>