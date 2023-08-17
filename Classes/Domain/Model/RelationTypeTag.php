<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use Digicademy\DALex\Domain\Validator\StringOptionsValidator;
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

?>