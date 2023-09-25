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
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for pronunciations
 */
class Pronunciation extends AbstractEntity
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
     * File that reads out the pronunciation
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $soundFile;

    /**
     * Option to list various transcriptions of the pronuncation
     * 
     * @var ObjectStorage<Transcription>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $transcription;

    /**
     * Label to group the pronunication into
     * 
     * @var ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

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
        $this->soundFile     = new ObjectStorage();
        $this->transcription = new ObjectStorage();
        $this->label         = new ObjectStorage();
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
     * Get sound file
     *
     * @return ObjectStorage<FileReference>
     */
    public function getSoundFile(): ObjectStorage
    {
        return $this->soundFile;
    }

    /**
     * Set sound file
     *
     * @param ObjectStorage<FileReference> $soundFile
     */
    public function setSoundFile(ObjectStorage $soundFile): void
    {
        $this->soundFile = $soundFile;
    }

    /**
     * Add sound file
     *
     * @param FileReference $soundFile
     */
    public function addSoundFile(FileReference $soundFile): void
    {
        $this->soundFile->attach($soundFile);
    }

    /**
     * Remove sound file
     *
     * @param FileReference $soundFile
     */
    public function removeSoundFile(FileReference $soundFile): void
    {
        $this->soundFile->detach($soundFile);
    }

    /**
     * Remove all sound files
     */
    public function removeAllSoundFiles(): void
    {
        $soundFile = clone $this->soundFile;
        $this->soundFile->removeAll($soundFile);
    }

    /**
     * Get transcription
     *
     * @return ObjectStorage<Transcription>
     */
    public function getTranscription(): ObjectStorage
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
        $this->transcription->attach($transcription);
    }

    /**
     * Remove transcription
     *
     * @param Transcription $transcription
     */
    public function removeTranscription(Transcription $transcription): void
    {
        $this->transcription->detach($transcription);
    }

    /**
     * Remove all transcriptions
     */
    public function removeAllTranscriptions(): void
    {
        $transcription = clone $this->transcription;
        $this->transcription->removeAll($transcription);
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
}

?>