<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Member
 */
class Member extends AbstractEntity
{
    use HiddenTrait;

    /**
     * List of dictionary entries or senses
     * 
     * @var ObjectStorage<DictionaryEntry|Sense>
     */
    #[Lazy()]
    protected ObjectStorage $ref;

    /**
     * Role in the relation
     * 
     * @var MemberRoleTag|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected MemberRoleTag|LazyLoadingProxy|null $role = null;

    /**
     * Lexicographic relation that this record is a member of
     * 
     * @var LexicographicRelation|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected LexicographicRelation|LazyLoadingProxy|null $parentRelation = null;

    /**
     * Construct object
     *
     * @param DictionaryEntry|Sense $ref
     * @param LexicographicRelation $parentRelation
     * @return Member
     */
    public function __construct(DictionaryEntry|Sense $ref, LexicographicRelation $parentRelation)
    {
        $this->initializeObject();

        $this->addRef($ref);
        $this->setParentRelation($parentRelation);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->ref = new ObjectStorage();
    }

    /**
     * Get ref
     *
     * @return ObjectStorage<DictionaryEntry|Sense>
     */
    public function getRef(): ObjectStorage
    {
        return $this->ref;
    }

    /**
     * Set ref
     *
     * @param ObjectStorage<DictionaryEntry|Sense> $ref
     */
    public function setRef(ObjectStorage $ref): void
    {
        $this->ref = $ref;
    }

    /**
     * Add ref
     *
     * @param DictionaryEntry|Sense $ref
     */
    public function addRef(DictionaryEntry|Sense $ref): void
    {
        $this->ref->attach($ref);
    }

    /**
     * Remove ref
     *
     * @param DictionaryEntry|Sense $ref
     */
    public function removeRef(DictionaryEntry|Sense $ref): void
    {
        $this->ref->detach($ref);
    }

    /**
     * Remove all refs
     */
    public function removeAllRef(): void
    {
        $ref = clone $this->ref;
        $this->ref->removeAll($ref);
    }

    /**
     * Get role
     * 
     * @return MemberRoleTag
     */
    public function getRole(): MemberRoleTag
    {
        if ($this->role instanceof LazyLoadingProxy) {
            $this->role->_loadRealInstance();
        }
        return $this->role;
    }

    /**
     * Set role
     * 
     * @param MemberRoleTag
     */
    public function setRole(MemberRoleTag $role): void
    {
        $this->role = $role;
    }

    /**
     * Get parent relation
     * 
     * @return LexicographicRelation
     */
    public function getParentRelation(): LexicographicRelation
    {
        if ($this->parentRelation instanceof LazyLoadingProxy) {
            $this->parentRelation->_loadRealInstance();
        }
        return $this->parentRelation;
    }

    /**
     * Set parent relation
     * 
     * @param LexicographicRelation
     */
    public function setParentRelation(LexicographicRelation $parentRelation): void
    {
        $this->parentRelation = $parentRelation;
    }
}
