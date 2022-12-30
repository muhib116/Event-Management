<?php

namespace App\Http\Middleware;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        $settings = SiteSetting::all();
        $logo = $settings->where('name', 'logo_image')->first();
        if ($logo) {
            $logo->value = asset($logo->value);
        }
        
        $footer_logo_image = $settings->where('name', 'footer_logo_image')->first();
        if ($footer_logo_image) {
            $footer_logo_image->value = asset($footer_logo_image->value);
        }
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'user' => auth()->user(),
            'settings' => [
                'commission' => $settings->where('name', 'commission')->first(),
                'currency' => $settings->where('name', 'currency')->first(),
                'home_banner_image' => $settings->where('name', 'home_banner_image')->first(),
                'home_banner_text' => $settings->where('name', 'home_banner_text')->first(),
                'logo_image' => $logo,
                'footer_logo_image' => $footer_logo_image,
                'facebook_link' => $settings->where('name', 'facebook_link')->first(),
                'twitter_link' => $settings->where('name', 'twitter_link')->first(),
                'tiktok_link' => $settings->where('name', 'tiktok_link')->first(),
                'instagram_link' => $settings->where('name', 'instagram_link')->first(),
                'youtube_link' => $settings->where('name', 'youtube_link')->first(),
                'telegram_link' => $settings->where('name', 'telegram_link')->first(),
            ],
            'pages' => Page::all(),
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'error' => fn () => $request->session()->get('error'),
                'success' => fn () => $request->session()->get('success'),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
