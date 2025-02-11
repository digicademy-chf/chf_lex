<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractTag;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;

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
     * @var ?ObjectStorage<MemberRoleTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $memberRole;

    /**
     * List of lexicographic relations of this type
     * 
     * @var ?ObjectStorage<LexicographicRelation>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLexicographicRelationTypeOfLexicographicRelation;

    /**
     * Construct object
     *
     * @param string $text
     * @param string $code
     * @param LexicographicResource $parentResource
     * @param string $iri
     * @param string $uuid
     * @return RelationTypeTag
     */
    public function __construct(string $text, string $code, LexicographicResource $parentResource, string $iri, string $uuid)
    {
        parent::__construct($text, $code, $parentResource, $iri, $uuid);
        $this->initializeObject();

        $this->setType('relationTypeTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->memberRole ??= new ObjectStorage();
        $this->asLexicographicRelationTypeOfLexicographicRelation ??= new ObjectStorage();
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
    public function getMemberRole(): ?ObjectStorage
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
        $this->memberRole?->attach($memberRole);
    }

    /**
     * Remove member role
     *
     * @param MemberRoleTag $memberRole
     */
    public function removeMemberRole(MemberRoleTag $memberRole): void
    {
        $this->memberRole?->detach($memberRole);
    }

    /**
     * Remove all member roles
     */
    public function removeAllMemberRole(): void
    {
        $memberRole = clone $this->memberRole;
        $this->memberRole->removeAll($memberRole);
    }

    /**
     * Get as lexicographic relation type of lexicographic relation
     *
     * @return ObjectStorage<LexicographicRelation>
     */
    public function getAsLexicographicRelationTypeOfLexicographicRelation(): ?ObjectStorage
    {
        return $this->asLexicographicRelationTypeOfLexicographicRelation;
    }

    /**
     * Set as lexicographic relation type of lexicographic relation
     *
     * @param ObjectStorage<LexicographicRelation> $asLexicographicRelationTypeOfLexicographicRelation
     */
    public function setAsLexicographicRelationTypeOfLexicographicRelation(ObjectStorage $asLexicographicRelationTypeOfLexicographicRelation): void
    {
        $this->asLexicographicRelationTypeOfLexicographicRelation = $asLexicographicRelationTypeOfLexicographicRelation;
    }

    /**
     * Add as lexicographic relation type of lexicographic relation
     *
     * @param LexicographicRelation $asLexicographicRelationTypeOfLexicographicRelation
     */
    public function addAsLexicographicRelationTypeOfLexicographicRelation(LexicographicRelation $asLexicographicRelationTypeOfLexicographicRelation): void
    {
        $this->asLexicographicRelationTypeOfLexicographicRelation?->attach($asLexicographicRelationTypeOfLexicographicRelation);
    }

    /**
     * Remove as lexicographic relation type of lexicographic relation
     *
     * @param LexicographicRelation $asLexicographicRelationTypeOfLexicographicRelation
     */
    public function removeAsLexicographicRelationTypeOfLexicographicRelation(LexicographicRelation $asLexicographicRelationTypeOfLexicographicRelation): void
    {
        $this->asLexicographicRelationTypeOfLexicographicRelation?->detach($asLexicographicRelationTypeOfLexicographicRelation);
    }

    /**
     * Remove all as lexicographic relation type of lexicographic relations
     */
    public function removeAllAsLexicographicRelationTypeOfLexicographicRelation(): void
    {
        $asLexicographicRelationTypeOfLexicographicRelation = clone $this->asLexicographicRelationTypeOfLexicographicRelation;
        $this->asLexicographicRelationTypeOfLexicographicRelation->removeAll($asLexicographicRelationTypeOfLexicographicRelation);
    }
}
