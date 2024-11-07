<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admins');
    }
    public function index()
    {
        $order_by = request()->order_by ?? 'desc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;

        $admins = Admin::where('id' , '!=' , Auth::guard('admin')->user()->id)->when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
            ->orWhere('email', 'LIKE', '%' . request()->keyword . '%')
            ->orWhere('username', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        });

        $admins = $admins->orderBy($sort_by, $order_by)->paginate($limit_by);
        return view('admin.admins.index', compact('admins'));
    }

    public function changeStatus($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->status == 1) {
            $admin->update([
                'status' => 0,
            ]);
            Session::flash('success', 'admin Blocked Suuccessfully!');
        } else {
            $admin->update([
                'status' => 1,
            ]);
            Session::flash('success', 'admin Active Suuccessfully!');
        }
        return redirect()->back();

      }

    public function create()
    {
        $authorizations = Authorization::select('id' , 'role')->get();
        return view('admin.admins.create' , compact('authorizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {

        $admin = Admin::create($request->except(['_token' ,'password_confirmation']));
        if(!$admin){
            return redirect()->back()->with('error' , 'try Again Latter!');
        }
        return redirect()->back()->with('success' , 'New Admin Created Successfully!');

    }

    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        $authorizations = Authorization::select('id' , 'role')->get();
        return view('admin.admins.edit' , compact('authorizations' , 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        if($request->password){
            $admin = $admin->update($request->except(['_token' ,'password_confirmation']));
        }else{
            $admin = $admin->update($request->except(['_token' ,'password','password_confirmation']));
        }
        if(!$admin){
            return redirect()->back()->with('error' , 'try Again Latter!');
        }
        return redirect()->back()->with('success' , ' Admin Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
         $admin = $admin->delete();
         if(!$admin){
            return redirect()->back()->with('error' , 'try Again Latter!');
         }

        Session::flash('success', 'admin Deleted Suuccessfully!');
        return redirect()->route('admin.admins.index');
    }

}
