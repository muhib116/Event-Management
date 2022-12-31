<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Utils;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    use Utils;
    public function index() {
        // $pages = Page::where('status', true)->get();
        $pages = Page::get();
        return Inertia::render('Page', [
            'pages' => $pages,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        
        $page = Page::create([
            'title' => $request->title,
            'slug' => str()->slug($request->title),
            'image' => '',
            'content' => $request->content,
            'status' => ($request->status) ? true : false,
        ]);

        return back()->with('success', 'Page Create Successfully!');
    }

    public function edit(Page $page) {
        return response($page);
    }

    public function update(Request $request, Page $page) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $page->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => ($request->status) ? true : false,
        ]);


        return back()->with('success', 'Page Update Successfully!');
    }

    public function delete(Page $page) {
        $page->delete();

        return back()->with('success', 'Page Delete Successfully!');
    }
}
