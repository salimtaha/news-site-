<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users');
    }
    public function index()
    {
        $order_by = request()->order_by ?? 'desc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;

        $users = User::when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('email', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        });

        $users = $users->orderBy($sort_by, $order_by)->paginate($limit_by);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $request->merge([
                'email_verified_at' => $request->email_verified_at == 1 ? now() : null,
            ]);

            $user = User::create($request->except(['_token', 'image', 'password_confirmation']));
            ImageManger::uploadImages($request, null, $user);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->back()->with('success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show' , compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {

        $user = User::findOrFail($id);
        ImageManger::deleteImageFromLocal($user->image);
        $user->delete();

        Session::flash('success', 'User Deleted Suuccessfully!');
        return redirect()->route('admin.users.index');
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->status == 1) {
            $user->update([
                'status' => 0,
            ]);
            Session::flash('success', 'User Blocked Suuccessfully!');
        } else {
            $user->update([
                'status' => 1,
            ]);
            Session::flash('success', 'User Active Suuccessfully!');
        }
        return redirect()->back();
    }
}
