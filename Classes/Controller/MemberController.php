<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFLex\Domain\Model\Member;
use Digicademy\CHFLex\Domain\Repository\MemberRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for members
 */
class MemberController extends ActionController
{
    private MemberRepository $memberRepository;

    public function injectMemberRepository(MemberRepository $memberRepository): void
    {
        $this->memberRepository = $memberRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('members', $this->memberRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Member $member): ResponseInterface
    {
        $this->view->assign('member', $member);
        return $this->htmlResponse();
    }
}

?>