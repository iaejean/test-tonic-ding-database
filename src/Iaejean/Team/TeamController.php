<?php
declare(strict_types=1);

namespace Iaejean\Team;

use Ding\Container\IContainerAware;
use Ding\Container\Impl\ContainerImpl;
use Ding\Logger\ILoggerAware;
use Iaejean\Common\TContainerAware;
use Iaejean\Common\TLoggerAware;
use Iaejean\Helpers\SerializerHelper;
use JMS\Serializer\SerializationContext;
use Tonic\Application;
use Tonic\Request;
use Tonic\Resource;
use Tonic\Response;

/**
 * Class TeamController
 * @package Iaejean\Team
 *
 * @Component(name=TeamController)
 * @Singleton
 *
 * @uri /teams/:id
 * @uri /teams
 */
class TeamController extends Resource implements ILoggerAware, IContainerAware
{
    /**
     * @var TeamService
     */
    protected $teamService;
    use TLoggerAware;
    use TContainerAware;

    /**
     * TeamController constructor.
     * @param Application $app
     * @param Request $request
     */
    public function __construct(Application $app, Request $request)
    {
        parent::__construct($app, $request);
        $this->setLogger(\Logger::getLogger(__CLASS__));
        $this->setContainer(ContainerImpl::getInstance());
        $this->teamService = $this->container->getBean('TeamService');
    }

    /**
     * @return Response
     */
    public function listAction(): Response
    {
        $this->logger->info(__METHOD__);
        $listTeams = $this->teamService->list();
        
        return new Response(
            Response::OK,
            SerializerHelper::toJSON(
                $listTeams,
                SerializationContext::create()->setGroups(['list'])
            )
        );
    }

    /**
     * @method GET
     * @param string|null $id
     * @return Response
     */
    public function getByIdAction(string $id = null): Response
    {
        if ($id === null) {
            return $this->listAction();
        }

        $this->logger->info(__METHOD__);
        $team = new Team();
        $team->setId($id);
        $team = $this->teamService->getById($team);

        return new Response(
            Response::OK,
            SerializerHelper::toJSON(
                $team,
                SerializationContext::create()->setGroups(['get'])
            )
        );
    }

    /**
     * @method POST
     */
    public function insertAction(): Response
    {
        $this->logger->info(__METHOD__);
        $data = explode('=', (string)$this->request->getData());
        $team = new Team();
        $team->setName($data[1]);
        $team = $this->teamService->insert($team);

        return new Response(
            Response::CREATED,
            SerializerHelper::toJSON(
                $team,
                SerializationContext::create()->setGroups(['list'])
            )
        );
    }

    /**
     * @method PUT
     */
    public function updateAction(string $id = null): Response
    {
        $this->logger->info(__METHOD__);
        $data = explode('=', (string)$this->request->getData());
        $team = new Team();
        $team->setName($data[1]);
        $team->setId($id);
        $this->teamService->update($team);

        return new Response(
            Response::CREATED,
            SerializerHelper::toJSON($team, SerializationContext::create()->setGroups(['list']))
        );
    }

    /**
     * @method DELETE
     */
    public function deleteAction(string $id = null): Response
    {
        $this->logger->info(__METHOD__);
        $team = new Team();
        $team->setId($id);
        $this->teamService->delete($team);
        return new Response(Response::NOCONTENT);
    }
}
