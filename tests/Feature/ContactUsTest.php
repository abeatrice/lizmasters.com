<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactUsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function contact_email_can_be_sent()
    {
        $this->actingAs($this->admin());

        Mail::fake();

        Mail::assertNothingSent();

        $attributes = [
            "name" => $this->faker->name,
            "email" => $this->faker->email,
            "subject" => $this->faker->sentence,
            "message" => $this->faker->paragraph
        ];

        $this->post('/contact-us', $attributes)->assertSessionHas('status', 'Message Delivered!');

        Mail::assertSent(ContactUs::class, 1);
    }
}
