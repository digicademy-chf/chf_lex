<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractRelation;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for LexicographicRelation
 */
class LexicographicRelation extends AbstractRelation
{
    /**
     * Specifies the type of lexicographic relation
     * 
     * @var RelationTypeTag|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected RelationTypeTag|LazyLoadingProxy|null $lexicographicRelationType = null;

    /**
     * List of members of this lexicographic relation
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
     * @param RelationTypeTag $lexicographicRelationType
     * @param Member $member
     * @return LexicographicRelation
     */
    public function __construct(RelationTypeTag $lexicographicRelationType, Member $member)
    {
        parent::__construct();
        $this->initializeObject();

        $this->setType('lexicographicRelation');
        $this->setLexicographicRelationType($lexicographicRelationType);
        $this->addMember($member);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->lexicographicRelationType = new ObjectStorage();
        $this->member = new ObjectStorage();
    }

    /**
     * Get lexicographic relation type
     * 
     * @return RelationTypeTag
     */
    public function getLexicographicRelationType(): RelationTypeTag
    {
        if ($this->lexicographicRelationType instanceof LazyLoadingProxy) {
            $this->lexicographicRelationType->_loadRealInstance();
        }
        return $this->lexicographicRelationType;
    }

    /**
     * Set lexicographic relation type
     * 
     * @param RelationTypeTag
     */
    public function setLexicographicRelationType(RelationTypeTag $lexicographicRelationType): void
    {
        $this->lexicographicRelationType = $lexicographicRelationType;
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
    public function removeAllMember(): void
    {
        $member = clone $this->member;
        $this->member->removeAll($member);
    }
}
