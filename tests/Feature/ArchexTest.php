<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArchexTest extends TestCase
{
    // use RefreshDatabase; // Don't wipe the seeded database, or use it and re-seed?
    // Better to use RefreshDatabase and seed in test to be isolated.
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\GameSeeder::class);
    }

    public function test_home_page_loads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('ARCHEX');
        $response->assertSee('Cyberpunk 2077');
    }

    public function test_game_details_page_loads()
    {
        $game = Game::first();
        $response = $this->get(route('games.show', $game));
        $response->assertStatus(200);
        $response->assertSee($game->title);
    }

    public function test_cart_page_loads()
    {
        $response = $this->get(route('cart.index'));
        $response->assertStatus(200);
    }

    public function test_can_add_to_cart()
    {
        $game = Game::first();
        $response = $this->post(route('cart.add', $game));
        $response->assertRedirect(); // Back
        
        $this->assertDatabaseHas('cart_items', [
            'game_id' => $game->id,
            'quantity' => 1
        ]);
    }
    
    public function test_checkout_redirects_guest()
    {
        $response = $this->get(route('checkout.index'));
        // Currently checkout index might allow view if cart not empty?
        // Logic: CheckoutController::index -> if cart empty redirects to cart.
        // But logic for guest access to checkout page itself was: `Route::middleware('auth')->group(...)` in web.php
        // So it should redirect to login.
        $response->assertRedirect(route('login'));
    }

    public function test_checkout_accessible_by_auth_user()
    {
        $user = User::factory()->create();
        $game = Game::first();
        
        $this->actingAs($user)
             ->post(route('cart.add', $game)); // Add to cart first

        $response = $this->actingAs($user)->get(route('checkout.index'));
        $response->assertStatus(200);
    }
}
