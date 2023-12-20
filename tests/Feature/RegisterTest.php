<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_membuka_halaman_register(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('register');
    }

    public function test_proses_pendaftaran()
    {
        $data_pendaftaran = [
            'name' => 'budi',
            'email' => 'budi@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $response = $this->post('register', $data_pendaftaran);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}
