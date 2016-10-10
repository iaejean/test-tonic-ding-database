<?php
declare(strict_types=1);

namespace Iaejean\Member;

use Ding\Logger\ILoggerAware;
use Iaejean\Common\ConexionHandler;
use Iaejean\Common\TLoggerAware;
use Iaejean\Helpers\SerializerHelper;
use Illuminate\Database\Capsule\Manager;


/**
 * Class MembermDao
 * @package Iaejean\Memberm
 *
 * @Component(name=MemberDao)
 * @Singleton
 */
class MemberDao implements ILoggerAware
{
    /**
     * @var ConexionHandler
     * @Resource(name=ConexionHandler)
     */
    protected $conexionHandler;
    use TLoggerAware;

    /**
     * @param Member $member
     * @return array
     */
    public function listById(Member $member): array
    {
        $result = Manager::table('members')->where('team_id', '=', $member->getTeamId())->get();
        $listMembers = [];
        foreach ($result->all() as $item) {
            $listMembers[] = SerializerHelper::parseJSON(json_encode($item), 'Iaejean\Member\Member');
        }
        return $listMembers;
    }
}
