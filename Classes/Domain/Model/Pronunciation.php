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
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Pronunciation
 */
class Pronunciation extends AbstractEntity
{
    use HiddenTrait;
    use LabelTrait;
    use ParentResourceTrait;

    /**
     * List of possible transcriptions of the pronuncation
     * 
     * @var ObjectStorage<Transcription>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $transcription;

    /**
     * File that reads out the pronunciation
     * 
     * @var FileReference|LazyLoadingProxy|null
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected FileReference|LazyLoadingProxy|null $soundFile = null;

    /**
     * Inflected form that this pronunciation belongs to
     * 
     * @var InflectedForm|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected InflectedForm|LazyLoadingProxy|null $parentInflectedForm = null;

    /**
     * Dictionary entry that this pronunciation belongs to
     * 
     * @var DictionaryEntry|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected DictionaryEntry|LazyLoadingProxy|null $parentEntry = null;

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
        $this->label = new ObjectStorage();
        $this->parentResource = new ObjectStorage();
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
    public function removeAllTranscription(): void
    {
        $transcription = clone $this->transcription;
        $this->transcription->removeAll($transcription);
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
