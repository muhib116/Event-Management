<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Utils;
use Illuminate\Http\FileHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SettingController extends Controller
{
    use Utils;
    public function index() {
        $settings = SiteSetting::all()->map(function($s) {
            if ($s->name == 'home_banner_image') {
                $s->value = asset($s->value);
            }
            return $s;
        });
        return Inertia::render('Settings', [
            'site_settings' => $settings
        ]);
    }
    
    public function save(Request $request) {
        $request->validate([
            'commission' => 'required|numeric',
            'currency' => 'required',
            'home_banner_image' => 'nullable|image',
            'logo_image' => 'nullable|image',
            'footer_logo_image' => 'nullable|image',
            'home_banner_text' => 'required',
        ]);
        try {
            DB::beginTransaction();
            SiteSetting::updateOrCreate(['name' => 'commission',],[
                'name' => 'commission',
                'value' => $request->commission,
            ]);
            SiteSetting::updateOrCreate(['name' => 'currency'],[
                'name' => 'currency',
                'value' => $request->currency,
            ]);
            if ($request->hasFile('home_banner_image')) {
                $file = $request->file('home_banner_image');
                $uniqueCode = md5(uniqid(rand(), true));
                $file_name  = $request->type.'-'.$uniqueCode.'-'.$file->getClientOriginalName();
                
                $old = SiteSetting::where('name', 'home_banner_image')->first();
                $image = $this->imageUpload($request, 'home_banner_image', 'images');
                SiteSetting::updateOrCreate(['name' => 'home_banner_image'],[
                    'name' => 'home_banner_image',
                    'value' => $image,
                ]);
            }
            if ($request->hasFile('logo_image')) {
                $file = $request->file('logo_image');
                $uniqueCode = md5(uniqid(rand(), true));
                $file_name  = $request->type.'-'.$uniqueCode.'-'.$file->getClientOriginalName();
                
                $old = SiteSetting::where('name', 'logo_image')->first();
                $image = $this->imageUpload($request, 'logo_image', 'images');

                SiteSetting::updateOrCreate(['name' => 'logo_image'],[
                    'name' => 'logo_image',
                    'value' => $image,
                ]);
            }
            if ($request->hasFile('footer_logo_image')) {
                $file = $request->file('footer_logo_image');
                $uniqueCode = md5(uniqid(rand(), true));
                $file_name  = $request->type.'-'.$uniqueCode.'-'.$file->getClientOriginalName();
                
                $old = SiteSetting::where('name', 'footer_logo_image')->first();
                $image = $this->imageUpload($request, 'footer_logo_image', 'images');

                SiteSetting::updateOrCreate(['name' => 'footer_logo_image'],[
                    'name' => 'footer_logo_image',
                    'value' => $image,
                ]);
            }
            SiteSetting::updateOrCreate(['name' => 'home_banner_text'],[
                'name' => 'home_banner_text',
                'value' => $request->home_banner_text,
            ]);

            SiteSetting::updateOrCreate(['name' => 'facebook_link'],[
                'name' => 'facebook_link',
                'value' => $request->facebook_link,
            ]);
            SiteSetting::updateOrCreate(['name' => 'twitter_link'],[
                'name' => 'twitter_link',
                'value' => $request->twitter_link,
            ]);
            SiteSetting::updateOrCreate(['name' => 'tiktok_link'],[
                'name' => 'tiktok_link',
                'value' => $request->tiktok_link,
            ]);
            SiteSetting::updateOrCreate(['name' => 'instagram_link'],[
                'name' => 'instagram_link',
                'value' => $request->instagram_link,
            ]);
            SiteSetting::updateOrCreate(['name' => 'youtube_link'],[
                'name' => 'youtube_link',
                'value' => $request->youtube_link,
            ]);
            SiteSetting::updateOrCreate(['name' => 'telegram_link'],[
                'name' => 'telegram_link',
                'value' => $request->telegram_link,
            ]);
            DB::commit();
            return back()->with('success', 'Settings update successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Opps! Something wrong');
        }
    }
}
