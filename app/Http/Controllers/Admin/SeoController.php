<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SettingsHelper;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class SeoController extends SuperAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $seoSettings = WebsiteSetting::where('group', 'seo')->orderBy('order')->get();
        
        return view('admin.seo.index', compact('seoSettings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $settings = $request->except('_token');
        
        foreach ($settings as $key => $value) {
            $setting = WebsiteSetting::where('key', $key)->first();
            
            if ($setting) {
                // Handle file uploads
                if ($setting->type == 'image' && $request->hasFile($key)) {
                    $file = $request->file($key);
                    $filename = $key . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/settings', $filename);
                    $value = 'settings/' . $filename;
                }
                
                $setting->value = $value;
                $setting->save();
            }
        }
        
        // Clear settings cache
        SettingsHelper::clearCache();
        
        $this->success('SEO settings updated successfully');
        
        return redirect()->route('seo.index');
    }
}
