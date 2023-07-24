<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for members
 */
class Member extends AbstractEntity
{
    #[Lazy()]
    /**
     * Role in this relation
     * 
     * @var ObjectStorage<Tag>
     */
    protected $role;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Selection of entries or senses as members of this relation
     * 
     * @var ObjectStorage<Entry|Sense>
     */
    protected $entryOrSense;

    /**
     * Initialize object
     *
     * @return Member
     */
    public function __construct()
    {
        $this->role         = new ObjectStorage();
        $this->entryOrSense = new ObjectStorage();
    }

    /**
     * Get role
     *
     * @return ObjectStorage|null
     */
    public function getRole(): ?ObjectStorage
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param ObjectStorage $role
     */
    public function setRole($role): void
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
     * Get entry or sense
     *
     * @return ObjectStorage|null
     */
    public function getEntryOrSense(): ?ObjectStorage
    {
        return $this->entryOrSense;
    }

    /**
     * Set entry or sense
     *
     * @param ObjectStorage $entryOrSense
     */
    public function setEntryOrSense($entryOrSense): void
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
}

?>