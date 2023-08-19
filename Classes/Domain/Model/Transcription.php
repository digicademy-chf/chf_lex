<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for transcriptions
 */
class Transcription extends AbstractEntity
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
     * Transcribed version of the pronunciation
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
     * Transcription scheme used here
     * 
     * @var ObjectStorage<TranscriptionSchemeTag>
     */
    #[Lazy()]
    protected ObjectStorage $scheme;

    /**
     * Construct object
     *
     * @param string $text
     * @return Transcription
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
        $this->scheme = new ObjectStorage();
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
     * Get scheme
     *
     * @return ObjectStorage<TranscriptionSchemeTag>
     */
    public function getScheme(): ObjectStorage
    {
        return $this->scheme;
    }

    /**
     * Set scheme
     *
     * @param ObjectStorage<TranscriptionSchemeTag> $scheme
     */
    public function setScheme(ObjectStorage $scheme): void
    {
        $this->scheme = $scheme;
    }

    /**
     * Add scheme
     *
     * @param TranscriptionSchemeTag $scheme
     */
    public function addScheme(TranscriptionSchemeTag $scheme): void
    {
        $this->scheme->attach($scheme);
    }

    /**
     * Remove scheme
     *
     * @param TranscriptionSchemeTag $scheme
     */
    public function removeScheme(TranscriptionSchemeTag $scheme): void
    {
        $this->scheme->detach($scheme);
    }

    /**
     * Remove all schemes
     */
    public function removeAllSchemes(): void
    {
        $scheme = clone $this->scheme;
        $this->scheme->removeAll($scheme);
    }
}

?>