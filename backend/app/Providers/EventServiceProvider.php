<?php
declare(strict_types=1);

namespace App\Providers;

use App\Events\OnFinishSuccessRule;
use App\Listeners\OnFinishSuccessRuleListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OnFinishSuccessRule::class => [
            OnFinishSuccessRuleListener::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
