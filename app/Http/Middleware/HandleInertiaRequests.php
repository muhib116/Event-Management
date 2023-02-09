<?php

namespace App\Http\Middleware;

use App\Models\EventList;
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

        $ev_list = EventList::where('eventCategory', '!=', null)
                    ->get()
                    ->pluck('eventCategory')->unique();
        $cats = [];
        foreach($ev_list as $key => $cat) {
            $cats[$key] = [
                'category' => $cat,
                'count' => EventList::where('eventCategory', $cat)->count()
            ];
        }
        usort($cats, function ($item1, $item2) {
            return $item1['count'] <= $item2['count'];
        });
        $category_list = collect($cats)->take(4)->pluck('category')
            ->map(function($c) {
                $op = [
                    'category' => $c,
                    'name' => ucfirst(str_replace('-', ' ', $c)),
                ];
                return $op;
            });

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'category_list' => $category_list,
            'user' => auth()->user(),
            'url' => url(''),
            'site_name' => $settings->where('name', 'site_name')->first(),
            'currency' => $settings->where('name', 'currency')->first(),
            'settings' => [
                'stripe_publish_key' => $settings->where('name', 'stripe_publish_key')->first(),
                'paypal_publish_key' => $settings->where('name', 'paypal_publish_key')->first(),
                'auth0_domain' => $settings->where('name', 'auth0_domain')->first(),
                'auth0_client_id' => $settings->where('name', 'auth0_client_id')->first(),
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
            'pages' => Page::all()->map(function($page){
                $page->content = strip_tags($page->content);
                return $page;
            }),
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
