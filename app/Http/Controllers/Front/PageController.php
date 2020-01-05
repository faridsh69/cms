<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Page;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex($page_url = '', \Kris\LaravelFormBuilder\FormBuilder $form_builder)
    {
        $shop_register_form = $form_builder->create('\App\Forms\ShopForm', [
            'method' => 'POST',
            'url' => route('front.page.subscribe'),
            'class' => 'm-form m-form--state',
            'id' =>  'admin_form',
        ]);

        if(config('app.name') === 'map'){
            return view('front.test.map.offline-city');
        }

        $page = Page::where('url', $page_url)->active()->first();
        abort_if(! $page, 404);

        if(config('app.name') === 'map'){
            return view('front.test.map.offline-city');
            // $ip = $_SERVER['REMOTE_ADDR'];
            // try{
            //     if($ip === '127.0.0.1'){
            //         return view('front.test.map.offline-city');
            //     }else{
            //         $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
            //         if($details->country === 'IR'){

            //         }
            //     }
            // }
            // catch(Exception $e){}
        }

        $meta = [
            'title' => config('setting-general.default_meta_title') . ' | ' . $page->title,
            'description' => $page->meta_description ?: config('setting-general.default_meta_description'),
            'keywords' => $page->keywords,
            'image' => $page->image ? asset($page->image) : asset(config('setting-general.default_meta_image')),
            'google_index' => config('setting-general.google_index') ?: $page->google_index,
            'canonical_url' => $page->canonical_url ?: url()->current(),
        ];

        $blocks = Block::getPageBlocks($page->id);

        return view('front.page', ['blocks' => $blocks, 'page' => $page, 'meta' => $meta, 'shop_register_form' => $shop_register_form]);
    }

    public function postSubscribe(Request $request)
    {
        dd($request->all());
        $date = Carbon::now()->format('Y/d/m');
        $time = Carbon::now()->format('H:i');
        $phone = $request->input('phone');
        $message = $request->input('message');

        if(! User::where('phone', $phone)->first()){
            User::create([
                'first_name' => $date,
                'last_name' => $time,
                'phone' => $phone,
                'bio' => $message,
                'status' => 0,
                'password' => 'Password-' . rand(100, 999),
            ]);
        }

        $request->session()->flash('alert-success', 'Congratulation, We Will Contact You Soon!');

        return redirect()->route('front.page.index', '/');
    }
}
