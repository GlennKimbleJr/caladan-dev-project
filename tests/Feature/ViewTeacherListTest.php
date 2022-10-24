<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTeacherListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_page_loads()
    {
        $this->get(route('main.index'))
            ->assertStatus(200)
            ->assertInertia(function ($page) {
                $page
                    ->component('index')
                    ->has('create_teacher_url')
                    ->has('flash_message');
            });
    }
}
