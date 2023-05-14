<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAdminRequest;
use App\Http\Requests\EditAdminRequest;
use App\Models\Cart;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'users');
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function showAllUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    if (auth()->user()->hasRole("super_admin")) {

                        $btns = '<a href="users/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                        $btns .= "<a href='javascript:void(0)' onclick='deleteUser(this)'>
                                <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                            </a>

                            <form action='users/$row->id' method='POST' style='display: none'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                
                            </form>";
                        return $btns;
                    }
                    return "";
                })
                ->addColumn('user_role', function ($row) {
                    return User::find($row->id)->getRoleNames();
                })

                ->setRowId(function ($user) {
                    return $user->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        return view("admin.users.create");
    }

    public function store(AddAdminRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    "name" => $request->input(('name')),
                    "email" => $request->input(('email')),
                    "password" => Hash::make($request->input(('password'))),
                    "phone" => $request->input(('phone')),
                    "expire_at" => $request->input(('expire_at'))
                ]);

                switch ($request->input('role')) {
                    case 3:
                        $user->roles()->detach();
                        if (!Cart::where('user_id', $user->id)->count()) {
                            Cart::create([
                                'user_id' => $user->id,
                            ]);
                        }
                        $user->assignRole('user');
                        break;
                    case 2:
                        $user->roles()->detach();
                        $user->assignRole('admin');
                        $user->markEmailAsVerified();
                        break;
                    case 1:
                        $user->roles()->detach();
                        $user->assignRole("super_admin");
                        $user->markEmailAsVerified();
                        break;
                    default:
                        return false;
                }
            });
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            Log::error("error while storing user", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.users.index');
        }
    }

    public function edit(User $user)
    {
        return view("admin.users.edit")->with("user", $user);
    }

    public function update(EditAdminRequest $request, $id)
    {
        try {
            $user = User::where('id', $id)->first();

            DB::transaction(function () use ($request, $id, $user) {
                $user->update([
                    "name" => $request->input(('name')),
                    "expire_at" => $request->input(('expire_at')),
                    "role" => $request->input(('role'))
                ]);

                switch ($request->input('role')) {
                    case 3:
                        $user->roles()->detach();
                        if (!Cart::where('user_id', $user->id)) {
                            Cart::create([
                                'user_id' => $user->id,
                            ]);
                        }
                        $user->assignRole('user');
                        break;
                    case 2:
                        $user->roles()->detach();
                        $user->assignRole('admin');
                        $user->markEmailAsVerified();
                        break;
                    case 1:
                        $user->roles()->detach();
                        $user->assignRole("super_admin");
                        $user->markEmailAsVerified();
                        break;
                    default:
                        return false;
                }
            });
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            Log::error("error while storing user", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.users.index');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
