<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use DateTime;
use Digicademy\DABib\Domain\Model\Reference;
use Digicademy\DAMap\Domain\Model\Feature;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

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
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $text = '';

    /**
     * Approximate date that the sample text is attested for
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $dateCirca = '';

    /**
     * Exact onset of the period that the sample text is attested for
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $dateStart = null;

    /**
     * Exact ending of the period that the sample text is attested for
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $dateEnd = null;

    /**
     * Place that the sample text is attested for
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $locationLabel = '';

    /**
     * Geodata for the place that the sample text is attested for
     * 
     * @var ObjectStorage<Feature>
     */
    #[Lazy()]
    protected ObjectStorage $locationGeodata;

    /**
     * File that reads out the sample text
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $soundFile;

    /**
     * Token to identify a source
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $sourceIdentity;

    /**
     * Detailed reference, e.g., a page number
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $sourceElaboration = '';

    /**
     * Full-blown reference as a source of the example
     * 
     * @var ObjectStorage<Reference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $source;

    /**
     * Label to group the example into
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

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
        $this->locationGeodata = new ObjectStorage();
        $this->soundFile       = new ObjectStorage();
        $this->sourceIdentity  = new ObjectStorage();
        $this->source          = new ObjectStorage();
        $this->label           = new ObjectStorage();
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
     * Get date circa
     *
     * @return string
     */
    public function getDateCirca(): string
    {
        return $this->dateCirca;
    }

    /**
     * Set date circa
     *
     * @param string $dateCirca
     */
    public function setDateCirca(string $dateCirca): void
    {
        $this->dateCirca = $dateCirca;
    }

    /**
     * Get date start
     *
     * @return DateTime
     */
    public function getDateStart(): DateTime
    {
        return $this->dateStart;
    }

    /**
     * Set date start
     *
     * @param DateTime $dateStart
     */
    public function setDateStart(DateTime $dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    /**
     * Get date end
     *
     * @return DateTime
     */
    public function getDateEnd(): DateTime
    {
        return $this->dateEnd;
    }

    /**
     * Set date end
     *
     * @param DateTime $dateEnd
     */
    public function setDateEnd(DateTime $dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * Get location label
     *
     * @return string
     */
    public function getLocationLabel(): string
    {
        return $this->locationLabel;
    }

    /**
     * Set location label
     *
     * @param string $locationLabel
     */
    public function setLocationLabel(string $locationLabel): void
    {
        $this->locationLabel = $locationLabel;
    }

    /**
     * Get location geodata
     *
     * @return ObjectStorage<Feature>
     */
    public function getLocationGeodata(): ObjectStorage
    {
        return $this->locationGeodata;
    }

    /**
     * Set location geodata
     *
     * @param ObjectStorage<Feature> $locationGeodata
     */
    public function setLocationGeodata(ObjectStorage $locationGeodata): void
    {
        $this->locationGeodata = $locationGeodata;
    }

    /**
     * Add location geodata
     *
     * @param Feature $locationGeodata
     */
    public function addLocationGeodata(Feature $locationGeodata): void
    {
        $this->locationGeodata->attach($locationGeodata);
    }

    /**
     * Remove location geodata
     *
     * @param Feature $locationGeodata
     */
    public function removeLocationGeodata(Feature $locationGeodata): void
    {
        $this->locationGeodata->detach($locationGeodata);
    }

    /**
     * Remove all location geodatas
     */
    public function removeAllLocationGeodatas(): void
    {
        $locationGeodata = clone $this->locationGeodata;
        $this->locationGeodata->removeAll($locationGeodata);
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
     * Get source identity
     *
     * @return ObjectStorage<Tag>
     */
    public function getSourceIdentity(): ObjectStorage
    {
        return $this->sourceIdentity;
    }

    /**
     * Set source identity
     *
     * @param ObjectStorage<Tag> $sourceIdentity
     */
    public function setSourceIdentity(ObjectStorage $sourceIdentity): void
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
     * Remove all source identities
     */
    public function removeAllSourceIdentities(): void
    {
        $sourceIdentity = clone $this->sourceIdentity;
        $this->sourceIdentity->removeAll($sourceIdentity);
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
     * @return ObjectStorage<Reference>
     */
    public function getSource(): ObjectStorage
    {
        return $this->source;
    }

    /**
     * Set source
     *
     * @param ObjectStorage<Reference> $source
     */
    public function setSource(ObjectStorage $source): void
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
     * Remove all sources
     */
    public function removeAllSources(): void
    {
        $source = clone $this->source;
        $this->source->removeAll($source);
    }

    /**
     * Get label
     *
     * @return ObjectStorage<Tag>
     */
    public function getLabel(): ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage<Tag> $label
     */
    public function setLabel(ObjectStorage $label): void
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