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
 * Model for relations
 */
class Relation extends AbstractEntity
{
    #[Lazy()]
    /**
     * Specifies the type of relation
     * 
     * @var ObjectStorage<Tag>
     */
    protected $type;

    /**
     * Explanation of this relation
     * 
     * @var string
     */
    protected string $description = '';

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * List of members in this relation
     * 
     * @var ObjectStorage<Member>
     */
    protected $member;

    /**
     * Initialize object
     *
     * @return Relation
     */
    public function __construct()
    {
        $this->type   = new ObjectStorage();
        $this->member = new ObjectStorage();
    }

    /**
     * Get type
     *
     * @return ObjectStorage|null
     */
    public function getType(): ?ObjectStorage
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param ObjectStorage $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * Add type
     *
     * @param Tag $type
     */
    public function addType(Tag $type): void
    {
        $this->type->attach($type);
    }

    /**
     * Remove type
     *
     * @param Tag $type
     */
    public function removeType(Tag $type): void
    {
        $this->type->detach($type);
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get member
     *
     * @return ObjectStorage|null
     */
    public function getMember(): ?ObjectStorage
    {
        return $this->member;
    }

    /**
     * Set member
     *
     * @param ObjectStorage $member
     */
    public function setMember($member): void
    {
        $this->member = $member;
    }

    /**
     * Add member
     *
     * @param Member $member
     */
    public function addMember(Member $member): void
    {
        $this->member->attach($member);
    }

    /**
     * Remove member
     *
     * @param Member $member
     */
    public function removeMember(Member $member): void
    {
        $this->member->detach($member);
    }
}

?>