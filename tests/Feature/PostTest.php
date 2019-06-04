<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Post;
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

        $storageLocation = 'images/' . $file->hashName();

        $this->assertDatabaseHas('posts', 
            collect($attributes)->map(function ($attribute, $key) use($storageLocation) {
                
                if($key == 'image_path') return $storageLocation;

                return $attribute;

            })->toArray()
        );

        $this->get('posts')->assertSee($attributes['title']);

        Storage::disk('public')->assertExists($storageLocation);

        Storage::disk('public')->assertMissing('missing.jpg');
    }

    /** @test */
    public function admin_can_edit_posts()
    {
        $this->actingAs($this->admin());

        $post = factory(Post::class)->create();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'published' => $this->faker->randomElement(['0', '1'])
        ];

        $this->put($post->path(), $attributes)->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', $attributes);

        $this->get('posts')->assertSee($attributes['title']);
    }

    /** @test */
    public function admin_can_delete_post()
    {
        $this->actingAs($this->admin());

        $post = factory(Post::class)->create();

        $this->assertDatabaseHas('posts', $post->toArray());

        $this->delete($post->path())->assertRedirect('/posts');

        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    /** @test */
    public function admin_can_change_post_sort_order_up()
    {
        $this->actingAs($this->admin());

        $post1 = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();

        $this->post("/posts/{$post1->id}/order/up")->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', [
            'title' => $post1->title,
            'sort_order' => $post1->sort_order + 1,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => $post2->title,
            'sort_order' => $post2->sort_order - 1,
        ]);
    }

    /** @test */
    public function admin_can_change_post_sort_order_down()
    {
        $this->actingAs($this->admin());

        $post1 = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();

        $this->post("/posts/{$post2->id}/order/down")->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', [
            'title' => $post2->title,
            'sort_order' => $post2->sort_order - 1,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => $post1->title,
            'sort_order' => $post1->sort_order + 1,
        ]);
    }

    /** @test */
    public function max_sort_order_moved_up_has_no_change()
    {
        $this->actingAs($this->admin());

        $post1 = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();

        $this->post("/posts/{$post2->id}/order/up")->assertRedirect('/posts');
        
        $this->assertDatabaseHas('posts', [
            'title' => $post1->title,
            'sort_order' => $post1->sort_order,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => $post2->title,
            'sort_order' => $post2->sort_order,
        ]);
    }

    /** @test */
    public function min_sort_order_moved_down_has_no_change()
    {
        $this->actingAs($this->admin());

        $post1 = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();

        $this->post("/posts/{$post1->id}/order/down")->assertRedirect('/posts');
        
        $this->assertDatabaseHas('posts', [
            'title' => $post1->title,
            'sort_order' => $post1->sort_order,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => $post2->title,
            'sort_order' => $post2->sort_order,
        ]);
    }
}
