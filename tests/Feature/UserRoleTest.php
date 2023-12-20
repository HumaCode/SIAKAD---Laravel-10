<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_role_exists(): void
    {
        $this->assertTrue(\Schema::hasColumn('users', 'role'));
    }
}
