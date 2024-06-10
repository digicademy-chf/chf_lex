<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for glossary entries
 */
class GlossaryEntry extends AbstractEntry
{
    /**
     * Name of the entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'minimum' => 1,
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

    /**
     * List of comma-separated strings to link to this glossary entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $annotateStrings = '';

    /**
     * Content blocks that make up the content of this entry
     * 
     * @var ObjectStorage<Content>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $contentElements;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $title
     * @return GlossaryEntry
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $title)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setType('glossaryEntry');
        $this->setTitle($title);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->contentElements = new ObjectStorage();
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get annotate strings
     *
     * @return string
     */
    public function getAnnotateStrings(): string
    {
        return $this->annotateStrings;
    }

    /**
     * Set annotate strings
     *
     * @param string $annotateStrings
     */
    public function setAnnotateStrings(string $annotateStrings): void
    {
        $this->annotateStrings = $annotateStrings;
    }

    /**
     * Get content elements
     *
     * @return ObjectStorage<Content>
     */
    public function getContentElements(): ObjectStorage
    {
        return $this->contentElements;
    }

    /**
     * Set content elements
     *
     * @param ObjectStorage<Content> $contentElements
     */
    public function setContentElements(ObjectStorage $contentElements): void
    {
        $this->contentElements = $contentElements;
    }

    /**
     * Add content elements
     *
     * @param Content $contentElements
     */
    public function addContentElements(Content $contentElements): void
    {
        $this->contentElements->attach($contentElements);
    }

    /**
     * Remove content elements
     *
     * @param Content $contentElements
     */
    public function removeContentElements(Content $contentElements): void
    {
        $this->contentElements->detach($contentElements);
    }

    /**
     * Remove all content elements
     */
    public function removeAllContentElements(): void
    {
        $contentElements = clone $this->contentElements;
        $this->contentElements->removeAll($contentElements);
    }
}
