<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            ['loc' => route('front.faqs'), 'priority' => '0.6'],
            ['loc' => route('business.page'), 'priority' => '0.8'],
            ['loc' => route('pricing'), 'priority' => '0.6'],
            ['loc' => route('about'), 'priority' => '0.5'],
            ['loc' => route('privacy.index'), 'priority' => '0.3'],
            ['loc' => route('cancellation.policy'), 'priority' => '0.3'],
            ['loc' => route('partner.terms'), 'priority' => '0.3'],
        ];

        array_unshift($urls, ['loc' => url('/'), 'priority' => '1.0']);

        $businesses = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) {
            $query->whereNotNull('business_name')->whereNotNull('slug');
        })->with('businessUser')->get();

        foreach ($businesses as $business) {
            $urls[] = [
                'loc' => route('shop.details', ['slug' => $business->businessUser->slug]),
                'priority' => '0.7',
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
