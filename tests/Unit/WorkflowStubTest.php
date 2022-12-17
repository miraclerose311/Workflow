<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\Fixtures\TestActivity;
use Tests\Fixtures\TestOtherActivity;
use Tests\Fixtures\TestWorkflow;
use Tests\TestCase;
use Workflow\Signal;
use Workflow\States\WorkflowCompletedStatus;
use Workflow\WorkflowStub;

final class WorkflowStubTest extends TestCase
{
    public function testCompleted(): void
    {
        $workflow = WorkflowStub::make(TestWorkflow::class);

        $workflow->start(shouldAssert: false);

        $workflow->cancel();

        while (! $workflow->isCanceled());

        while ($workflow->running());

        $this->assertSame(WorkflowCompletedStatus::class, $workflow->status());
        $this->assertSame('workflow_activity_other', $workflow->output());
        $this->assertSame([TestActivity::class, TestOtherActivity::class, Signal::class], $workflow->logs()
            ->pluck('class')
            ->sort()
            ->values()
            ->toArray());
    }
}
