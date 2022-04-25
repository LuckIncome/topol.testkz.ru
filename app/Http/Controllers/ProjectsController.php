<?php

namespace App\Http\Controllers;

use App\Page;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');

        $projects = Project::where('active', true)->orderByDesc('created_at')->paginate(6);
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

        $page = Page::where('slug','nashi-proekty')->first();
        $page = $page->translate($locale,$fallbackLocale);

        return view('projects.index', compact('projects','pages','page'));

    }

    public function show(Project $project)
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $gallery = json_decode($project->gallery);
        $images = [];
        if ($gallery) {
            foreach ($gallery as $item) {
                $images[] = ['original' => \Voyager::image($project->getThumbnail($item,'big')), 'webp' => str_replace('.' . pathinfo(\Voyager::image($item),PATHINFO_EXTENSION), '.webp', \Voyager::image($item))];
            }
        }
        $post = $project->translate($locale, $fallbackLocale);
        return view('projects.show', compact('post', 'images'));
    }
}
