<?php

namespace App\Http\Controllers;
use App\Http\Requests\ShortRequest;
use Illuminate\Http\RedirectResponse;
//use Illuminate\Http\Request;
use App\Models\ShortUrl;

class ShortUrlController extends Controller
{
    public function short(ShortRequest $request)
    {
        if ($request->url) {
            $shortUrl = base_convert(ShortUrl::max('id') + 1, 10, 36);
            $ipAddress = $request->ip(); // Get user's IP address

            $newUrl = ShortUrl::create([
                'url' => $request->url,
                'short_url' => $shortUrl,
                'ip_address' => $ipAddress,  // Store IP address
            ]);
            return redirect()->back()
                ->with('success', 'Short URL created successfully')->with('shortedUrl', $shortUrl);
        }
        return back();
    }
    public function massege($massege)
    {
        $url = ShortUrl::where('short_url', $massege)->first();
        if ($url) {
            return redirect($url->url);
        }
        return back();
    }
}
