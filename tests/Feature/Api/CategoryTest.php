<?php

namespace Tests\Feature\Api;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_categories_list(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->getJson(route('categories.index'));

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJson([
                'data' => [Arr::only($category->toArray(), ['id', 'name'])]
            ]);
    }
    public function test_api_category_store_successful()
    {
        $category = ['id' => 1, 'name' => 'test category', 'description' => 'test'];
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('categories.store'), $category);

        $response->assertStatus(201)
            ->assertJson([
                    'data' => Arr::only($category, ['id', 'name'])]
            );
    }
}
