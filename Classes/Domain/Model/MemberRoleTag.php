<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractTag;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

defined('TYPO3') or die();

/**
 * Model for MemberRoleTag
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
                'entry',
                'encyclopediaEntry',
                'sense',
            ],
        ],
    ])]
    protected string $memberType = 'entry';

    /**
     * Instruction what to do with members of this role
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
     * Minimum number of members in this relation
     * 
     * @var ?int
     */
    #[Validate([
        'validator' => 'NumberRange',
        'options' => [
            'minimum' => 1,
        ],
    ])]
    protected ?int $min = null;

    /**
     * Maximum number of members in this relation
     * 
     * @var ?int
     */
    #[Validate([
        'validator' => 'NumberRange',
        'options' => [
            'minimum' => 1,
        ],
    ])]
    protected ?int $max = null;

    /**
     * Relation type that this member role is part of
     * 
     * @var RelationTypeTag|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected RelationTypeTag|LazyLoadingProxy|null $parentRelationTypeTag = null;

    /**
     * Construct object
     *
     * @param string $text
     * @param string $memberType
     * @return MemberRoleTag
     */
    public function __construct(string $text, string $memberType)
    {
        parent::__construct($text);

        $this->setType('memberRoleTag');
        $this->setMemberType($memberType);
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
}
