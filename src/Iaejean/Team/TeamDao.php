<?php
declare(strict_types=1);

namespace Iaejean\Team;

use Ding\Logger\ILoggerAware;
use Iaejean\Common\ConexionHandler;
use Iaejean\Common\TLoggerAware;
use Iaejean\Helpers\SerializerHelper;
use Iaejean\Helpers\ValidatorHelper;
use Illuminate\Database\Capsule\Manager;
use Tonic\NotFoundException;

/**
 * Class TeamDao
 * @package Iaejean\Team
 *
 * @Component(name=TeamDao)
 * @Singleton
 */
class TeamDao implements ILoggerAware
{
    /**
     * @var ConexionHandler
     * @Resource(name=ConexionHandler)
     */
    protected $conexionHandler;
    use TLoggerAware;

    /**
     * @return array
     */
    public function list(): array
    {
        $result = Manager::table('teams')->get();
        $listTeams = [];
        foreach ($result->all() as $item) {
            $listTeams[] = SerializerHelper::parseJSON(json_encode($item), 'Iaejean\Team\Team');
        }
        return $listTeams;
    }

    /**
     * @param Team $team
     * @return Team
     * @throws NotFoundException
     */
    public function getById(Team $team): Team
    {
        $result = Manager::table('teams')->where('id', '=', $team->getId())->get();
        if ($result->isEmpty()) {
            throw new NotFoundException('No entity found');
        }
        return SerializerHelper::parseJSON(json_encode($result->first()), 'Iaejean\Team\Team');
    }

    /**
     * @param Team $team
     * @return int
     * @throws \InvalidArgumentException
     */
    public function insert(Team $team): int
    {
        ValidatorHelper::validate($team);
        return Manager::table('teams')->insertGetId([
            'name'       => $team->getName(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * @param Team $team
     * @return int
     * @throws \InvalidArgumentException
     */
    public function update(Team $team): int
    {
        ValidatorHelper::validate($team);
        return Manager::table('teams')
            ->where('id', '=', $team->getId())
            ->update([
                'name'       => $team->getName(),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }

    /**
     * @param Team $team
     * @return int
     */
    public function delete(Team $team): int
    {
        return Manager::table('teams')->delete($team->getId());
    }
}
