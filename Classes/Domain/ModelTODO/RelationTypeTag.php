<?php
defined('TYPO3') or die();
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
 * Model for relation-type tags
 */
class RelationTypeTag extends AbstractTag
{
    /**
     * Indicator of how close members of this type of relation need to be
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'any',
                'sameResource',
                'sameEntry',
            ],
        ],
    ])]
    protected string $scope = '';

    /**
     * Defines which roles members of this relation may have
     * 
     * @var ObjectStorage<MemberRoleTag>
     */
    #[Lazy()]
    protected ObjectStorage $memberRole;

    /**
     * List of relations of this type
     * 
     * @var ObjectStorage<Relation>
     */
    #[Lazy()]
    protected ObjectStorage $asTypeOfRelation;

    /**
     * Construct object
     *
     * @param LexicographicResource $parent_id
     * @param string $id
     * @param string $uuid
     * @param string $text
     * @return RelationTypeTag
     */
    public function __construct(LexicographicResource $parent_id, string $id, string $uuid, string $text)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setId($id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType('relationType');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->memberRole       = new ObjectStorage();
        $this->asTypeOfRelation = new ObjectStorage();
    }

    /**
     * Get alt type (alias of text for DMLex conformity)
     *
     * @return string
     */
    public function getAltType(): string
    {
        return $this->getText();
    }

    /**
     * Set alt type (alias of text for DMLex conformity)
     *
     * @param string $altType
     */
    public function setAltType(string $altType): void
    {
        $this->setText($altType);
    }

    /**
     * Get scope
     *
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * Set scope
     *
     * @param string $scope
     */
    public function setScope(string $scope): void
    {
        $this->scope = $scope;
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
     * @param MemberRoleTag $memberRole
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
    public function removeAllMemberRoles(): void
    {
        $memberRole = clone $this->memberRole;
        $this->memberRole->removeAll($memberRole);
    }

    /**
     * Get alt member type (alias of member role for DMLex conformity)
     *
     * @return ObjectStorage<MemberRoleTag>
     */
    public function getAltMemberType(): ObjectStorage
    {
        return $this->getMemberRole();
    }

    /**
     * Set alt member type (alias of member role for DMLex conformity)
     *
     * @param ObjectStorage<MemberRoleTag> $altMemberType
     */
    public function setAltMemberType(ObjectStorage $altMemberType): void
    {
        $this->setMemberRole($altMemberType);
    }

    /**
     * Add alt member type (alias of member role for DMLex conformity)
     *
     * @param MemberRoleTag $altMemberType
     */
    public function addAltMemberType(MemberRoleTag $altMemberType): void
    {
        $this->addMemberRole($altMemberType);
    }

    /**
     * Remove alt member type (alias of member role for DMLex conformity)
     *
     * @param MemberRoleTag $altMemberType
     */
    public function removeAltMemberType(MemberRoleTag $altMemberType): void
    {
        $this->removeMemberRole($altMemberType);
    }

    /**
     * Remove all alt member types (alias of member role for DMLex conformity)
     */
    public function removeAltMemberTypes(): void
    {
        $this->removeAllMemberRoles();
    }

    /**
     * Get as type of relation
     *
     * @return ObjectStorage<Relation>
     */
    public function getAsTypeOfRelation(): ObjectStorage
    {
        return $this->asTypeOfRelation;
    }

    /**
     * Set as type of relation
     *
     * @param ObjectStorage<Relation> $asTypeOfRelation
     */
    public function setAsTypeOfRelation(ObjectStorage $asTypeOfRelation): void
    {
        $this->asTypeOfRelation = $asTypeOfRelation;
    }

    /**
     * Add as type of relation
     *
     * @param Relation $asTypeOfRelation
     */
    public function addAsTypeOfRelation(Relation $asTypeOfRelation): void
    {
        $this->asTypeOfRelation->attach($asTypeOfRelation);
    }

    /**
     * Remove as type of relation
     *
     * @param Relation $asTypeOfRelation
     */
    public function removeAsTypeOfRelation(Relation $asTypeOfRelation): void
    {
        $this->asTypeOfRelation->detach($asTypeOfRelation);
    }

    /**
     * Remove all as type of relations
     */
    public function removeAllAsTypeOfRelations(): void
    {
        $asTypeOfRelation = clone $this->asTypeOfRelation;
        $this->asTypeOfRelation->removeAll($asTypeOfRelation);
    }
}

/**
 * Alias for DMLex conformity since the class above is implemented as a type of tag
 */
class_alias('RelationTypeTag', 'RelationType');
