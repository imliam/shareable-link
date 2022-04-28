<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ImLiam\ShareableLink;

class ShareableLinkTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->url = new ShareableLink('https://example.com/', 'Example Site');
    }

    /** @test */
    public function it_can_generate_a_facebook_url_with_an_app_id_as_an_environment_variable()
    {
        // Environment variable is set in the phpunit.xml configuration file
        $this->assertEquals(
            $this->url->facebook,
            'https://www.facebook.com/dialog/share?app_id=FROM_ENV&href=https://example.com/&display=page&title=Example+Site'
        );

        // Explicitly set a new environment variable
        putenv('FACEBOOK_APP_ID=ABC123');
        $this->assertEquals(
            $this->url->facebook,
            'https://www.facebook.com/dialog/share?app_id=ABC123&href=https://example.com/&display=page&title=Example+Site'
        );
    }

    /** @test */
    public function it_can_generate_a_facebook_url_with_an_app_id_passed_to_it()
    {
        $this->assertEquals(
            $this->url->getFacebookUrl('XYZ789'),
            'https://www.facebook.com/dialog/share?app_id=XYZ789&href=https://example.com/&display=page&title=Example+Site'
        );
    }

    /** @test */
    public function it_can_generate_a_twitter_url()
    {
        $this->assertEquals(
            $this->url->twitter,
            'https://twitter.com/intent/tweet?url=https://example.com/&text=Example+Site'
        );
    }

    /** @test */
    public function it_can_generate_a_whatsapp_url()
    {
        $this->assertEquals(
            $this->url->whatsapp,
            'https://wa.me/?text=Example+Site+https%3A%2F%2Fexample.com%2F'
        );
    }

    /** @test */
    public function it_can_generate_a_linkedin_url()
    {
        $this->assertEquals(
            $this->url->linkedin,
            'https://www.linkedin.com/shareArticle?mini=true&url=https://example.com/&summary=Example+Site'
        );
    }

    /** @test */
    public function it_can_generate_a_pinterest_url()
    {
        $this->assertEquals(
            $this->url->pinterest,
            'https://pinterest.com/pin/create/button/?media=&url=https://example.com/&description=Example+Site'
        );
    }

    /** @test */
    public function it_can_generate_a_google_plus_url()
    {
        $this->assertEquals(
            $this->url->google,
            'https://plus.google.com/share?url=https://example.com/'
        );
    }

    /** @test */
    public function helper_function_can_generate_urls_too()
    {
        $url = shareable_link('https://example.com/', 'Example Site');

        $this->assertEquals(
            $url->twitter,
            'https://twitter.com/intent/tweet?url=https://example.com/&text=Example+Site'
        );
    }
}
