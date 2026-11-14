<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage1_can_be_rendered(): void
    {
        $response = $this->get(route('homepage1'));

        $response->assertStatus(200);
        $response->assertSee('ZARABEL', false);
        $response->assertSee('Sign In');
        $response->assertSee('Sign Up');
    }

    public function test_homepage2_requires_authentication(): void
    {
        $response = $this->get(route('homepage2'));

        $response->assertRedirect(route('login'));
    }

    public function test_homepage2_can_be_rendered_for_authenticated_users(): void
    {
        $user = User::factory()->create([
            'name' => 'Sarah Amberi',
        ]);

        $response = $this->actingAs($user)->get(route('homepage2'));

        $response->assertStatus(200);
        $response->assertSee('Sarah Amberi');
        $response->assertSee('Log Out');
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertSee('Sign In with Google');
        $response->assertSee('Sign In');
    }

    public function test_register_screen_can_be_rendered(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertSee('Sign Up with Google');
        $response->assertSee('Register');
    }

    public function test_users_can_register_and_are_redirected_to_homepage2(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Sarah Amberi',
            'email' => 'sarah@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('homepage2'));

        $this->assertDatabaseHas('users', [
            'name' => 'Sarah Amberi',
            'email' => 'sarah@example.com',
        ]);
    }

    public function test_users_can_login_and_are_redirected_to_homepage2(): void
    {
        $user = User::factory()->create([
            'email' => 'sarah@example.com',
            'password' => Hash::make('Password123!'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'sarah@example.com',
            'password' => 'Password123!',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('homepage2'));
    }

    public function test_users_cannot_login_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'email' => 'sarah@example.com',
            'password' => Hash::make('Password123!'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'sarah@example.com',
            'password' => 'WrongPassword',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirect(route('homepage1'));
    }

    public function test_mock_google_login_authenticates_and_redirects_to_homepage2(): void
    {
        $response = $this->get(route('google.redirect', ['mock' => 1]));

        $this->assertAuthenticated();
        $response->assertRedirect(route('homepage2'));
    }

    public function test_google_callback_authenticates_user_and_redirects_to_homepage2(): void
    {
        $socialiteUser = Mockery::mock(SocialiteUser::class);
        $socialiteUser->shouldReceive('getId')->andReturn('google-id-12345');
        $socialiteUser->shouldReceive('getName')->andReturn('Google User Test');
        $socialiteUser->shouldReceive('getNickname')->andReturn('googleuser');
        $socialiteUser->shouldReceive('getEmail')->andReturn('google.tester@example.com');
        $socialiteUser->shouldReceive('getAvatar')->andReturn('https://example.com/avatar.jpg');

        $provider = Mockery::mock('Laravel\Socialite\Two\GoogleProvider');
        $provider->shouldReceive('user')->andReturn($socialiteUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->get(route('google.callback'));

        $this->assertAuthenticated();
        $response->assertRedirect(route('homepage2'));

        $this->assertDatabaseHas('users', [
            'email' => 'google.tester@example.com',
            'google_id' => 'google-id-12345',
        ]);
    }

    public function test_catalog_page_can_be_rendered(): void
    {
        $response = $this->get(route('catalog'));

        $response->assertStatus(200);
        $response->assertSee('All Products');
        $response->assertSee('Category');
        $response->assertSee('Price');
    }

    public function test_forgot_password_flow(): void
    {
        $response = $this->post(route('password.send_code'), [
            'email' => 'sarah@example.com',
        ]);

        $response->assertRedirect(route('password.confirm'));

        $response = $this->post(route('password.verify_code'), [
            'digits' => ['1', '2', '3', '4'],
        ]);

        $response->assertRedirect(route('password.new'));
    }
}

