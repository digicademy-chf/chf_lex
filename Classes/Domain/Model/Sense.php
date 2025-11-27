<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\IriTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LabelTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use Digicademy\CHFBase\Domain\Model\Traits\SameAsTrait;
use Digicademy\CHFBase\Domain\Model\Traits\UuidTrait;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Sense
 */
class Sense extends AbstractEntity
{
    use HiddenTrait;
    use IriTrait;
    use LabelTrait;
    use ParentResourceTrait;
    use SameAsTrait;
    use UuidTrait;

    /**
     * Specific description of the sense
     * 
     * @var ObjectStorage<Definition>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $definition;

    /**
     * Brief note differentiating this sense from the others
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $indicator = '';

    /**
     * List of contemporary or historical examples of this sense
     * 
     * @var ObjectStorage<Example>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $example;

    /**
     * List of domestic and foreign frequency data
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $frequency;

    /**
     * Dictionary entry that this sense belongs to
     * 
     * @var DictionaryEntry|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected DictionaryEntry|LazyLoadingProxy|null $parentEntry = null;

    /**
     * Construct object
     *
     * @param DictionaryEntry $parentEntry
     * @return Sense
     */
    public function __construct(DictionaryEntry $parentEntry)
    {
        $this->initializeObject();

        $this->setParentEntry($parentEntry);
        $this->setIri('se');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->definition = new ObjectStorage();
        $this->label = new ObjectStorage();
        $this->example = new ObjectStorage();
        $this->frequency = new ObjectStorage();
        $this->parentResource = new ObjectStorage();
        $this->sameAs = new ObjectStorage();
    }

    /**
     * Get definition
     *
     * @return ObjectStorage<Definition>
     */
    public function getDefinition(): ObjectStorage
    {
        return $this->definition;
    }

    /**
     * Set definition
     *
     * @param ObjectStorage<Definition> $definition
     */
    public function setDefinition(ObjectStorage $definition): void
    {
        $this->definition = $definition;
    }

    /**
     * Add definition
     *
     * @param Definition $definition
     */
    public function addDefinition(Definition $definition): void
    {
        $this->definition->attach($definition);
    }

    /**
     * Remove definition
     *
     * @param Definition $definition
     */
    public function removeDefinition(Definition $definition): void
    {
        $this->definition->detach($definition);
    }

    /**
     * Remove all definitions
     */
    public function removeAllDefinition(): void
    {
        $definition = clone $this->definition;
        $this->definition->removeAll($definition);
    }

    /**
     * Get indicator
     *
     * @return string
     */
    public function getIndicator(): string
    {
        return $this->indicator;
    }

    /**
     * Set indicator
     *
     * @param string $indicator
     */
    public function setIndicator(string $indicator): void
    {
        $this->indicator = $indicator;
    }

    /**
     * Get example
     *
     * @return ObjectStorage<Example>
     */
    public function getExample(): ObjectStorage
    {
        return $this->example;
    }

    /**
     * Set example
     *
     * @param ObjectStorage<Example> $example
     */
    public function setExample(ObjectStorage $example): void
    {
        $this->example = $example;
    }

    /**
     * Add example
     *
     * @param Example $example
     */
    public function addExample(Example $example): void
    {
        $this->example->attach($example);
    }

    /**
     * Remove example
     *
     * @param Example $example
     */
    public function removeExample(Example $example): void
    {
        $this->example->detach($example);
    }

    /**
     * Remove all examples
     */
    public function removeAllExample(): void
    {
        $example = clone $this->example;
        $this->example->removeAll($example);
    }

    /**
     * Get frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getFrequency(): ObjectStorage
    {
        return $this->frequency;
    }

    /**
     * Set frequency
     *
     * @param ObjectStorage<Frequency> $frequency
     */
    public function setFrequency(ObjectStorage $frequency): void
    {
        $this->frequency = $frequency;
    }

    /**
     * Add frequency
     *
     * @param Frequency $frequency
     */
    public function addFrequency(Frequency $frequency): void
    {
        $this->frequency->attach($frequency);
    }

    /**
     * Remove frequency
     *
     * @param Frequency $frequency
     */
    public function removeFrequency(Frequency $frequency): void
    {
        $this->frequency->detach($frequency);
    }

    /**
     * Remove all frequencies
     */
    public function removeAllFrequency(): void
    {
        $frequency = clone $this->frequency;
        $this->frequency->removeAll($frequency);
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
