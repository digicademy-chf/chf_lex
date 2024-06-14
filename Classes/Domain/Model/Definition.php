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
 * Model for Definition
 */
class Definition extends AbstractEntity
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
     * Sense that this definition belongs to
     * 
     * @var Sense|LazyLoadingProxy
     */
    #[Lazy()]
    protected Sense|LazyLoadingProxy $parentSense;

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
     * May be used to differentiate between different tiers of definitions
     * 
     * @var DefinitionTypeTag|LazyLoadingProxy
     */
    #[Lazy()]
    protected DefinitionTypeTag|LazyLoadingProxy $definitionType;

    /**
     * Construct object
     *
     * @param Sense $parentSense
     * @param string $text
     * @return Definition
     */
    public function __construct(Sense $parentSense, string $text)
    {
        $this->initializeObject();

        $this->setParentSense($parentSense);
        $this->setText($text);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentSense = new LazyLoadingProxy();
        $this->definitionType = new LazyLoadingProxy();
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
}
