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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for RelationTypeTag
 */
class RelationTypeTag extends AbstractTag
{
    /**
     * How close members of this type of relation need to be
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                '0',
                'any',
                'sameResource',
                'sameEntry',
            ],
        ],
    ])]
    protected string $scopeRestriction = '0';

    /**
     * Defines which roles members of this relation may have
     * 
     * @var ObjectStorage<MemberRoleTag>
     */
    #[Lazy()]
    protected ObjectStorage $memberRole;

    /**
     * Construct object
     *
     * @param string $text
     * @return RelationTypeTag
     */
    public function __construct(string $text)
    {
        parent::__construct($text);
        $this->initializeObject();

        $this->setType('relationTypeTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->memberRole = new ObjectStorage();
    }

    /**
     * Get scope restriction
     *
     * @return string
     */
    public function getScopeRestriction(): string
    {
        return $this->scopeRestriction;
    }

    /**
     * Set scope restriction
     *
     * @param string $scopeRestriction
     */
    public function setScopeRestriction(string $scopeRestriction): void
    {
        $this->scopeRestriction = $scopeRestriction;
    }

    /**
     * Get member role
     *
     * @return ObjectStorage<MemberRoleTag>
     */
    public function getMemberRole(): ObjectStorage
    {
        return $this->memberRole;
    }

    /**
     * Set member role
     *
     * @param ObjectStorage<MemberRoleTag> $memberRole
     */
    public function setMemberRole(ObjectStorage $memberRole): void
    {
        $this->memberRole = $memberRole;
    }

    /**
     * Add member role
     *
     * @param LexicographicRelation $memberRole
     */
    public function addMemberRole(MemberRoleTag $memberRole): void
    {
        $this->memberRole->attach($memberRole);
    }

    /**
     * Remove member role
     *
     * @param MemberRoleTag $memberRole
     */
    public function removeMemberRole(MemberRoleTag $memberRole): void
    {
        $this->memberRole->detach($memberRole);
    }

    /**
     * Remove all member roles
     */
    public function removeAllMemberRole(): void
    {
        $memberRole = clone $this->memberRole;
        $this->memberRole->removeAll($memberRole);
    }
}
