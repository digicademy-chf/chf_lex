<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\AgentRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LabelTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LocationRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use Digicademy\CHFBib\Domain\Model\Traits\SourceRelationTrait;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractExample
 */
class AbstractExample extends AbstractEntity
{
    use AgentRelationTrait;
    use HiddenTrait;
    use LabelTrait;
    use LocationRelationTrait;
    use ParentResourceTrait;

    /**
     * String that exemplifies the headword or the sense
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
     * File that reads out the example
     * 
     * @var FileReference|LazyLoadingProxy|null
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected FileReference|LazyLoadingProxy|null $soundFile = null;

    /**
     * Date when this example was in use
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $date = null;

    /**
     * Non-standard date of the example
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $dateText = '';

    /**
     * Sense that this example is part of
     * 
     * @var ?ObjectStorage<Sense>
     */
    #[Lazy()]
    protected ?ObjectStorage $parentSense = null;

    /**
     * Dictionary entry that this example is part of
     * 
     * @var ?ObjectStorage<DictionaryEntry>
     */
    #[Lazy()]
    protected ?ObjectStorage $parentEntry = null;

    /**
     * Construct object
     *
     * @param string $text
     * @return Example
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
        $this->label ??= new ObjectStorage();
        $this->agentRelation ??= new ObjectStorage();
        $this->locationRelation ??= new ObjectStorage();
        $this->parentSense ??= new ObjectStorage();
        $this->parentEntry ??= new ObjectStorage();
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
     * Get date
     *
     * @return ?\DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Get date text
     *
     * @return string
     */
    public function getDateText(): string
    {
        return $this->dateText;
    }

    /**
     * Set date text
     *
     * @param string $dateText
     */
    public function setDateText(string $dateText): void
    {
        $this->dateText = $dateText;
    }

    /**
     * Get parent sense
     *
     * @return ObjectStorage<Sense>
     */
    public function getParentSense(): ?ObjectStorage
    {
        return $this->parentSense;
    }

    /**
     * Set parent sense
     *
     * @param ObjectStorage<Sense> $parentSense
     */
    public function setParentSense(ObjectStorage $parentSense): void
    {
        $this->parentSense = $parentSense;
    }

    /**
     * Add parent sense
     *
     * @param Sense $parentSense
     */
    public function addParentSense(Sense $parentSense): void
    {
        $this->parentSense?->attach($parentSense);
    }

    /**
     * Remove parent sense
     *
     * @param Sense $parentSense
     */
    public function removeParentSense(Sense $parentSense): void
    {
        $this->parentSense?->detach($parentSense);
    }

    /**
     * Remove all parent senses
     */
    public function removeAllParentSense(): void
    {
        $parentSense = clone $this->parentSense;
        $this->parentSense->removeAll($parentSense);
    }

    /**
     * Get parent entry
     *
     * @return ObjectStorage<DictionaryEntry>
     */
    public function getParentEntry(): ?ObjectStorage
    {
        return $this->parentEntry;
    }

    /**
     * Set parent entry
     *
     * @param ObjectStorage<DictionaryEntry> $parentEntry
     */
    public function setParentEntry(ObjectStorage $parentEntry): void
    {
        $this->parentEntry = $parentEntry;
    }

    /**
     * Add parent entry
     *
     * @param DictionaryEntry $parentEntry
     */
    public function addParentEntry(DictionaryEntry $parentEntry): void
    {
        $this->parentEntry?->attach($parentEntry);
    }

    /**
     * Remove parent entry
     *
     * @param DictionaryEntry $parentEntry
     */
    public function removeParentEntry(DictionaryEntry $parentEntry): void
    {
        $this->parentEntry?->detach($parentEntry);
    }

    /**
     * Remove all parent entries
     */
    public function removeAllParentEntry(): void
    {
        $parentEntry = clone $this->parentEntry;
        $this->parentEntry->removeAll($parentEntry);
    }
}

# If CHF Bib is available
if (ExtensionManagementUtility::isLoaded('chf_bib')) {

    /**
     * Model for Example (with source-relation property)
     */
    class Example extends AbstractExample
    {
        use SourceRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label ??= new ObjectStorage();
            $this->agentRelation ??= new ObjectStorage();
            $this->locationRelation ??= new ObjectStorage();
            $this->sourceRelation ??= new ObjectStorage();
            $this->parentSense ??= new ObjectStorage();
            $this->parentEntry ??= new ObjectStorage();
        }
    }

# If no relevant extensions are available
} else {

    /**
     * Model for Example
     */
    class Example extends AbstractExample
    {}
}
