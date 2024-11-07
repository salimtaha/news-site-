<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\RelatedNewsSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RelatedSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = RelatedNewsSite::latest()->paginate(4);
        return view('admin.relatedsites.index' , compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.relatedsites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(RelatedNewsSite::filterRequest());

        $site = RelatedNewsSite::create($request->only(['name' , 'url']));
        if(!$site){
            Session::flash('error' , 'Try Again Latter!');
            return redirect()->back();
        }
        Session::flash('success' , 'Site Created Successfully');
        return redirect()->back();
    }

    public function update(Request $request, string $id)
    {
        $request->validate(RelatedNewsSite::filterRequest());

        $site = RelatedNewsSite::findOrFail($id);
        $site = $site->update($request->only(['name' , 'url']));

        if(!$site){
            Session::flash('error' , 'Try Again Latter!');
            return redirect()->back();
        }
        Session::flash('success' , 'Site Updated Successfully');
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $site = RelatedNewsSite::findOrFail($id);
        $site->delete();
        Session::flash('success' , 'Site Deleted Successfully');
        return redirect()->back();
    }
}
