<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractResource;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;

defined('TYPO3') or die();

/**
 * Model for LexicographicResource
 */
class LexicographicResource extends AbstractResource
{
    /**
     * Glossary of this resource
     * 
     * @var GlossaryResource|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected GlossaryResource|LazyLoadingProxy|null $glossary = null;

    /**
     * List of all dictionary entries compiled in this resource
     * 
     * @var ?ObjectStorage<DictionaryEntry>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allDictionaryEntries = null;

    /**
     * List of all encyclopedia entries compiled in this resource
     * 
     * @var ?ObjectStorage<EncyclopediaEntry>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allEncyclopediaEntries = null;

    /**
     * Construct object
     *
     * @param string $langCode
     * @param string $uuid
     * @return LexicographicResource
     */
    public function __construct(string $langCode, string $uuid)
    {
        parent::__construct($langCode, $uuid);
        $this->initializeObject();

        $this->setType('lexicographicResource');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->allDictionaryEntries ??= new ObjectStorage();
        $this->allEncyclopediaEntries ??= new ObjectStorage();
    }

    /**
     * Get glossary
     * 
     * @return GlossaryResource
     */
    public function getGlossary(): GlossaryResource
    {
        if ($this->glossary instanceof LazyLoadingProxy) {
            $this->glossary->_loadRealInstance();
        }
        return $this->glossary;
    }

    /**
     * Set glossary
     * 
     * @param GlossaryResource
     */
    public function setGlossary(GlossaryResource $glossary): void
    {
        $this->glossary = $glossary;
    }

    /**
     * Get all dictionary entries
     *
     * @return ObjectStorage<DictionaryEntry>
     */
    public function getAllDictionaryEntries(): ?ObjectStorage
    {
        return $this->allDictionaryEntries;
    }

    /**
     * Set all dictionary entries
     *
     * @param ObjectStorage<DictionaryEntry> $allDictionaryEntries
     */
    public function setAllDictionaryEntries(ObjectStorage $allDictionaryEntries): void
    {
        $this->allDictionaryEntries = $allDictionaryEntries;
    }

    /**
     * Add all dictionary entries
     *
     * @param DictionaryEntry $allDictionaryEntries
     */
    public function addAllDictionaryEntries(DictionaryEntry $allDictionaryEntries): void
    {
        $this->allDictionaryEntries?->attach($allDictionaryEntries);
    }

    /**
     * Remove all dictionary entries
     *
     * @param DictionaryEntry $allDictionaryEntries
     */
    public function removeAllDictionaryEntries(DictionaryEntry $allDictionaryEntries): void
    {
        $this->allDictionaryEntries?->detach($allDictionaryEntries);
    }

    /**
     * Remove all all dictionary entries
     */
    public function removeAllAllDictionaryEntries(): void
    {
        $allDictionaryEntries = clone $this->allDictionaryEntries;
        $this->allDictionaryEntries->removeAll($allDictionaryEntries);
    }

    /**
     * Get all encyclopedia entries
     *
     * @return ObjectStorage<EncyclopediaEntry>
     */
    public function getAllEncyclopediaEntries(): ?ObjectStorage
    {
        return $this->allEncyclopediaEntries;
    }

    /**
     * Set all encyclopedia entries
     *
     * @param ObjectStorage<EncyclopediaEntry> $allEncyclopediaEntries
     */
    public function setAllEncyclopediaEntries(ObjectStorage $allEncyclopediaEntries): void
    {
        $this->allEncyclopediaEntries = $allEncyclopediaEntries;
    }

    /**
     * Add all encyclopedia entries
     *
     * @param EncyclopediaEntry $allEncyclopediaEntries
     */
    public function addAllEncyclopediaEntries(EncyclopediaEntry $allEncyclopediaEntries): void
    {
        $this->allEncyclopediaEntries?->attach($allEncyclopediaEntries);
    }

    /**
     * Remove all encyclopedia entries
     *
     * @param EncyclopediaEntry $allEncyclopediaEntries
     */
    public function removeAllEncyclopediaEntries(EncyclopediaEntry $allEncyclopediaEntries): void
    {
        $this->allEncyclopediaEntries?->detach($allEncyclopediaEntries);
    }

    /**
     * Remove all all encyclopedia entries
     */
    public function removeAllAllEncyclopediaEntries(): void
    {
        $allEncyclopediaEntries = clone $this->allEncyclopediaEntries;
        $this->allEncyclopediaEntries->removeAll($allEncyclopediaEntries);
    }
}
