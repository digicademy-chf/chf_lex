<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractTag;

defined('TYPO3') or die();

/**
 * Model for InflectionTypeTag
 */
class InflectionTypeTag extends AbstractTag
{
    /**
     * Constraints and recommendations on where this inflection type may apply
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $for = '';

    /**
     * List of inflected forms that use this inflection type
     * 
     * @var ?ObjectStorage<InflectedForm>
     */
    #[Lazy()]
    protected ?ObjectStorage $asInflectionTypeOfInflectedForm;

    /**
     * Construct object
     *
     * @param string $text
     * @param LexicographicResource $parentResource
     * @return InflectionTypeTag
     */
    public function __construct(string $text, LexicographicResource $parentResource)
    {
        parent::__construct($text, $parentResource);
        $this->initializeObject();

        $this->setType('inflectionTypeTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->asInflectionTypeOfInflectedForm ??= new ObjectStorage();
    }

    /**
     * Get for
     *
     * @return string
     */
    public function getFor(): string
    {
        return $this->for;
    }

    /**
     * Set for
     *
     * @param string $for
     */
    public function setFor(string $for): void
    {
        $this->for = $for;
    }

    /**
     * Get as inflection type of inflected form
     *
     * @return ObjectStorage<InflectedForm>
     */
    public function getAsInflectionTypeOfInflectedForm(): ?ObjectStorage
    {
        return $this->asInflectionTypeOfInflectedForm;
    }

    /**
     * Set as inflection type of inflected form
     *
     * @param ObjectStorage<InflectedForm> $asInflectionTypeOfInflectedForm
     */
    public function setAsInflectionTypeOfInflectedForm(ObjectStorage $asInflectionTypeOfInflectedForm): void
    {
        $this->asInflectionTypeOfInflectedForm = $asInflectionTypeOfInflectedForm;
    }

    /**
     * Add as inflection type of inflected form
     *
     * @param InflectedForm $asInflectionTypeOfInflectedForm
     */
    public function addAsInflectionTypeOfInflectedForm(InflectedForm $asInflectionTypeOfInflectedForm): void
    {
        $this->asInflectionTypeOfInflectedForm?->attach($asInflectionTypeOfInflectedForm);
    }

    /**
     * Remove as inflection type of inflected form
     *
     * @param InflectedForm $asInflectionTypeOfInflectedForm
     */
    public function removeAsInflectionTypeOfInflectedForm(InflectedForm $asInflectionTypeOfInflectedForm): void
    {
        $this->asInflectionTypeOfInflectedForm?->detach($asInflectionTypeOfInflectedForm);
    }

    /**
     * Remove all as inflection type of inflected forms
     */
    public function removeAllAsInflectionTypeOfInflectedForm(): void
    {
        $asInflectionTypeOfInflectedForm = clone $this->asInflectionTypeOfInflectedForm;
        $this->asInflectionTypeOfInflectedForm->removeAll($asInflectionTypeOfInflectedForm);
    }
}
