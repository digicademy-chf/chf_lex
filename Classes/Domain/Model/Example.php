<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use DateTime;
use Digicademy\DABib\Domain\Reference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

/**
 * Model for examples
 */
class Example extends AbstractEntity
{
    /**
     * Sample text, e.g. a full sentence
     * 
     * @var string
     */
    protected string $text = '';

    /**
     * Date that the sample text is attested for
     * 
     * @var DateTime
     */
    protected $date;

    /**
     * Place that the sample text is attested for
     * 
     * @var string
     */
    protected string $location = '';

    #[Lazy()]
    /**
     * File that reads out the pronunciation
     * 
     * @var FileReference
     */
    protected $soundFile;

    #[Lazy()]
    /**
     * Token to identify a source
     * 
     * @var ObjectStorage<Tag>
     */
    protected $sourceIdentity;

    /**
     * Detailed reference, e.g., a page number
     * 
     * @var string
     */
    protected string $sourceElaboration = '';

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Full-blown reference as a source of the example
     * 
     * @var ObjectStorage<Reference>
     */
    protected $source;

    #[Lazy()]
    /**
     * Label to group the example into
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    /**
     * Initialize object
     *
     * @return Example
     */
    public function __construct()
    {
        $this->sourceIdentity = new ObjectStorage();
        $this->source         = new ObjectStorage();
        $this->label          = new ObjectStorage();
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     */
    public function setId(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Get date
     *
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * Set location
     *
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
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
     * Get source identity
     *
     * @return ObjectStorage|null
     */
    public function getSourceIdentity(): ?ObjectStorage
    {
        return $this->sourceIdentity;
    }

    /**
     * Set source identity
     *
     * @param ObjectStorage $sourceIdentity
     */
    public function setSourceIdentity($sourceIdentity): void
    {
        $this->sourceIdentity = $sourceIdentity;
    }

    /**
     * Add source identity
     *
     * @param Tag $sourceIdentity
     */
    public function addSourceIdentity(Tag $sourceIdentity): void
    {
        $this->sourceIdentity->attach($sourceIdentity);
    }

    /**
     * Remove source identity
     *
     * @param Tag $sourceIdentity
     */
    public function removeSourceIdentity(Tag $sourceIdentity): void
    {
        $this->sourceIdentity->detach($sourceIdentity);
    }

    /**
     * Get source elaboration
     *
     * @return string
     */
    public function getSourceElaboration(): string
    {
        return $this->sourceElaboration;
    }

    /**
     * Set source elaboration
     *
     * @param string $sourceElaboration
     */
    public function setSourceElaboration(string $sourceElaboration): void
    {
        $this->sourceElaboration = $sourceElaboration;
    }

    /**
     * Get source
     *
     * @return ObjectStorage|null
     */
    public function getSource(): ?ObjectStorage
    {
        return $this->source;
    }

    /**
     * Set source
     *
     * @param ObjectStorage $source
     */
    public function setSource($source): void
    {
        $this->source = $source;
    }

    /**
     * Add source
     *
     * @param Reference $source
     */
    public function addSource(Reference $source): void
    {
        $this->source->attach($source);
    }

    /**
     * Remove source
     *
     * @param Reference $source
     */
    public function removeSource(Reference $source): void
    {
        $this->source->detach($source);
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