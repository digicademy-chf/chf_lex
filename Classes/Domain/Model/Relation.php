<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for relations
 */
class Relation extends AbstractEntity
{
    /**
     * Resource that this relation is attached to
     * 
     * @var LazyLoadingProxy|LexicographicResource
     */
    #[Lazy()]
    protected LazyLoadingProxy|LexicographicResource $parent_id;

    /**
     * Specifies the type of relation
     * 
     * @var ObjectStorage<RelationTypeTag>
     */
    #[Lazy()]
    protected ObjectStorage $type;

    /**
     * Explanation of this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 2000,
        ],
    ])]
    protected string $description = '';

    /**
     * List of members in this relation
     * 
     * @var ObjectStorage<Member>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $member;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param RelationTypeTag $type
     * @param Member $member
     * @return Relation
     */
    public function __construct(LexicographicResource $parent_id, RelationTypeTag $type, Member $member)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->addType($type);
        $this->addMember($member);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->type   = new ObjectStorage();
        $this->member = new ObjectStorage();
    }

    /**
     * Get parent ID
     * 
     * @return LexicographicResource
     */
    public function getParentId(): LexicographicResource
    {
        if ($this->parent_id instanceof LazyLoadingProxy) {
            $this->parent_id->_loadRealInstance();
        }
        return $this->parent_id;
    }

    /**
     * Set parent ID
     * 
     * @param LexicographicResource $parent_id
     */
    public function setParentId(LexicographicResource $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * Get type
     *
     * @return ObjectStorage<RelationTypeTag>
     */
    public function getType(): ObjectStorage
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param ObjectStorage<RelationTypeTag> $type
     */
    public function setType(ObjectStorage $type): void
    {
        $this->type = $type;
    }

    /**
     * Add type
     *
     * @param RelationTypeTag $type
     */
    public function addType(RelationTypeTag $type): void
    {
        $this->type->attach($type);
    }

    /**
     * Remove type
     *
     * @param RelationTypeTag $type
     */
    public function removeType(RelationTypeTag $type): void
    {
        $this->type->detach($type);
    }

    /**
     * Remove all types
     */
    public function removeAllTypes(): void
    {
        $type = clone $this->type;
        $this->type->removeAll($type);
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
     * @return ObjectStorage<Member>
     */
    public function getMember(): ObjectStorage
    {
        return $this->member;
    }

    /**
     * Set member
     *
     * @param ObjectStorage<Member> $member
     */
    public function setMember(ObjectStorage $member): void
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

    /**
     * Remove all members
     */
    public function removeAllMembers(): void
    {
        $member = clone $this->member;
        $this->member->removeAll($member);
    }
}

?>