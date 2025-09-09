<?php
declare(strict_types=1);

namespace App\Regulator;

use App\Models\Announcement;
use App\Models\AnnouncementStat;
use App\Models\RegulatorRule;
use App\Regulator\Dto\DataDto;
use App\Regulator\Dto\RuleDataDto;
use App\Regulator\Enum\RuleTypeEnum;
use App\Regulator\Exceptions\RegulatorExceptionSystem;
use App\Regulator\Rules\IfAndThenRule;
use App\Regulator\Rules\IfOrThenRule;
use App\Regulator\Rules\IfThenRule;
use App\Regulator\Rules\RuleInterface;

class RuleFactory
{
    public function __construct(
        readonly private ConditionFactory $conditionFactory,
        readonly private ActionFactory $actionFactory,
    ) {
    }

    /**
     * @throws RegulatorExceptionSystem
     */
    public function createRule(RegulatorRule $model, RuleDataDto $ruleDto): RuleInterface
    {
        $rule = match ($model->getPattern()) {
            RuleTypeEnum::IF_THEN->value => new IfThenRule($this->conditionFactory, $this->actionFactory),
            RuleTypeEnum::IF_AND_THEN->value => new IfAndThenRule($this->conditionFactory, $this->actionFactory),
            RuleTypeEnum::IF_OR_THEN->value => new IfOrThenRule($this->conditionFactory, $this->actionFactory),
            default => throw new RegulatorExceptionSystem('Unknown rule')
        };

        $rule->setRuleDataDto($ruleDto);

        return $rule;
    }

    public function createRuleDataDtoFromModel(
        RegulatorRule $ruleModel,
        AnnouncementStat $announcementStatModel
    ): RuleDataDto {
        $conditions = $ruleModel->getConditions();
        $action = $ruleModel->getAction();
        $announcementModel = $announcementStatModel->getAnnouncement();

        $dataDto = $this->createDataDto($announcementStatModel, $announcementModel);
        $conditionDtoCollection = $this->conditionFactory->createConditionDtoCollection($conditions, $dataDto);
        $actionDto = $this->actionFactory->createActionDto($announcementModel, $action);

        return new RuleDataDto(
            $conditionDtoCollection,
            $actionDto,
            $dataDto
        );
    }

    public function createDataDto(AnnouncementStat $announcementStat, Announcement $announcement): DataDto
    {
        return new DataDto(
            $announcement->getBudget(),
            $announcement->getCpm(),
            $announcementStat->getViews(),
            $announcementStat->getClicks(),
            $announcementStat->getSpent()
        );
    }
}
