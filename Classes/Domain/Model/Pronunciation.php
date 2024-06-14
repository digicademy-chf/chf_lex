<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Pronunciation
 */
class Pronunciation extends AbstractEntity
{
    /**
     * Whether the record should be visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = true;

    /**
     * Dictionary entry that this pronunciation belongs to
     * 
     * @var DictionaryEntry|LazyLoadingProxy
     */
    #[Lazy()]
    protected DictionaryEntry|LazyLoadingProxy $parentEntry;

    /**
     * Inflected form that this pronunciation belongs to
     * 
     * @var InflectedForm|LazyLoadingProxy
     */
    #[Lazy()]
    protected InflectedForm|LazyLoadingProxy $parentInflectedForm;

    /**
     * File that reads out the pronunciation
     * 
     * @var FileReference|LazyLoadingProxy
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected FileReference|LazyLoadingProxy $soundFile;

    /**
     * List of possible transcriptions of the pronuncation
     * 
     * @var ?ObjectStorage<Transcription>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $transcription = null;

    /**
     * Label to group the database record into
     * 
     * @var ?ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $label = null;

    /**
     * Construct object
     *
     * @return Pronunciation
     */
    public function __construct()
    {
        $this->initializeObject();
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentEntry = new LazyLoadingProxy();
        $this->parentInflectedForm = new LazyLoadingProxy();
        $this->soundFile = new LazyLoadingProxy();
        $this->label ??= new ObjectStorage();
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

    /**
     * Get parent inflected form
     * 
     * @return InflectedForm
     */
    public function getParentInflectedForm(): InflectedForm
    {
        if ($this->parentInflectedForm instanceof LazyLoadingProxy) {
            $this->parentInflectedForm->_loadRealInstance();
        }
        return $this->parentInflectedForm;
    }

    /**
     * Set parent inflected form
     * 
     * @param InflectedForm
     */
    public function setParentInflectedForm(InflectedForm $parentInflectedForm): void
    {
        $this->parentInflectedForm = $parentInflectedForm;
    }

    /**
     * Get sound file
     * 
     * @return FileReference
     */
    public function getSoundFile(): FileReference
    {
        if ($this->soundFile instanceof LazyLoadingProxy) {
            $this->soundFile->_loadRealInstance();
        }
        return $this->soundFile;
    }

    /**
     * Set sound file
     * 
     * @param FileReference
     */
    public function setSoundFile(FileReference $soundFile): void
    {
        $this->soundFile = $soundFile;
    }

    /**
     * Get transcription
     *
     * @return ObjectStorage<Transcription>
     */
    public function getTranscription(): ?ObjectStorage
    {
        return $this->transcription;
    }

    /**
     * Set transcription
     *
     * @param ObjectStorage<Transcription> $transcription
     */
    public function setTranscription(ObjectStorage $transcription): void
    {
        $this->transcription = $transcription;
    }

    /**
     * Add transcription
     *
     * @param Transcription $transcription
     */
    public function addTranscription(Transcription $transcription): void
    {
        $this->transcription?->attach($transcription);
    }

    /**
     * Remove transcription
     *
     * @param Transcription $transcription
     */
    public function removeTranscription(Transcription $transcription): void
    {
        $this->transcription?->detach($transcription);
    }

    /**
     * Remove all transcriptions
     */
    public function removeAllTranscription(): void
    {
        $transcription = clone $this->transcription;
        $this->transcription->removeAll($transcription);
    }

    /**
     * Get label
     *
     * @return ObjectStorage<LabelTag>
     */
    public function getLabel(): ?ObjectStorage
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
        $this->label?->attach($label);
    }

    /**
     * Remove label
     *
     * @param LabelTag $label
     */
    public function removeLabel(LabelTag $label): void
    {
        $this->label?->detach($label);
    }

    /**
     * Remove all labels
     */
    public function removeAllLabel(): void
    {
        $label = clone $this->label;
        $this->label->removeAll($label);
    }
}
