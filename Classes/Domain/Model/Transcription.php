<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for transcriptions
 */
class Transcription extends AbstractEntity
{
    /**
     * Transcribed version of the pronunciation
     * 
     * @var string
     */
    protected string $text = '';

    #[Lazy()]
    /**
     * Transcription scheme used here
     * 
     * @var ObjectStorage<Tag>
     */
    protected $schema;

    /**
     * Initialize object
     *
     * @return Transcription
     */
    public function __construct()
    {
        $this->schema = new ObjectStorage();
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
     * Get schema
     *
     * @return ObjectStorage|null
     */
    public function getSchema(): ?ObjectStorage
    {
        return $this->schema;
    }

    /**
     * Set schema
     *
     * @param ObjectStorage $schema
     */
    public function setSchema($schema): void
    {
        $this->schema = $schema;
    }

    /**
     * Add schema
     *
     * @param Tag $schema
     */
    public function addSchema(Tag $schema): void
    {
        $this->schema->attach($schema);
    }

    /**
     * Remove schema
     *
     * @param Tag $schema
     */
    public function removeSchema(Tag $schema): void
    {
        $this->schema->detach($schema);
    }
}

?>