<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for frequency-type tags
 */
class FrequencyTypeTag extends AbstractTag
{
    /**
     * List of frequencies of this type
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    protected ObjectStorage $asTypeOfFrequency;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return FrequencyTypeTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('frequencyType');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asTypeOfFrequency = new ObjectStorage();
    }

    /**
     * Get as type of frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getAsTypeOfFrequency(): ObjectStorage
    {
        return $this->asTypeOfFrequency;
    }

    /**
     * Set as type of frequency
     *
     * @param ObjectStorage<Frequency> $asTypeOfFrequency
     */
    public function setAsTypeOfFrequency(ObjectStorage $asTypeOfFrequency): void
    {
        $this->asTypeOfFrequency = $asTypeOfFrequency;
    }

    /**
     * Add as type of frequency
     *
     * @param Frequency $asTypeOfFrequency
     */
    public function addAsTypeOfFrequency(Frequency $asTypeOfFrequency): void
    {
        $this->asTypeOfFrequency->attach($asTypeOfFrequency);
    }

    /**
     * Remove as type of frequency
     *
     * @param Frequency $asTypeOfFrequency
     */
    public function removeAsTypeOfFrequency(Frequency $asTypeOfFrequency): void
    {
        $this->asTypeOfFrequency->detach($asTypeOfFrequency);
    }

    /**
     * Remove all as type of frequencies
     */
    public function removeAllAsTypeOfFrequencies(): void
    {
        $asTypeOfFrequency = clone $this->asTypeOfFrequency;
        $this->asTypeOfFrequency->removeAll($asTypeOfFrequency);
    }
}

?>