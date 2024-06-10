<?php
defined('TYPO3') or die();
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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for members
 */
class Member extends AbstractEntity
{
    /**
     * Whether the record should be visisible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = false;

    /**
     * Relation that this member is attached to
     * 
     * @var LazyLoadingProxy|Relation
     */
    #[Lazy()]
    protected LazyLoadingProxy|Relation $parent_id;

    /**
     * Role in this relation
     * 
     * @var ObjectStorage<MemberRoleTag>
     */
    #[Lazy()]
    protected ObjectStorage $role;

    /**
     * Selection of entries or senses as members of this relation
     * 
     * @var ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry|Sense>
     */
    #[Lazy()]
    protected ObjectStorage $entryOrSense;

    /**
     * Construct object
     *
     * @param Relation $parent_id
     * @param Entry|EncyclopediaEntry|GlossaryEntry|Sense $entryOrSense
     * @return Member
     */
    public function __construct(Relation $parent_id, Entry|EncyclopediaEntry|GlossaryEntry|Sense $entryOrSense)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->addEntryOrSense($entryOrSense);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->role         = new ObjectStorage();
        $this->entryOrSense = new ObjectStorage();
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
     * Get parent ID
     * 
     * @return Relation
     */
    public function getParentId(): Relation
    {
        if ($this->parent_id instanceof LazyLoadingProxy) {
            $this->parent_id->_loadRealInstance();
        }
        return $this->parent_id;
    }

    /**
     * Set parent ID
     * 
     * @param Relation $parent_id
     */
    public function setParentId(Relation $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * Get role
     *
     * @return ObjectStorage<MemberRoleTag>
     */
    public function getRole(): ObjectStorage
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
        $this->role->attach($role);
    }

    /**
     * Remove role
     *
     * @param MemberRoleTag $role
     */
    public function removeRole(MemberRoleTag $role): void
    {
        $this->role->detach($role);
    }

    /**
     * Remove all roles
     */
    public function removeAllRoles(): void
    {
        $role = clone $this->role;
        $this->role->removeAll($role);
    }

    /**
     * Get entry or sense
     *
     * @return ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry|Sense>
     */
    public function getEntryOrSense(): ObjectStorage
    {
        return $this->entryOrSense;
    }

    /**
     * Set entry or sense
     *
     * @param ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry|Sense> $entryOrSense
     */
    public function setEntryOrSense(ObjectStorage $entryOrSense): void
    {
        $this->entryOrSense = $entryOrSense;
    }

    /**
     * Add entry or sense
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry|Sense $entryOrSense
     */
    public function addEntryOrSense(Entry|EncyclopediaEntry|GlossaryEntry|Sense $entryOrSense): void
    {
        $this->entryOrSense->attach($entryOrSense);
    }

    /**
     * Remove entry or sense
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry|Sense $entryOrSense
     */
    public function removeEntryOrSense(Entry|EncyclopediaEntry|GlossaryEntry|Sense $entryOrSense): void
    {
        $this->entryOrSense->detach($entryOrSense);
    }

    /**
     * Remove all entries or senses
     */
    public function removeAllEntriesOrSenses(): void
    {
        $entryOrSense = clone $this->entryOrSense;
        $this->entryOrSense->removeAll($entryOrSense);
    }

    /**
     * Get member ID (alias of entryOrSense for DMLex conformity)
     *
     * @return ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry|Sense>
     */
    public function getMemberID(): ObjectStorage
    {
        return $this->getEntryOrSense();
    }

    /**
     * Set member ID (alias of entryOrSense for DMLex conformity)
     *
     * @param ObjectStorage<Entry|EncyclopediaEntry|GlossaryEntry|Sense> $memberID
     */
    public function setMemberID(ObjectStorage $memberID): void
    {
        $this->setEntryOrSense($memberID);
    }

    /**
     * Add member ID (alias of entryOrSense for DMLex conformity)
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry|Sense $memberID
     */
    public function addMemberID(Entry|EncyclopediaEntry|GlossaryEntry|Sense $memberID): void
    {
        $this->addEntryOrSense($memberID);
    }

    /**
     * Remove member ID (alias of entryOrSense for DMLex conformity)
     *
     * @param Entry|EncyclopediaEntry|GlossaryEntry|Sense $memberID
     */
    public function removeMemberID(Entry|EncyclopediaEntry|GlossaryEntry|Sense $memberID): void
    {
        $this->removeEntryOrSense($memberID);
    }

    /**
     * Remove member ID (alias of entryOrSense for DMLex conformity)
     */
    public function removeAllMemberIDs(): void
    {
        $this->removeAllEntriesOrSenses();
    }
}
