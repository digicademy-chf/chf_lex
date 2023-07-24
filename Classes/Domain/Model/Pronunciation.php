<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

/**
 * Model for pronunciations
 */
class Pronunciation extends AbstractEntity
{
    #[Lazy()]
    /**
     * File that reads out the pronunciation
     * 
     * @var FileReference
     */
    protected $soundFile;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Option to list various transcriptions of the pronuncation
     * 
     * @var ObjectStorage<Transcription>
     */
    protected $transcription;

    #[Lazy()]
    /**
     * Label to group the pronunication into
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    /**
     * Initialize object
     *
     * @return Pronunciation
     */
    public function __construct()
    {
        $this->transcription = new ObjectStorage();
        $this->label         = new ObjectStorage();
    }

    /**
     * Get sound file
     *
     * @return FileReference|null
     */
    public function getSoundFile(): ?FileReference
    {
        if ($this->soundFile instanceof LazyLoadingProxy) {
            $soundFile = $this->soundFile->_loadRealInstance();
            $this->soundFile = $soundFile;
        }
        return $this->soundFile;
    }

    /**
     * Set sound file
     *
     * @param FileReference $soundFile
     */
    public function setSoundFile(FileReference $soundFile): void
    {
        $this->soundFile = $soundFile;
    }

    /**
     * Get transcription
     *
     * @return ObjectStorage|null
     */
    public function getTranscription(): ?ObjectStorage
    {
        return $this->transcription;
    }

    /**
     * Set transcription
     *
     * @param ObjectStorage $transcription
     */
    public function setTranscription($transcription): void
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