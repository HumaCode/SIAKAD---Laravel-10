<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginAdminTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_login_page_ok(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('login');
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('type="submit"', false);
    }

    public function test_login_admin_ok(): void
    {
        $user = new User([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('12345678'),
        ]);

        $user->role = 'admin';
        $user->save();

        $response = $this->post('/login', [
            'email'     => 'admin@gmail.com',
            'password'  => '12345678'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/beranda');
    }

    public function test_login_tanpa_role_gagal(): void
    {
        $user = new User([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('12345678'),
        ]);

        $user->role = 'unknown';
        $user->save();

        $response = $this->post('/login', [
            'email'     => 'admin@gmail.com',
            'password'  => '12345678'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
}
