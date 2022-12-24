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
            SiteSetting::updateOrCreate(['name' => 'home_banner_text'],[
                'name' => 'home_banner_text',
                'value' => $request->home_banner_text,
            ]);
            DB::commit();
            return back()->with('success', 'Settings update successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Opps! Something wrong');
        }
    }
}
