<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractTag;

defined('TYPO3') or die();

/**
 * Model for PartOfSpeechTag
 */
class PartOfSpeechTag extends AbstractTag
{
    /**
     * List of dictionary entries that use this part of speech
     * 
     * @var ?ObjectStorage<DictionaryEntry>
     */
    #[Lazy()]
    protected ?ObjectStorage $asPartOfSpeechOfDictionaryEntry;

    /**
     * Construct object
     *
     * @param LexicographicResource $parentResource
     * @param string $uuid
     * @param string $code
     * @param string $text
     * @return PartOfSpeechTag
     */
    public function __construct(LexicographicResource $parentResource, string $uuid, string $code, string $text)
    {
        parent::__construct($parentResource, $uuid, $code, $text);
        $this->initializeObject();

        $this->setType('partOfSpeechTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->asPartOfSpeechOfDictionaryEntry ??= new ObjectStorage();
    }

    /**
     * Get as part of speech of dictionary entry
     *
     * @return ObjectStorage<DictionaryEntry>
     */
    public function getAsPartOfSpeechOfDictionaryEntry(): ?ObjectStorage
    {
        return $this->asPartOfSpeechOfDictionaryEntry;
    }

    /**
     * Set as part of speech of dictionary entry
     *
     * @param ObjectStorage<DictionaryEntry> $asPartOfSpeechOfDictionaryEntry
     */
    public function setAsPartOfSpeechOfDictionaryEntry(ObjectStorage $asPartOfSpeechOfDictionaryEntry): void
    {
        $this->asPartOfSpeechOfDictionaryEntry = $asPartOfSpeechOfDictionaryEntry;
    }

    /**
     * Add as part of speech of dictionary entry
     *
     * @param DictionaryEntry $asPartOfSpeechOfDictionaryEntry
     */
    public function addAsPartOfSpeechOfDictionaryEntry(DictionaryEntry $asPartOfSpeechOfDictionaryEntry): void
    {
        $this->asPartOfSpeechOfDictionaryEntry?->attach($asPartOfSpeechOfDictionaryEntry);
    }

    /**
     * Remove as part of speech of dictionary entry
     *
     * @param DictionaryEntry $asPartOfSpeechOfDictionaryEntry
     */
    public function removeAsPartOfSpeechOfDictionaryEntry(DictionaryEntry $asPartOfSpeechOfDictionaryEntry): void
    {
        $this->asPartOfSpeechOfDictionaryEntry?->detach($asPartOfSpeechOfDictionaryEntry);
    }

    /**
     * Remove all as part of speech of dictionary entries
     */
    public function removeAllAsPartOfSpeechOfDictionaryEntry(): void
    {
        $asPartOfSpeechOfDictionaryEntry = clone $this->asPartOfSpeechOfDictionaryEntry;
        $this->asPartOfSpeechOfDictionaryEntry->removeAll($asPartOfSpeechOfDictionaryEntry);
    }
}
