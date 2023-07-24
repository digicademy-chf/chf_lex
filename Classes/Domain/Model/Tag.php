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
 * Model for tags
 */
class Tag extends AbstractEntity
{
    /**
     * Name of the tag
     * 
     * @var string
     */
    protected string $tag = '';

    /**
     * Type of tag
     * 
     * @var string
     */
    protected string $type = '';

    /**
     * Abbreviated form of the tag
     * 
     * @var string
     */
    protected string $code = '';

    /**
     * Brief information about the tag
     * 
     * @var string
     */
    protected string $description = '';

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * External web address to identify the tag across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    protected $sameAs;

    #[Lazy()]
    /**
     * List of parts of speech that this tag may be used for
     * 
     * @var ObjectStorage<Tag>
     */
    protected $partOfSpeechConstraint;

    /**
     * Indicator of how close members of this type of relation need to be
     * 
     * @var string
     */
    protected string $scopeConstraint = '';

    #[Lazy()]
    /**
     * Defines which roles members of this relation may have
     * 
     * @var ObjectStorage<Tag>
     */
    protected $memberRoleConstraint;

    /**
     * Defines which types of members may be part of this relation
     * 
     * @var string
     */
    protected string $memberTypeConstraint = '';

    /**
     * Minimum number of members in this relation (leave empty to not set a limit)
     * 
     * @var int
     */
    protected int $min;

    /**
     * Maximum number of members in this relation (leave empty to not set a limit)
     * 
     * @var int
     */
    protected int $max;

    /**
     * Instructs machine agents what to do when they show this relation
     * 
     * @var string
     */
    protected string $action = '';

    /**
     * Initialize object
     *
     * @return Tag
     */
    public function __construct()
    {
        $this->sameAs                 = new ObjectStorage();
        $this->partOfSpeechConstraint = new ObjectStorage();
        $this->memberRoleConstraint   = new ObjectStorage();
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Set tag
     *
     * @param string $tag
     */
    public function setTag(string $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
     * Get same as
     *
     * @return ObjectStorage|null
     */
    public function getSameAs(): ?ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set same as
     *
     * @param ObjectStorage $sameAs
     */
    public function setSameAs($sameAs): void
    {
        $this->sameAs = $sameAs;
    }

    /**
     * Add same as
     *
     * @param SameAs $sameAs
     */
    public function addSameAs(SameAs $sameAs): void
    {
        $this->sameAs->attach($sameAs);
    }

    /**
     * Remove same as
     *
     * @param SameAs $sameAs
     */
    public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs->detach($sameAs);
    }

    /**
     * Get part of speech constraint
     *
     * @return ObjectStorage|null
     */
    public function getPartOfSpeechConstraint(): ?ObjectStorage
    {
        return $this->partOfSpeechConstraint;
    }

    /**
     * Set part of speech constraint
     *
     * @param ObjectStorage $sameAs
     */
    public function setPartOfSpeechConstraint($partOfSpeechConstraint): void
    {
        $this->partOfSpeechConstraint = $partOfSpeechConstraint;
    }

    /**
     * Add part of speech constraint
     *
     * @param Tag $partOfSpeechConstraint
     */
    public function addPartOfSpeechConstraint(Tag $partOfSpeechConstraint): void
    {
        $this->partOfSpeechConstraint->attach($partOfSpeechConstraint);
    }

    /**
     * Remove part of speech constraint
     *
     * @param Tag $partOfSpeechConstraint
     */
    public function removePartOfSpeechConstraint(Tag $partOfSpeechConstraint): void
    {
        $this->partOfSpeechConstraint->detach($partOfSpeechConstraint);
    }

    /**
     * Get scope constraint
     *
     * @return string
     */
    public function getScopeConstraint(): string
    {
        return $this->scopeConstraint;
    }

    /**
     * Set scope constraint
     *
     * @param string $scopeConstraint
     */
    public function setScopeConstraint(string $scopeConstraint): void
    {
        $this->scopeConstraint = $scopeConstraint;
    }

    /**
     * Get member role constraint
     *
     * @return ObjectStorage|null
     */
    public function getMemberRoleConstraint(): ?ObjectStorage
    {
        return $this->memberRoleConstraint;
    }

    /**
     * Set member role constraint
     *
     * @param ObjectStorage $memberRole
     */
    public function setMemberRoleConstraint($memberRoleConstraint): void
    {
        $this->memberRoleConstraint = $memberRoleConstraint;
    }

    /**
     * Add member role constraint
     *
     * @param Tag $memberRoleConstraint
     */
    public function addMemberRoleConstraint(Tag $memberRoleConstraint): void
    {
        $this->memberRoleConstraint->attach($memberRoleConstraint);
    }

    /**
     * Remove member role constraint
     *
     * @param Tag $memberRole
     */
    public function removeMemberRoleConstraint(Tag $memberRoleConstraint): void
    {
        $this->memberRoleConstraint->detach($memberRoleConstraint);
    }

    /**
     * Get member type constraint
     *
     * @return string
     */
    public function getMemberTypeConstraint(): string
    {
        return $this->memberTypeConstraint;
    }

    /**
     * Set member type constraint
     *
     * @param string $memberTypeConstraint
     */
    public function setMemberTypeConstraint(string $memberTypeConstraint): void
    {
        $this->memberTypeConstraint = $memberTypeConstraint;
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
}

?>