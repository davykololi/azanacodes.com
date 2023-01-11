<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\User;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('role',UserRoleEnum::Author)->latest()->paginate(5);
        $title = "Author's Dashboard";

        return view('admin.authors.index',compact('users','title'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Create Authors';

        return view('admin.authors.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['role'] = UserRoleEnum::Author;
        $user = User::create($data);
        toastr()->success(ucwords('The'." ".$user->role->value." ".'created successfully'));
     
        return redirect()->route('admin.authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);
        $title = 'Show Authors';

        return view('admin.authors.show',compact('user','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $title = 'Edit Authors';

        return view('admin.authors.edit',compact('user','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    
        $data = $request->only('name','email');
        $user->update($data);
        toastr()->success(ucwords('The'." ".$user->role->value." ".'updated successfully'));
     
        return redirect()->route('admin.authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();
        toastr()->success(ucwords('The'." ".$user->role->value." ".'deleted successfully'));
    
        return redirect()->route('admin.authors.index');
    }
}
