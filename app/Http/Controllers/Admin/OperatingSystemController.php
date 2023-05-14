<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddOperatingSystemRequest;
use App\Models\OperatingSystem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OperatingSystemController extends Controller
{
    public function index()
    {
        return view('admin.details.operating-system.index');
    }

    public function showAllOperatingSystems(Request $request)
    {
        if ($request->ajax()) {
            $data = OperatingSystem::select('*');
            return datatables()::of($data)
                ->addColumn("publisher_email", function ($row) {
                    return $row->user->email;
                })
                ->editColumn("created_at", function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    if (can($row->user_id)) {

                        $btns = '<a href="operating-system/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                        $btns .= "<a href='javascript:void(0)' onclick='deleteOperatingSystem(this)'>
                                <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                            </a>

                            <form action='operating-system/$row->id' method='POST' style='display: none'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                
                            </form>";
                        return $btns;
                    }
                    return "";
                })
                ->setRowId(function ($operatingSystem) {
                    return $operatingSystem->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(OperatingSystem $operatingSystem)
    {
        $this->authorize('update', $operatingSystem);

        return view("admin.details.operating-system.edit")->with("operatingSystem", $operatingSystem);
    }

    public function update(AddOperatingSystemRequest $request, OperatingSystem $operatingSystem)
    {
        $this->authorize('update', $operatingSystem);

        try {
            DB::transaction(function () use ($request, $operatingSystem) {
                $operatingSystem->update([
                    "name" => $request->input(('name')),
                ]);
            });
            return redirect()->route('admin.operating-system.index');
        } catch (\Exception $e) {
            Log::error("error while storing Operating System", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.operating-system.index');
        }
    }

    public function destroy(OperatingSystem $operatingSystem)
    {
        $this->authorize('delete', $operatingSystem);
        $operatingSystem->delete();
        return redirect()->route('admin.operating-system.index');
    }
}
