<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ToastrHelper;
use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends SuperAdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get the current language
        $language = $request->query('lang', 'en');

        // Get multilingual setting
        $multilingual = WebsiteSetting::where('key', 'multilingual_enabled')->first();
        $isMultilingual = $multilingual && $multilingual->value == '1';

        // Get all settings
        $settings = WebsiteSetting::all();

        // Get settings for each group
        $generalSettings = $settings->where('group', 'general')->sortBy('order');
        $contactSettings = $settings->where('group', 'contact')->sortBy('order');
        $socialSettings = $settings->where('group', 'social')->sortBy('order');
        $footerSettings = $settings->where('group', 'footer')->sortBy('order');
        $languageSettings = $settings->where('group', 'language')->sortBy('order');

        // If multilingual is enabled and language is Indonesian, use value_id
        if ($isMultilingual && $language == 'id') {
            foreach ($generalSettings as $setting) {
                $setting->original_value = $setting->value;
                if (!empty($setting->value_id)) {
                    $setting->value = $setting->value_id;
                }
            }

            foreach ($contactSettings as $setting) {
                $setting->original_value = $setting->value;
                if (!empty($setting->value_id)) {
                    $setting->value = $setting->value_id;
                }
            }

            foreach ($socialSettings as $setting) {
                $setting->original_value = $setting->value;
                if (!empty($setting->value_id)) {
                    $setting->value = $setting->value_id;
                }
            }

            foreach ($footerSettings as $setting) {
                $setting->original_value = $setting->value;
                if (!empty($setting->value_id)) {
                    $setting->value = $setting->value_id;
                }
            }
        }

        return view('admin.settings.index', compact(
            'settings',
            'generalSettings',
            'contactSettings',
            'socialSettings',
            'footerSettings',
            'languageSettings',
            'isMultilingual',
            'language'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Get the current language from the request
        $language = $request->get('lang', app()->getLocale());
        // Handle multilingual setting first
        $multilingualEnabled = $request->has('multilingual_enabled') ? '1' : '0';
        WebsiteSetting::updateOrCreate(
            ['key' => 'multilingual_enabled'],
            [
                'value' => $multilingualEnabled,
                'display_name' => 'Enable Multilingual',
                'type' => 'boolean',
                'group' => 'language',
                'is_public' => true,
                'description' => 'Enable or disable multilingual support'
            ]
        );

        // Handle file uploads
        $fileFields = ['website_logo', 'website_favicon', 'og_image'];
        foreach ($fileFields as $field) {
            // Check if file is in the request directly
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('settings', $filename, 'public');

                // Update or create the setting
                WebsiteSetting::updateOrCreate(
                    ['key' => $field],
                    [
                        'value' => $path,
                        'group' => 'general',
                        'type' => 'image',
                        'is_public' => true
                    ]
                );
            }
            // Check if file is in the settings array
            elseif ($request->hasFile("settings.$field")) {
                $file = $request->file("settings.$field");
                $filename = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('settings', $filename, 'public');

                // Update or create the setting
                WebsiteSetting::updateOrCreate(
                    ['key' => $field],
                    [
                        'value' => $path,
                        'group' => 'general',
                        'type' => 'image',
                        'is_public' => true
                    ]
                );
            }
        }

        // Handle color fields
        $colorFields = ['primary_color', 'secondary_color'];
        foreach ($colorFields as $field) {
            $settingKey = str_replace('settings.', '', $field);

            // Check if the field is in the request directly
            if ($request->has($field) && $request->$field) {
                $value = $request->$field;
                // Ensure color value starts with #
                if (substr($value, 0, 1) !== '#') {
                    $value = '#' . $value;
                }

                WebsiteSetting::updateOrCreate(
                    ['key' => $settingKey],
                    [
                        'value' => $value,
                        'group' => 'general',
                        'type' => 'color',
                        'is_public' => true
                    ]
                );
            }
            // Check if the field is in the settings array
            elseif ($request->has("settings.$settingKey")) {
                $value = $request->input("settings.$settingKey");
                // Ensure color value starts with #
                if (!empty($value) && substr($value, 0, 1) !== '#') {
                    $value = '#' . $value;
                }

                WebsiteSetting::updateOrCreate(
                    ['key' => $settingKey],
                    [
                        'value' => $value,
                        'group' => 'general',
                        'type' => 'color',
                        'is_public' => true
                    ]
                );
            }
        }

        // Handle language settings
        if ($request->has('available_languages')) {
            $availableLanguages = $request->available_languages;
            $availableLanguagesSetting = WebsiteSetting::where('key', 'available_languages')->first();

            if ($availableLanguagesSetting) {
                $availableLanguagesSetting->value = json_encode($availableLanguages);
                $availableLanguagesSetting->save();
            } else {
                WebsiteSetting::create([
                    'key' => 'available_languages',
                    'display_name' => 'Available Languages',
                    'value' => json_encode($availableLanguages),
                    'type' => 'json',
                    'group' => 'language',
                    'is_public' => false,
                    'options' => null,
                    'description' => 'The languages available for the website.',
                ]);
            }

            // Update the default_language options
            $defaultLanguageSetting = WebsiteSetting::where('key', 'default_language')->first();
            if ($defaultLanguageSetting) {
                $defaultLanguageSetting->options = json_encode($availableLanguages);
                $defaultLanguageSetting->save();
            }
        }

        // Handle language codes and names
        if ($request->has('language_codes') && $request->has('language_names')) {
            $languageCodes = $request->language_codes;
            $languageNames = $request->language_names;

            if (count($languageCodes) === count($languageNames)) {
                $availableLanguages = [];

                for ($i = 0; $i < count($languageCodes); $i++) {
                    if (!empty($languageCodes[$i]) && !empty($languageNames[$i])) {
                        $availableLanguages[$languageCodes[$i]] = $languageNames[$i];
                    }
                }

                if (!empty($availableLanguages)) {
                    $availableLanguagesSetting = WebsiteSetting::where('key', 'available_languages')->first();
                    if ($availableLanguagesSetting) {
                        $availableLanguagesSetting->value = json_encode($availableLanguages);
                        $availableLanguagesSetting->save();
                    } else {
                        // Create the setting if it doesn't exist
                        WebsiteSetting::create([
                            'key' => 'available_languages',
                            'display_name' => 'Available Languages',
                            'value' => json_encode($availableLanguages),
                            'type' => 'json',
                            'group' => 'language',
                            'is_public' => false,
                            'options' => null,
                            'description' => 'The languages available for the website.',
                        ]);
                    }

                    // Update the default_language options
                    $defaultLanguageSetting = WebsiteSetting::where('key', 'default_language')->first();
                    if ($defaultLanguageSetting) {
                        $defaultLanguageSetting->options = json_encode($availableLanguages);
                        $defaultLanguageSetting->save();
                    }
                }
            }
        }

        // Handle regular settings from the settings array
        if ($request->has('settings')) {
            $settingsArray = $request->settings;

            foreach ($settingsArray as $key => $value) {
                // Skip files and colors as they're handled separately
                if (in_array($key, ['website_logo', 'website_favicon', 'og_image', 'primary_color', 'secondary_color'])) {
                    continue;
                }

                // Check if this is a multilingual field
                $isMultilingualField = false;
                $originalKey = $key;

                // If key ends with _id, it's an Indonesian value
                if (substr($key, -3) === '_id' && $key != 'google_analytics_id') {
                    $isMultilingualField = true;
                    $originalKey = substr($key, 0, -3);
                    $setting = WebsiteSetting::where('key', $originalKey)->first();
                } else {
                    $setting = WebsiteSetting::where('key', $key)->first();
                }
                if ($setting) {
                    // Update the appropriate field based on language
                    if ($isMultilingualField) {
                        $setting->value_id = $value;
                    } else {
                        $setting->value = $value;
                    }
                    $setting->save();
                } else {
                    // Determine the appropriate group for the setting
                    $group = 'general';
                    if (in_array($key, ['contact_email', 'contact_phone', 'contact_address', 'admin_email'])) {
                        $group = 'contact';
                    } elseif (in_array($key, ['facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'youtube_url'])) {
                        $group = 'social';
                    } elseif (in_array($key, ['meta_description', 'meta_keywords', 'google_analytics_id'])) {
                        $group = 'seo';
                    } elseif (in_array($key, ['footer_text', 'footer_scripts'])) {
                        $group = 'footer';
                    } elseif (in_array($key, ['multilingual_enabled', 'default_language', 'available_languages'])) {
                        $group = 'language';
                    }

                    // Create a new setting if it doesn't exist
                    WebsiteSetting::create([
                        'key' => $key,
                        'value' => $value,
                        'group' => $group,
                        'is_public' => !in_array($key, ['admin_email']), // admin_email should not be public
                    ]);
                }
            }
        }

        // Handle regular settings from direct request parameters
        $settings = $request->except([
            '_token', '_method', 'settings', 'available_languages', 'multilingual_enabled',
            'website_logo', 'website_favicon', 'og_image', 'primary_color', 'secondary_color',
            'language_codes', 'language_names'
        ]);

        foreach ($settings as $key => $value) {
            // Skip files and colors as they're handled separately
            if (in_array($key, ['website_logo', 'website_favicon', 'og_image', 'primary_color', 'secondary_color'])) {
                continue;
            }

            // Check if this is a multilingual field
            $isMultilingualField = false;
            $originalKey = $key;

            // If key ends with _id, it's an Indonesian value
            if (substr($key, -3) === '_id') {
                $isMultilingualField = true;
                $originalKey = substr($key, 0, -3);
                $setting = WebsiteSetting::where('key', $originalKey)->first();
            } else {
                $setting = WebsiteSetting::where('key', $key)->first();
            }

            if ($setting) {
                // Update the appropriate field based on language
                if ($isMultilingualField) {
                    $setting->value_id = $value;
                } else {
                    $setting->value = $value;
                }
                $setting->save();
            } else {
                // Determine the appropriate group for the setting
                $group = 'general';
                if (in_array($key, ['contact_email', 'contact_phone', 'contact_address', 'admin_email'])) {
                    $group = 'contact';
                } elseif (in_array($key, ['facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'youtube_url'])) {
                    $group = 'social';
                } elseif (in_array($key, ['meta_description', 'meta_keywords', 'google_analytics_id'])) {
                    $group = 'seo';
                } elseif (in_array($key, ['footer_text', 'footer_scripts'])) {
                    $group = 'footer';
                } elseif (in_array($key, ['multilingual_enabled', 'default_language', 'available_languages'])) {
                    $group = 'language';
                }

                // Create a new setting if it doesn't exist
                WebsiteSetting::create([
                    'key' => $key,
                    'value' => $value,
                    'group' => $group,
                    'is_public' => !in_array($key, ['admin_email']), // admin_email should not be public
                ]);
            }
        }



        // Clear settings cache
        app('App\Helpers\SettingsHelper')->clearCache();

        $this->success('Settings updated successfully');

        // Redirect back to the same language tab
        return redirect()->route('admin.settings.index', ['lang' => $language]);
    }

    /**
     * Show a success message.
     *
     * @param string $message
     * @param string $title
     * @return void
     */
    protected function success($message, $title = 'Success')
    {
        ToastrHelper::success($message, $title);
    }

    /**
     * Show an error message.
     *
     * @param string $message
     * @param string $title
     * @return void
     */
    protected function error($message, $title = 'Error')
    {
        ToastrHelper::error($message, $title);
    }
}
