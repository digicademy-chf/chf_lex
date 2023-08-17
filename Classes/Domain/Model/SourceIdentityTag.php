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
 * Model for source-identity tags
 */
class SourceIdentityTag extends AbstractTag
{
    /**
     * List of frequencies with this source identity
     * 
     * @var ObjectStorage<Frequency>
     */
    #[Lazy()]
    protected ObjectStorage $asSourceIdentityOfFrequency;

    /**
     * List of examples with this source identity
     * 
     * @var ObjectStorage<Example>
     */
    #[Lazy()]
    protected ObjectStorage $asSourceIdentityOfExample;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return SourceIdentityTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('sourceIdentity');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asSourceIdentityOfFrequency = new ObjectStorage();
        $this->asSourceIdentityOfExample   = new ObjectStorage();
    }

    /**
     * Get as source identity of frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getAsSourceIdentityOfFrequency(): ObjectStorage
    {
        return $this->asSourceIdentityOfFrequency;
    }

    /**
     * Set as source identity of frequency
     *
     * @param ObjectStorage<Frequency> $asSourceIdentityOfFrequency
     */
    public function setAsSourceIdentityOfFrequency(ObjectStorage $asSourceIdentityOfFrequency): void
    {
        $this->asSourceIdentityOfFrequency = $asSourceIdentityOfFrequency;
    }

    /**
     * Add as source identity of frequency
     *
     * @param Frequency $asSourceIdentityOfFrequency
     */
    public function addAsSourceIdentityOfFrequency(Frequency $asSourceIdentityOfFrequency): void
    {
        $this->asSourceIdentityOfFrequency->attach($asSourceIdentityOfFrequency);
    }

    /**
     * Remove as source identity of frequency
     *
     * @param Frequency $asSourceIdentityOfFrequency
     */
    public function removeAsSourceIdentityOfFrequency(Frequency $asSourceIdentityOfFrequency): void
    {
        $this->asSourceIdentityOfFrequency->detach($asSourceIdentityOfFrequency);
    }

    /**
     * Remove all as source identity of frequencies
     */
    public function removeAllAsSourceIdentityOfFrequencies(): void
    {
        $asSourceIdentityOfFrequency = clone $this->asSourceIdentityOfFrequency;
        $this->asSourceIdentityOfFrequency->removeAll($asSourceIdentityOfFrequency);
    }

    /**
     * Get as source identity of example
     *
     * @return ObjectStorage<Example>
     */
    public function getAsSourceIdentityOfExample(): ObjectStorage
    {
        return $this->asSourceIdentityOfExample;
    }

    /**
     * Set as source identity of example
     *
     * @param ObjectStorage<Example> $asSourceIdentityOfExample
     */
    public function setAsSourceIdentityOfExample(ObjectStorage $asSourceIdentityOfExample): void
    {
        $this->asSourceIdentityOfExample = $asSourceIdentityOfExample;
    }

    /**
     * Add as source identity of example
     *
     * @param Example $asSourceIdentityOfExample
     */
    public function addAsSourceIdentityOfExample(Example $asSourceIdentityOfExample): void
    {
        $this->asSourceIdentityOfExample->attach($asSourceIdentityOfExample);
    }

    /**
     * Remove as source identity of example
     *
     * @param Example $asSourceIdentityOfExample
     */
    public function removeAsSourceIdentityOfExample(Example $asSourceIdentityOfExample): void
    {
        $this->asSourceIdentityOfExample->detach($asSourceIdentityOfExample);
    }

    /**
     * Remove all as source identity of examples
     */
    public function removeAllAsSourceIdentityOfExamples(): void
    {
        $asSourceIdentityOfExample = clone $this->asSourceIdentityOfExample;
        $this->asSourceIdentityOfExample->removeAll($asSourceIdentityOfExample);
    }
}

?>