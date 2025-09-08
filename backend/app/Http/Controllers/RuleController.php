<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Formatter\RuleFormatter;
use App\Http\Validators\RuleValidator;
use App\Regulator\Enum\RuleActionEnum;
use App\Regulator\Enum\RuleConditionOperatorEnum;
use App\Regulator\Enum\RuleParametersEnum;
use App\Regulator\Enum\RuleTypeEnum;
use App\Repositories\RegulatorRuleRepository;
use App\Services\RuleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RuleController extends Controller
{
    public function __construct(
        readonly private RuleService $ruleService,
        readonly private RegulatorRuleRepository $regulatorRuleRepository,
        readonly private RuleFormatter $ruleFormatter,
        readonly private RuleValidator $validator,
    ) {

    }

    public function list(Request $request)
    {
        $rules = $this->regulatorRuleRepository->getAllWithConditionsAndActions();
        $formatedRules = $this->ruleFormatter->formatRules($rules);

        return response()->json(['data' => $formatedRules], Response::HTTP_OK);
    }

    public function create(Request $request): JsonResponse
    {
        $this->validator->validate($request);

        $id = $request->input('rule.id');

        if ($id) {
            $rule = $this->regulatorRuleRepository->getById($id);
        } else {
            $name = $request->input('rule.name');
            $pattern = RuleTypeEnum::from($request->input('rule.pattern'));

            $rule = $this->ruleService->createRule($pattern, $name);
        }

        $this->ruleService->updateRule($rule, $request->get('rule'));

        $formatedRule = $this->ruleFormatter->formatRule($rule);

        return response()->json(['data' => $formatedRule], Response::HTTP_OK);
    }

    public function settings(Request $request): JsonResponse
    {
        $parameters = RuleParametersEnum::cases();
        $operators = RuleConditionOperatorEnum::cases();
        $patterns = RuleTypeEnum::cases();
        $actions = RuleActionEnum::cases();

        return response()->json([
            'data' => [
                'parameters' => $parameters,
                'operators' => $operators,
                'patterns' => $patterns,
                'actions' => $actions,
            ],
        ], Response::HTTP_OK);
    }
}
