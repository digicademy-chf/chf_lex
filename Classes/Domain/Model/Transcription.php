<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

defined('TYPO3') or die();

/**
 * Model for Transcription
 */
class Transcription extends AbstractEntity
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
     * Pronunciation that this transcription belongs to
     * 
     * @var Pronunciation|LazyLoadingProxy
     */
    #[Lazy()]
    protected Pronunciation|LazyLoadingProxy $parentPronunciation;

    /**
     * Transcribed version of the pronunciation
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
     * Transcription scheme used here
     * 
     * @var TranscriptionSchemeTag|LazyLoadingProxy
     */
    #[Lazy()]
    protected TranscriptionSchemeTag|LazyLoadingProxy $scheme;

    /**
     * Construct object
     *
     * @param Pronunciation $parentPronunciation
     * @param string $text
     * @return Transcription
     */
    public function __construct(Pronunciation $parentPronunciation, string $text)
    {
        $this->initializeObject();

        $this->setParentPronunciation($parentPronunciation);
        $this->setText($text);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentPronunciation = new LazyLoadingProxy();
        $this->scheme = new LazyLoadingProxy();
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
     * Get parent pronunciation
     * 
     * @return Pronunciation
     */
    public function getParentPronunciation(): Pronunciation
    {
        if ($this->parentPronunciation instanceof LazyLoadingProxy) {
            $this->parentPronunciation->_loadRealInstance();
        }
        return $this->parentPronunciation;
    }

    /**
     * Set parent pronunciation
     * 
     * @param Pronunciation
     */
    public function setParentPronunciation(Pronunciation $parentPronunciation): void
    {
        $this->parentPronunciation = $parentPronunciation;
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
     * @return TranscriptionSchemeTag
     */
    public function getScheme(): TranscriptionSchemeTag
    {
        if ($this->scheme instanceof LazyLoadingProxy) {
            $this->scheme->_loadRealInstance();
        }
        return $this->scheme;
    }

    /**
     * Set scheme
     * 
     * @param TranscriptionSchemeTag
     */
    public function setScheme(TranscriptionSchemeTag $scheme): void
    {
        $this->scheme = $scheme;
    }
}
