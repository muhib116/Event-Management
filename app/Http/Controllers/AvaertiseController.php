<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AvaertiseController extends Controller
{
    private function check()
    {
        if (auth()->user()->type != 'admin') {
            abort(404);
        }
    }
    public function index() {
        $this->check();
        $advertises = Advertise::orderBy('created_at', 'DESC')->get();
        return Inertia::render('Advertise', [
            'advertises' => $advertises,
        ]);
    }

    public function store(Request $request) {
        $this->check();
        $request->validate([
            'title' => 'required',
            'link' => 'required',
        ]);
        // return $request->all();
        DB::beginTransaction();
        if (isset($request->advertise_id)) {
            // return $request->all();
            $ad = Advertise::find($request->advertise_id);
            $data = [
                'title' => $request->title,
                // 'image' => $fileLocation,
                'description' => $request->description,
                'status' => $request->status,
                'link' => $request->link,
                'featured' => $request->featured,
                'settings' => $request->settings ? $request->settings : null,
            ];
            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $uniqueCode = md5(uniqid(rand(), true));
                $file_name  = $request->type.'-'.$uniqueCode.'-'.$file->getClientOriginalName();
                $file_type  = $file->getClientOriginalExtension();
                $data['image'] = $file->move('images', $file_name);
                if (file_exists(public_path($ad->image))) {
                    unlink(public_path($ad->path));
                }
            }
            $ad->update($data);
        } else {
            $request->validate([
                'banner_image' => 'required|image',
            ]);
            $file = $request->file('banner_image');
            $uniqueCode = md5(uniqid(rand(), true));
            $file_name  = $request->type.'-'.$uniqueCode.'-'.$file->getClientOriginalName();
            $file_type  = $file->getClientOriginalExtension();
            $fileLocation = $file->move('images', $file_name);
            Advertise::create([
                'title' => $request->title,
                'image' => $fileLocation,
                'description' => $request->description,
                'status' => $request->status,
                'link' => $request->link,
                'featured' => $request->featured,
                'settings' => $request->settings ? $request->settings : null,
            ]);
        }
        DB::commit();
        return back()->with('success', 'Advertise create successfully');
    }

    public function delete(Request $request) {
        $this->check();
        $request->validate([
            'advertise_id' => 'required'
        ]);
        $ad = Advertise::find($request->advertise_id);
        if (file_exists(public_path($ad->image))) {
            unlink(public_path($ad->image));
        }
        $ad->delete();
        return back();
    }
}
