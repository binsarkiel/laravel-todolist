<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo('1', 'Kiel');

        $todolist = Session::get('todolist');
        foreach ($todolist as $value) {
            self::assertEquals('1', $value['id']);
            self::assertEquals('Kiel', $value['todo']);
        }
    }

    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodolist());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'Kiel',
            ],
            [
                'id' => '2',
                'todo' => 'Binsar',
            ]
        ];

        $this->todolistService->saveTodo('1', 'Kiel');
        $this->todolistService->saveTodo('2','Binsar');

        self::assertEquals($expected, $this->todolistService->getTodolist());
    }

}
