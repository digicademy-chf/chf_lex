<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for transcription-scheme tags
 */
class TranscriptionSchemeTag extends AbstractTag
{
    /**
     * List of transcriptions with this scheme
     * 
     * @var ObjectStorage<Transcription>
     */
    #[Lazy()]
    protected ObjectStorage $asSchemeOfTranscription;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return TranscriptionSchemeTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('transcriptionScheme');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asSchemeOfTranscription = new ObjectStorage();
    }

    /**
     * Get as scheme of transcription
     *
     * @return ObjectStorage<Transcription>
     */
    public function getAsSchemeOfTranscription(): ObjectStorage
    {
        return $this->asSchemeOfTranscription;
    }

    /**
     * Set as scheme of transcription
     *
     * @param ObjectStorage<Transcription> $asSchemeOfTranscription
     */
    public function setAsSchemeOfTranscription(ObjectStorage $asSchemeOfTranscription): void
    {
        $this->asSchemeOfTranscription = $asSchemeOfTranscription;
    }

    /**
     * Add as scheme of transcription
     *
     * @param Transcription $asSchemeOfTranscription
     */
    public function addAsSchemeOfTranscription(Transcription $asSchemeOfTranscription): void
    {
        $this->asSchemeOfTranscription->attach($asSchemeOfTranscription);
    }

    /**
     * Remove as scheme of transcription
     *
     * @param Transcription $asSchemeOfTranscription
     */
    public function removeAsSchemeOfTranscription(Transcription $asSchemeOfTranscription): void
    {
        $this->asSchemeOfTranscription->detach($asSchemeOfTranscription);
    }

    /**
     * Remove all as scheme of transcriptions
     */
    public function removeAllAsSchemeOfTranscriptions(): void
    {
        $asSchemeOfTranscription = clone $this->asSchemeOfTranscription;
        $this->asSchemeOfTranscription->removeAll($asSchemeOfTranscription);
    }
}

?>