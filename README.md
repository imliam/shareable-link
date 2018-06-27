# Shareable Links

## Introduction

Conveniently generate shareable URLs for a variety of different social media websites, using the syntax each uses for their own links.

## Example Usage

```php
$url = new ShareableLink('http://example.com/', 'Example Site');

// Alternatively, with the helper function:
// shareable_link('http://example.com/', 'Example Site');

echo $url->facebook;
// https://www.facebook.com/dialog/share?app_id=ABC123&href=https://example.com/&display=page&title=Example+Site

echo $url->twitter;
// https://twitter.com/intent/tweet?url=https://example.com/&text=Example+Site

echo $url->whatsapp;
// https://wa.me/?text=Example+Site+https%3A%2F%2Fexample.com%2F

echo $url->linkedin;
// https://www.linkedin.com/shareArticle?mini=true&url=https://example.com/&summary=Example+Site

echo $url->pinterest;
// https://pinterest.com/pin/create/button/?media=&url=https://example.com/&description=Example+Site

echo $url->google;
// https://plus.google.com/share?url=https://example.com/
```

## Facebook Link Notes

A link shareable through Facebook requires an app ID from the platform. By default, this will attempt to be obtained through a `FACEBOOK_APP_ID` environment variable. However, if this environment variable does not exist, or you need to pass through different app IDs for different URLs, you can pass one through explicitly to the `getFacebookUrl()` method.

```php
$url = new ShareableLink('http://example.com/', 'Example Site');

putenv('FACEBOOK_APP_ID=ABC123');

echo $url->facebook;
// https://www.facebook.com/dialog/share?app_id=ABC123&href=https://example.com/&display=page&title=Example+Site

echo $url->getFacebookUrl('XYZ789');
// https://www.facebook.com/dialog/share?app_id=XYZ789&href=https://example.com/&display=page&title=Example+Site
```

## Laravel Model Trait

If you're using Laravel and want to be able to use these methods directly from an Eloquent model as a convenient method, you can simply create one.

The advantage of this is that you get full control over the URL and title you want to be used while still keeping a fluent syntax.

```php
class News extends Model
{
    public function getShareUrlAttribute(): ShareableLink
    {
        $url = route('news.show', $this->slug);

        return new ShareableLink($url, $this->title);
    }
}
```

You can then proceed to use the pseudo-attribute method as you would use the normal class.

```php
$news->share_url->twitter;
```

## Credits

- [Denis Smink](https://dennissmink.nl/) for the [original article](https://medium.com/@dennissmink/laravel-shareable-trait-1a6b12a05094) that prompted this
