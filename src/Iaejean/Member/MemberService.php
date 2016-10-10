<?php
declare(strict_types=1);

namespace Iaejean\Member;

/**
 * Class MemberService
 * @package Iaejean\Member
 *
 * @Component(name=MemberService)
 * @Singleton
 */
class MemberService
{
    /**
     * @var MemberDao
     * @Resource(name=MemberDao)
     */
    private $memberDao;

    /**
     * @param Member $member
     * @return array
     */
    public function listById(Member $member): array
    {
        return $this->memberDao->listById($member);
    }
}
