<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractTag;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;

defined('TYPO3') or die();

/**
 * Model for MemberRoleTag
 */
class MemberRoleTag extends AbstractTag
{
    /**
     * Relation type that this member role is part of
     * 
     * @var LabelTag|LazyLoadingProxy
     */
    #[Lazy()]
    protected LabelTag|LazyLoadingProxy $parentRelationTypeTag;

    /**
     * Defines which types of members may be part of this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'entry',
                'encyclopediaEntry',
                'sense',
            ],
        ],
    ])]
    protected string $memberType = 'entry';

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
     * Instructs software what to do when it shows relation members with this role
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                '0',
                'embed',
                'navigate',
                'none',
            ],
        ],
    ])]
    protected string $hint = '0';

    /**
     * List of relation members that use this tag as a role
     * 
     * @var ?ObjectStorage<Member>
     */
    #[Lazy()]
    protected ?ObjectStorage $asRoleOfMember;

    /**
     * Construct object
     *
     * @param LexicographicResource $parentResource
     * @param string $uuid
     * @param string $code
     * @param string $text
     * @return MemberRoleTag
     */
    public function __construct(LexicographicResource $parentResource, string $uuid, string $code, string $text, string $memberType)
    {
        parent::__construct($parentResource, $uuid, $code, $text);
        $this->initializeObject();

        $this->setType('memberRoleTag');
        $this->setMemberType($memberType);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentRelationTypeTag = new LazyLoadingProxy();
        $this->asRoleOfMember ??= new ObjectStorage();
    }

    /**
     * Get parent relation type tag
     * 
     * @return RelationTypeTag
     */
    public function getParentRelationTypeTag(): RelationTypeTag
    {
        if ($this->parentRelationTypeTag instanceof LazyLoadingProxy) {
            $this->parentRelationTypeTag->_loadRealInstance();
        }
        return $this->parentRelationTypeTag;
    }

    /**
     * Set parent relation type tag
     * 
     * @param RelationTypeTag
     */
    public function setParentRelationTypeTag(RelationTypeTag $parentRelationTypeTag): void
    {
        $this->parentRelationTypeTag = $parentRelationTypeTag;
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
     * Get hint
     *
     * @return string
     */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
     * Set hint
     *
     * @param string $hint
     */
    public function setHint(string $hint): void
    {
        $this->hint = $hint;
    }

    /**
     * Get as role of member
     *
     * @return ObjectStorage<Member>
     */
    public function getAsRoleOfMember(): ?ObjectStorage
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
        $this->asRoleOfMember?->attach($asRoleOfMember);
    }

    /**
     * Remove as role of member
     *
     * @param Member $asRoleOfMember
     */
    public function removeAsRoleOfMember(Member $asRoleOfMember): void
    {
        $this->asRoleOfMember?->detach($asRoleOfMember);
    }

    /**
     * Remove all as role of members
     */
    public function removeAllAsRoleOfMember(): void
    {
        $asRoleOfMember = clone $this->asRoleOfMember;
        $this->asRoleOfMember->removeAll($asRoleOfMember);
    }
}
