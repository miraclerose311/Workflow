<?php

namespace Tests\Fixtures;

use Workflow\SignalMethod;
use Workflow\Workflow;
use Workflow\WorkflowStub;

class TestAwaitWorkflow extends Workflow
{
    private bool $canceled = false;

    #[SignalMethod]
    public function cancel()
    {
        $this->canceled = true;
    }

    public function execute()
    {
        yield WorkflowStub::await(fn () => $this->canceled);

        return 'workflow';
    }
}
