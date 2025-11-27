<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LabelTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for InflectedForm
 */
class InflectedForm extends AbstractEntity
{
    use HiddenTrait;
    use LabelTrait;
    use ParentResourceTrait;

    /**
     * String of the inflected form
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $text = '';

    /**
     * Type of inflection provided here
     * 
     * @var InflectionTypeTag|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected InflectionTypeTag|LazyLoadingProxy|null $inflectionType = null;

    /**
     * Pronunciation of the inflected form
     * 
     * @var ObjectStorage<Pronunciation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $pronunciation;

    /**
     * Dictionary entry that this inflected form is part of
     * 
     * @var DictionaryEntry|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected DictionaryEntry|LazyLoadingProxy|null $parentEntry = null;

    /**
     * Construct object
     *
     * @param string $text
     * @param DictionaryEntry $parentEntry
     * @return InflectedForm
     */
    public function __construct(string $text, DictionaryEntry $parentEntry)
    {
        $this->initializeObject();

        $this->setText($text);
        $this->setParentEntry($parentEntry);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->pronunciation = new ObjectStorage();
        $this->label = new ObjectStorage();
        $this->parentResource = new ObjectStorage();
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
     * @return InflectionTypeTag
     */
    public function getInflectionType(): InflectionTypeTag
    {
        if ($this->inflectionType instanceof LazyLoadingProxy) {
            $this->inflectionType->_loadRealInstance();
        }
        return $this->inflectionType;
    }

    /**
     * Set inflection type
     * 
     * @param InflectionTypeTag
     */
    public function setInflectionType(InflectionTypeTag $inflectionType): void
    {
        $this->inflectionType = $inflectionType;
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
    public function removeAllPronunciation(): void
    {
        $pronunciation = clone $this->pronunciation;
        $this->pronunciation->removeAll($pronunciation);
    }

    /**
     * Get parent entry
     * 
     * @return DictionaryEntry
     */
    public function getParentEntry(): DictionaryEntry
    {
        if ($this->parentEntry instanceof LazyLoadingProxy) {
            $this->parentEntry->_loadRealInstance();
        }
        return $this->parentEntry;
    }

    /**
     * Set parent entry
     * 
     * @param DictionaryEntry
     */
    public function setParentEntry(DictionaryEntry $parentEntry): void
    {
        $this->parentEntry = $parentEntry;
    }
}
