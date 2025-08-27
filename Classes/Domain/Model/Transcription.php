<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Transcription
 */
class Transcription extends AbstractEntity
{
    use HiddenTrait;
    use ParentResourceTrait;

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
     * @var TranscriptionSchemeTag|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected TranscriptionSchemeTag|LazyLoadingProxy|null $scheme = null;

    /**
     * Pronunciation that this transcription belongs to
     * 
     * @var Pronunciation|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Pronunciation|LazyLoadingProxy|null $parentPronunciation = null;

    /**
     * Construct object
     *
     * @param string $text
     * @param Pronunciation $parentPronunciation
     * @return Transcription
     */
    public function __construct(string $text, Pronunciation $parentPronunciation)
    {
        $this->initializeObject();

        $this->setText($text);
        $this->setParentPronunciation($parentPronunciation);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentResource ??= new ObjectStorage();
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
}
