<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Page;
use App\Program;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function index()
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');

        $programs = Program::where('active', true)->orderBy('sort_id')->paginate(6);
        $exclude = ['obuchenie','nashi-proekty','o-kompanii'];
        $pages = Page::where('type', 'about')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) use ($exclude){
            if (!in_array($item->slug,$exclude)){
                $item->url = route('about.show',$item);
            }else {
                if ($item->slug == 'o-kompanii'){
                    $item->url = route('pages.about');
                }else {
                    $item->url = ($item->slug == 'obuchenie') ? route('programs.index') : route('projects.index');
                }
            }
        });
        $pages = $pages->translate($locale,$fallbackLocale);

        $page = Page::where('slug','obuchenie')->first();
        $page = $page->translate($locale,$fallbackLocale);
        return view('programs.index', compact('programs','pages','page'));
    }

    public function show(Program $program)
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $gallery = json_decode($program->gallery);
        $images = [];
        if ($gallery) {
            foreach ($gallery as $item) {
                $images[] = ['original' => \Voyager::image($program->getThumbnail($item,'big')), 'webp' => str_replace('.' . pathinfo(\Voyager::image($item),PATHINFO_EXTENSION), '.webp', \Voyager::image($item))];
            }
        }
        $post = $program->translate($locale,$fallbackLocale);
        return view('programs.show', compact('post','images'));
    }

    public function getCerts(Request $request)
    {
        $input = $request->get('input');

        $certificates = Certificate::where('full_name', 'like', '%' .$input. '%')->orWhere('iin',$input)->orWhere('number',$input)->get();

        return response()->json(['items' => $certificates]);
    }
}
