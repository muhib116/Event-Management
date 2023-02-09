<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Utils;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    use Utils;

    public function show(Page $page) {
        // return $page;
        return Inertia::render('Frontend/PageView', [
            'page' => $page
        ]);
    }
    public function index() {
        if(auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        $pages = Page::all()->map(function($page){
            $page->content = strip_tags($page->content);
            return $page;
        });
        return Inertia::render('Page', [
            'pages' => $pages,
        ]);
    }

    public function store(Request $request) {
        if(auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
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
        if(auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        return response($page);
    }

    public function update(Request $request, Page $page) {
        if(auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
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
        if(auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        $page->delete();

        return back()->with('success', 'Page Delete Successfully!');
    }
}
