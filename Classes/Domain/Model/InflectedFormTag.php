<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for inflected form tags
 */
class InflectedFormTag extends AbstractTag
{
    /**
     * List of parts of speech that this tag may be used for
     * 
     * @var ObjectStorage<PartOfSpeechTag>
     */
    #[Lazy()]
    protected ObjectStorage $forPartOfSpeech;

    /**
     * List of inflected forms of this type
     * 
     * @var ObjectStorage<InflectedForm>
     */
    #[Lazy()]
    protected ObjectStorage $asTypeOfInflectedForm;


    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return InflectedFormTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('inflectedForm');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->forPartOfSpeech       = new ObjectStorage();
        $this->asTypeOfInflectedForm = new ObjectStorage();
    }

    /**
     * Get for part of speech
     *
     * @return ObjectStorage<PartOfSpeechTag>
     */
    public function getForPartOfSpeech(): ObjectStorage
    {
        return $this->forPartOfSpeech;
    }

    /**
     * Set for part of speech
     *
     * @param ObjectStorage<PartOfSpeechTag> $forPartOfSpeech
     */
    public function setForPartOfSpeech(ObjectStorage $forPartOfSpeech): void
    {
        $this->forPartOfSpeech = $forPartOfSpeech;
    }

    /**
     * Add for part of speech
     *
     * @param PartOfSpeechTag $forPartOfSpeech
     */
    public function addForPartOfSpeech(PartOfSpeechTag $forPartOfSpeech): void
    {
        $this->forPartOfSpeech->attach($forPartOfSpeech);
    }

    /**
     * Remove for part of speech
     *
     * @param PartOfSpeechTag $forPartOfSpeech
     */
    public function removeForPartOfSpeech(PartOfSpeechTag $forPartOfSpeech): void
    {
        $this->forPartOfSpeech->detach($forPartOfSpeech);
    }

    /**
     * Remove all for part of speeches
     */
    public function removeAllForPartOfSpeeches(): void
    {
        $forPartOfSpeech = clone $this->forPartOfSpeech;
        $this->forPartOfSpeech->removeAll($forPartOfSpeech);
    }

    /**
     * Get as type of inflected form
     *
     * @return ObjectStorage<InflectedForm>
     */
    public function getAsTypeOfInflectedForm(): ObjectStorage
    {
        return $this->asTypeOfInflectedForm;
    }

    /**
     * Set as type of inflected form
     *
     * @param ObjectStorage<InflectedForm> $asTypeOfInflectedForm
     */
    public function setAsTypeOfInflectedForm(ObjectStorage $asTypeOfInflectedForm): void
    {
        $this->asTypeOfInflectedForm = $asTypeOfInflectedForm;
    }

    /**
     * Add as type of inflected form
     *
     * @param InflectedForm $asTypeOfInflectedForm
     */
    public function addAsTypeOfInflectedForm(InflectedForm $asTypeOfInflectedForm): void
    {
        $this->asTypeOfInflectedForm->attach($asTypeOfInflectedForm);
    }

    /**
     * Remove as type of inflected form
     *
     * @param InflectedForm $asTypeOfInflectedForm
     */
    public function removeAsTypeOfInflectedForm(InflectedForm $asTypeOfInflectedForm): void
    {
        $this->asTypeOfInflectedForm->detach($asTypeOfInflectedForm);
    }

    /**
     * Remove all as type of inflected forms
     */
    public function removeAllAsTypeOfInflectedForms(): void
    {
        $asTypeOfInflectedForm = clone $this->asTypeOfInflectedForm;
        $this->asTypeOfInflectedForm->removeAll($asTypeOfInflectedForm);
    }

}

?>