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
 * Model for Definition
 */
class Definition extends AbstractEntity
{
    use HiddenTrait;
    use ParentResourceTrait;

    /**
     * May be used to differentiate between different tiers of definitions
     * 
     * @var DefinitionTypeTag|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected DefinitionTypeTag|LazyLoadingProxy|null $definitionType = null;

    /**
     * Definition of the sense
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $text = '';

    /**
     * Sense that this definition belongs to
     * 
     * @var Sense|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Sense|LazyLoadingProxy|null $parentSense = null;

    /**
     * Construct object
     *
     * @param string $text
     * @param Sense $parentSense
     * @return Definition
     */
    public function __construct(string $text, Sense $parentSense)
    {
        $this->initializeObject();

        $this->setText($text);
        $this->setParentSense($parentSense);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentResource ??= new ObjectStorage();
    }

    /**
     * Get definition type
     * 
     * @return DefinitionTypeTag
     */
    public function getDefinitionType(): DefinitionTypeTag
    {
        if ($this->definitionType instanceof LazyLoadingProxy) {
            $this->definitionType->_loadRealInstance();
        }
        return $this->definitionType;
    }

    /**
     * Set definition type
     * 
     * @param DefinitionTypeTag
     */
    public function setDefinitionType(DefinitionTypeTag $definitionType): void
    {
        $this->definitionType = $definitionType;
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
     * Get parent sense
     * 
     * @return Sense
     */
    public function getParentSense(): Sense
    {
        if ($this->parentSense instanceof LazyLoadingProxy) {
            $this->parentSense->_loadRealInstance();
        }
        return $this->parentSense;
    }

    /**
     * Set parent sense
     * 
     * @param Sense
     */
    public function setParentSense(Sense $parentSense): void
    {
        $this->parentSense = $parentSense;
    }
}
