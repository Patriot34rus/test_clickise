<?php

namespace App\Console\Commands;

use App\Repositories\AnnouncementStatRepository;
use App\Repositories\RegulatorRuleRepository;
use App\Services\RegulatorService;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;

class ProcessAnnouncementStatRegulatorCommand extends Command
{
    public function __construct(
        readonly private AnnouncementStatRepository $announcementStatRepository,
        readonly private RegulatorRuleRepository $regulatorRuleRepository,
        readonly private RegulatorService $regulatorService,
        readonly private LoggerInterface $logger
    ) {
        parent::__construct();
    }

    protected $signature = 'app:process-announcement-stat-regulator-command';

    protected $description = 'Command start processing rules to announcement statistic  ';

    public function handle()
    {
        $this->info('Starting processing announcement stat rules...');

        $stats = $this->announcementStatRepository->getAllActive();
        $rules = $this->regulatorRuleRepository->getAllWithConditionsAndActions();

        $progressBar = $this->output->createProgressBar($stats->count());
        $progressBar->start();

        foreach ($stats as $stat) {
            $progressBar->advance();
            foreach ($rules as $rule) {
                {
                    try {
                        $this->regulatorService->process($stat, $rule);
                    } catch (\Throwable $exception) {
                        $this->logger->error($exception);
                    }
                }
            }
        }

        $progressBar->finish();

        $this->output->newLine();

        $this->info('Processing was successful.');
    }
}
