<?php
declare(strict_types=1);

namespace Iaejean\Team;

use Iaejean\Member\Member;
use Iaejean\Member\MemberService;

/**
 * Class TeamService
 * @package Iaejean\Team
 *
 * @Component(name=TeamService)
 * @Singleton
 */
class TeamService
{
    /**
     * @var TeamDao
     * @Resource(name=TeamDao)
     */
    private $teamDao;
    /**
     * @var MemberService
     * @Resource(name=MemberService)
     */
    private $memberService;

    /**
     * @return array
     */
    public function list(): array
    {
        return $this->teamDao->list();
    }

    /**
     * @param Team $team
     * @return Team
     * @throws \Tonic\NotFoundException
     */
    public function getById(Team $team): Team
    {
        $team = $this->teamDao->getById($team);
        $member = new Member();
        $member->setTeamId($team->getId());
        $team->setMembers($this->memberService->listById($member));
        return $team;
    }

    /**
     * @param Team $team
     * @return Team
     * @throws \InvalidArgumentException
     */
    public function insert(Team $team): Team
    {
        $id = $this->teamDao->insert($team);
        $team->setId($id);
        return $team;
    }

    /**
     * @param Team $team
     * @return int
     * @throws \InvalidArgumentException
     */
    public function update(Team $team): int
    {
        return $this->teamDao->update($team);
    }

    /**
     * @param Team $team
     * @return int
     */
    public function delete(Team $team): int
    {
        return $this->teamDao->delete($team);
    }
}
