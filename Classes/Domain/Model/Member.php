<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for members
 */
class Member extends AbstractEntity
{
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
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $role;

    /**
     * Selection of entries or senses as members of this relation
     * 
     * @var ObjectStorage<Entry|Sense>
     */
    #[Lazy()]
    protected ObjectStorage $entryOrSense;

    /**
     * Construct object
     *
     * @param Relation $parent_id
     * @param Entry|Sense $entryOrSense
     * @return Member
     */
    public function __construct(Relation $parent_id, Entry|Sense $entryOrSense)
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
     * @return ObjectStorage<Tag>
     */
    public function getRole(): ObjectStorage
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param ObjectStorage<Tag> $role
     */
    public function setRole(ObjectStorage $role): void
    {
        $this->role = $role;
    }

    /**
     * Add role
     *
     * @param Tag $role
     */
    public function addRole(Tag $role): void
    {
        $this->role->attach($role);
    }

    /**
     * Remove role
     *
     * @param Tag $role
     */
    public function removeRole(Tag $role): void
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
     * @return ObjectStorage<Entry|Sense>
     */
    public function getEntryOrSense(): ObjectStorage
    {
        return $this->entryOrSense;
    }

    /**
     * Set entry or sense
     *
     * @param ObjectStorage<Entry|Sense> $entryOrSense
     */
    public function setEntryOrSense(ObjectStorage $entryOrSense): void
    {
        $this->entryOrSense = $entryOrSense;
    }

    /**
     * Add entry or sense
     *
     * @param Entry|Sense $entryOrSense
     */
    public function addEntryOrSense(Entry|Sense $entryOrSense): void
    {
        $this->entryOrSense->attach($entryOrSense);
    }

    /**
     * Remove entry or sense
     *
     * @param Entry|Sense $entryOrSense
     */
    public function removeEntryOrSense(Entry|Sense $entryOrSense): void
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
}

?>