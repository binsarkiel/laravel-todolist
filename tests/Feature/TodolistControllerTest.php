<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "binsarkiel",
            "todolist" => [
                [
                    'id' => '1',
                    'todo' => 'Kiel'
                ],
                [
                    'id' => '2',
                    'todo' => 'Binsar'
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText('1')
            ->assertSeeText('Kiel')
            ->assertSeeText('2')
            ->assertSeeText('Binsar');
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            'user' => 'binsarkiel'
        ])->post('/todolist', [])
            ->assertSeeText('Todo is required');
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            'user' => 'binsarkiel'
        ])->post('/todolist', [
            'todo' => 'Kiel'
        ])->assertRedirect('/todolist');
    }
}
