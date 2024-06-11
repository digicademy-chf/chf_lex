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
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Member
 */
class Member extends AbstractEntity
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
     * Lexicographic relation that this record is a member of
     * 
     * @var LexicographicRelation|LazyLoadingProxy
     */
    #[Lazy()]
    protected LexicographicRelation|LazyLoadingProxy $parentRelation;

    /**
     * Role in the relation
     * 
     * @var ?ObjectStorage<MemberRoleTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $role = null;

    /**
     * List of dictionary entries or senses as members of the lexicographic relation
     * 
     * @var ?ObjectStorage<DictionaryEntry|Sense>
     */
    #[Lazy()]
    protected ?ObjectStorage $ref = null;

    /**
     * Construct object
     *
     * @param LexicographicRelation $parentRelation
     * @param DictionaryEntry|Sense $ref
     * @return Member
     */
    public function __construct(LexicographicRelation $parentRelation, DictionaryEntry|Sense $ref)
    {
        $this->initializeObject();

        $this->setParentRelation($parentRelation);
        $this->addRef($ref);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentRelation = new LazyLoadingProxy();
        $this->role ??= new ObjectStorage();
        $this->ref ??= new ObjectStorage();
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

    /**
     * Get role
     *
     * @return ObjectStorage<MemberRoleTag>
     */
    public function getRole(): ?ObjectStorage
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param ObjectStorage<MemberRoleTag> $role
     */
    public function setRole(ObjectStorage $role): void
    {
        $this->role = $role;
    }

    /**
     * Add role
     *
     * @param MemberRoleTag $role
     */
    public function addRole(MemberRoleTag $role): void
    {
        $this->role?->attach($role);
    }

    /**
     * Remove role
     *
     * @param MemberRoleTag $role
     */
    public function removeRole(MemberRoleTag $role): void
    {
        $this->role?->detach($role);
    }

    /**
     * Remove all roles
     */
    public function removeAllRole(): void
    {
        $role = clone $this->role;
        $this->role->removeAll($role);
    }

    /**
     * Get ref
     *
     * @return ObjectStorage<DictionaryEntry|Sense>
     */
    public function getRef(): ?ObjectStorage
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
        $this->ref?->attach($ref);
    }

    /**
     * Remove ref
     *
     * @param DictionaryEntry|Sense $ref
     */
    public function removeRef(DictionaryEntry|Sense $ref): void
    {
        $this->ref?->detach($ref);
    }

    /**
     * Remove all refs
     */
    public function removeAllRef(): void
    {
        $ref = clone $this->ref;
        $this->ref->removeAll($ref);
    }
}
