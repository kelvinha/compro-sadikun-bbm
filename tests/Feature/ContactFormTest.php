<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ContactMessage;
use App\Models\WebsiteSetting;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create basic website settings for tests
        WebsiteSetting::create([
            'group' => 'general',
            'key' => 'website_logo',
            'value' => 'logo.png',
            'type' => 'file',
            'display_name' => 'Website Logo',
            'is_public' => true,
            'order' => 1
        ]);

        WebsiteSetting::create([
            'group' => 'general',
            'key' => 'website_name',
            'value' => 'Test Website',
            'type' => 'text',
            'display_name' => 'Website Name',
            'is_public' => true,
            'order' => 2
        ]);

        // Create contact settings required by footer
        WebsiteSetting::create([
            'group' => 'contact',
            'key' => 'contact_email',
            'value' => 'test@example.com',
            'type' => 'email',
            'display_name' => 'Contact Email',
            'is_public' => true,
            'order' => 1
        ]);

        WebsiteSetting::create([
            'group' => 'contact',
            'key' => 'contact_phone',
            'value' => '+1234567890',
            'type' => 'text',
            'display_name' => 'Contact Phone',
            'is_public' => true,
            'order' => 2
        ]);

        WebsiteSetting::create([
            'group' => 'contact',
            'key' => 'contact_address',
            'value' => '123 Test Street, Test City',
            'type' => 'textarea',
            'display_name' => 'Contact Address',
            'is_public' => true,
            'order' => 3
        ]);

        // Create social media settings that might be used in footer
        WebsiteSetting::create([
            'group' => 'social',
            'key' => 'social_facebook',
            'value' => 'https://facebook.com/test',
            'type' => 'url',
            'display_name' => 'Facebook URL',
            'is_public' => true,
            'order' => 1
        ]);

        WebsiteSetting::create([
            'group' => 'social',
            'key' => 'social_twitter',
            'value' => 'https://twitter.com/test',
            'type' => 'url',
            'display_name' => 'Twitter URL',
            'is_public' => true,
            'order' => 2
        ]);

        WebsiteSetting::create([
            'group' => 'social',
            'key' => 'social_instagram',
            'value' => 'https://instagram.com/test',
            'type' => 'url',
            'display_name' => 'Instagram URL',
            'is_public' => true,
            'order' => 3
        ]);

        WebsiteSetting::create([
            'group' => 'social',
            'key' => 'social_linkedin',
            'value' => 'https://linkedin.com/test',
            'type' => 'url',
            'display_name' => 'LinkedIn URL',
            'is_public' => true,
            'order' => 4
        ]);

        WebsiteSetting::create([
            'group' => 'social',
            'key' => 'social_youtube',
            'value' => 'https://youtube.com/test',
            'type' => 'url',
            'display_name' => 'YouTube URL',
            'is_public' => true,
            'order' => 5
        ]);

        // Create or update website logo setting
        WebsiteSetting::updateOrCreate(
            ['key' => 'website_logo'],
            [
                'group' => 'general',
                'value' => 'test-logo.png',
                'type' => 'image',
                'display_name' => 'Website Logo',
                'is_public' => true,
                'order' => 1
            ]
        );

        // Create or update website name setting
        WebsiteSetting::updateOrCreate(
            ['key' => 'website_name'],
            [
                'group' => 'general',
                'value' => 'Test Company',
                'type' => 'text',
                'display_name' => 'Website Name',
                'is_public' => true,
                'order' => 2
            ]
        );

        // Create or update meta description setting
        WebsiteSetting::updateOrCreate(
            ['key' => 'meta_description'],
            [
                'group' => 'seo',
                'value' => 'Test company description',
                'type' => 'textarea',
                'display_name' => 'Meta Description',
                'is_public' => true,
                'order' => 1
            ]
        );

        // Create or update meta keywords setting
        WebsiteSetting::updateOrCreate(
            ['key' => 'meta_keywords'],
            [
                'group' => 'seo',
                'value' => 'test, company, keywords',
                'type' => 'text',
                'display_name' => 'Meta Keywords',
                'is_public' => true,
                'order' => 2
            ]
        );
    }

    /** @test */
    public function contact_page_loads_successfully()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('CONTACT US');
        $response->assertSee('Security Question');
        // Check that CAPTCHA input field is present
        $response->assertSee('name="captcha"', false);
        $response->assertSee('type="number"', false);
    }

    /** @test */
    public function home_page_contact_form_has_captcha()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        // Check that home page contact form has CAPTCHA
        $response->assertSee('Security Question');
        $response->assertSee('name="captcha"', false);
        $response->assertSee('id="home_captcha"', false);
    }

    /** @test */
    public function contact_form_submission_with_valid_data_creates_message()
    {
        // Set up CAPTCHA in session
        session([
            'captcha_num1' => 5,
            'captcha_num2' => 3,
            'captcha_answer' => 8
        ]);

        $formData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1234567890',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
            'captcha' => 8
        ];

        $response = $this->post('/contact', $formData);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('success', 'Your message has been sent successfully. We will get back to you soon!');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1234567890',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
            'status' => 'pending'
        ]);
    }

    /** @test */
    public function contact_form_submission_with_invalid_captcha_fails()
    {
        // Set up CAPTCHA in session
        session([
            'captcha_num1' => 5,
            'captcha_num2' => 3,
            'captcha_answer' => 8
        ]);

        $formData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
            'captcha' => 7 // Wrong answer
        ];

        $response = $this->post('/contact', $formData);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'CAPTCHA verification failed. Please try again.');

        $this->assertDatabaseMissing('contact_messages', [
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);
    }

    /** @test */
    public function contact_form_submission_with_missing_required_fields_fails()
    {
        // Set up CAPTCHA in session
        session([
            'captcha_num1' => 5,
            'captcha_num2' => 3,
            'captcha_answer' => 8
        ]);

        $formData = [
            'name' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => '',
            'captcha' => 8
        ];

        $response = $this->post('/contact', $formData);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    /** @test */
    public function contact_form_submission_without_phone_works()
    {
        // Set up CAPTCHA in session
        session([
            'captcha_num1' => 5,
            'captcha_num2' => 3,
            'captcha_answer' => 8
        ]);

        $formData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message without phone.',
            'captcha' => 8
        ];

        $response = $this->post('/contact', $formData);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => null,
            'subject' => 'Test Subject',
            'message' => 'This is a test message without phone.',
            'status' => 'pending'
        ]);
    }
}
