<?php
declare(strict_types=1);

namespace App\Services;

use App\Events\OnFinishSuccessRule;
use App\Models\AnnouncementStat;
use App\Models\RegulatorRule;
use App\Regulator\RuleFactory;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Contracts\Events\Dispatcher;

class RegulatorService
{
    public function __construct(
        readonly private RuleFactory $ruleFactory,
        readonly private AnnouncementService $announcementService,
        readonly private ConnectionInterface $connection,
        readonly private Dispatcher $eventDispatcher,

    ) {
    }

    /**
     * @throws \App\Regulator\Exceptions\RegulatorExceptionSystem
     */
    public function process(AnnouncementStat $statModel, RegulatorRule $ruleModel): void
    {
        try {
            $this->connection->beginTransaction();
            $ruleDataDto = $this->ruleFactory->createRuleDataDtoFromModel($ruleModel, $statModel);
            $rule = $this->ruleFactory->createRule($ruleModel, $ruleDataDto);

            if ($rule->isMetConditions()) {
                if ($rule->execAction()) {
                    $this->onFinishSuccessRule($ruleModel, $statModel);
                }
            }

            $this->announcementService->deactivateStat($statModel);
            $this->connection->commit();
        } catch (\Throwable $exception) {

            $this->connection->rollBack();
            throw $exception;
        }
    }

    /**
     * Этот метод должен быть в отдельном классе. И созданием экземпляра события тоже необходимо  делегировать
     * отдельному классу. Но это будет оверхед для тестового.
     */
    private function onFinishSuccessRule(RegulatorRule $rule, AnnouncementStat $stat): void
    {
        $this->eventDispatcher->dispatch(new OnFinishSuccessRule($rule, $stat));
    }
}
