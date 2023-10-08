<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for member-role tags
 */
class MemberRoleTag extends AbstractTag
{
    /**
     * Defines which types of members may be part of this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'any',
                'entry',
                'sense',
                'encyclopediaEntry',
                'glossaryEntry',
            ],
        ],
    ])]
    protected string $memberType = '';

    /**
     * Minimum number of members in this relation (leave empty to not set a limit)
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $min = null;

    /**
     * Maximum number of members in this relation (leave empty to not set a limit)
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $max = null;

    /**
     * Instructs machine agents what to do when they show this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'embed',
                'navigate',
                'none',
            ],
        ],
    ])]
    protected string $action = '';

    /**
     * List of tags with this member role
     * 
     * @var ObjectStorage<RelationTypeTag>
     */
    #[Lazy()]
    protected ObjectStorage $asMemberRoleOfTag;

    /**
     * List of relation members with this role
     * 
     * @var ObjectStorage<Member>
     */
    #[Lazy()]
    protected ObjectStorage $asRoleOfMember;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @param string $action
     * @return MemberRoleTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text, string $action)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('memberRole');
        $this->setAction($action);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->asMemberRoleOfTag = new ObjectStorage();
        $this->asRoleOfMember    = new ObjectStorage();
    }

    /**
     * Get role (alias of text for DMLex conformity)
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->getText();
    }

    /**
     * Set role (alias of text for DMLex conformity)
     *
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->setText($role);
    }

    /**
     * Get member type
     *
     * @return string
     */
    public function getMemberType(): string
    {
        return $this->memberType;
    }

    /**
     * Set member type
     *
     * @param string $memberType
     */
    public function setMemberType(string $memberType): void
    {
        $this->memberType = $memberType;
    }

    /**
     * Get min
     *
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * Set min
     *
     * @param int $min
     */
    public function setMin(int $min): void
    {
        $this->min = $min;
    }

    /**
     * Get max
     *
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * Set max
     *
     * @param int $max
     */
    public function setMax(int $max): void
    {
        $this->max = $max;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * Get as member role of tag
     *
     * @return ObjectStorage<RelationTypeTag>
     */
    public function getAsMemberRoleOfTag(): ObjectStorage
    {
        return $this->asMemberRoleOfTag;
    }

    /**
     * Set as member role of tag
     *
     * @param ObjectStorage<RelationTypeTag> $asMemberRoleOfTag
     */
    public function setAsMemberRoleOfTag(ObjectStorage $asMemberRoleOfTag): void
    {
        $this->asMemberRoleOfTag = $asMemberRoleOfTag;
    }

    /**
     * Add as member role of tag
     *
     * @param RelationTypeTag $asMemberRoleOfTag
     */
    public function addAsMemberRoleOfTag(RelationTypeTag $asMemberRoleOfTag): void
    {
        $this->asMemberRoleOfTag->attach($asMemberRoleOfTag);
    }

    /**
     * Remove as member role of tag
     *
     * @param RelationTypeTag $asMemberRoleOfTag
     */
    public function removeAsMemberRoleOfTag(RelationTypeTag $asMemberRoleOfTag): void
    {
        $this->asMemberRoleOfTag->detach($asMemberRoleOfTag);
    }

    /**
     * Remove all as member role of tags
     */
    public function removeAllAsMemberRoleOfTags(): void
    {
        $asMemberRoleOfTag = clone $this->asMemberRoleOfTag;
        $this->asMemberRoleOfTag->removeAll($asMemberRoleOfTag);
    }

    /**
     * Get as role of member
     *
     * @return ObjectStorage<Member>
     */
    public function getAsRoleOfMember(): ObjectStorage
    {
        return $this->asRoleOfMember;
    }

    /**
     * Set as role of member
     *
     * @param ObjectStorage<Member> $asRoleOfMember
     */
    public function setAsRoleOfMember(ObjectStorage $asRoleOfMember): void
    {
        $this->asRoleOfMember = $asRoleOfMember;
    }

    /**
     * Add as role of member
     *
     * @param Member $asRoleOfMember
     */
    public function addAsRoleOfMember(Member $asRoleOfMember): void
    {
        $this->asRoleOfMember->attach($asRoleOfMember);
    }

    /**
     * Remove as role of member
     *
     * @param Member $asRoleOfMember
     */
    public function removeAsRoleOfMember(Member $asRoleOfMember): void
    {
        $this->asRoleOfMember->detach($asRoleOfMember);
    }

    /**
     * Remove all as role of members
     */
    public function removeAllAsRoleOfMembers(): void
    {
        $asRoleOfMember = clone $this->asRoleOfMember;
        $this->asRoleOfMember->removeAll($asRoleOfMember);
    }
}

/**
 * Alias for DMLex conformity since the class above is implemented as a type of tag
 */
class_alias('MemberRoleTag', 'MemberType');

?>