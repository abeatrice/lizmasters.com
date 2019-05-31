<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function only_admin_can_create_posts()
    {
        $user = factory('App\User')->make();

        $this->actingAs($user)->post('/posts')->assertStatus(403);
    }

    /** @test */
    public function valid_image_is_required()
    {

        $this->actingAs($this->admin());

        $response = $this->post('/posts', [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image_path' => 'notafile.jpg'
        ]);
        
        $response->assertSessionHasErrors(['image_path']);

    }

    /** @test */
    public function admin_can_create_posts()
    {

        $this->actingAs($this->admin());

        Storage::fake('public');

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'published' => $this->faker->randomElement(['0', '1']),
            'image_path' => $file = UploadedFile::fake()->image('image.jpg')
        ];

        $this->post('/posts', $attributes)->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', Arr::except($attributes, ['image_path']));

        $this->get('posts')->assertSee($attributes['title']);

        Storage::disk('public')->assertExists('images/'. $file->hashName());

        Storage::disk('public')->assertMissing('missing.jpg');
    }
}
