<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function admin_can_create_posts()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->admin());

        Storage::fake('images');

        $attributes = [
            'title' => $this->faker->sentence,
            'post_order' => 1,
            'description' => $this->faker->paragraph,
            'published' => $this->faker->boolean,
            'image' => UploadedFile::fake()->image('image.jpg')
        ];

        $this->post('/posts', $attributes)->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', $attributes);

        $this->get('posts')->assertSee($attributes['title']);

        Storage::disk('images')->assertExists('image.jpg');

        Storage::disk('images')->assertMissing('missing.jpg');
    }
}
