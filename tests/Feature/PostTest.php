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
    public function admin_can_create_posts()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->admin());

        Storage::fake('images');

        $file = UploadedFile::fake()->image('image.jpg');

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'published' => $this->faker->randomElement(['0', '1']) ,
            'image' => $file
        ];

        $this->post('/posts', $attributes)->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', Arr::except($attributes, ['image']));

        $this->get('posts')->assertSee($attributes['title']);

        Storage::disk('images')->assertExists($file);

        //Storage::disk('images')->assertMissing('missing.jpg');
    }
}
