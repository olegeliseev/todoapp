<?php

namespace Tests\Unit;

use App\Models\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function test_task_update()
    {
        $taskMock = $this->createMock(Task::class);

        $taskMock->expects($this->once())
            ->method('update')
            ->with(['title' => 'Новое название задачи', 'completed' => true])
            ->willReturn(true);

        $updateStatus = $taskMock->update(['title' => 'Новое название задачи', 'completed' => true]);

        $this->assertTrue($updateStatus);
    }

    public function test_task_deletion()
    {
        $taskMock = $this->createMock(Task::class);

        $taskMock->expects($this->once())
            ->method('delete')
            ->willReturn(true);

        $deleteStatus = $taskMock->delete();

        $this->assertTrue($deleteStatus);
    }
}
