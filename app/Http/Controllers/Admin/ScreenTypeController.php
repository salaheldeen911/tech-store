<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddScreenTypeRequest;
use App\Models\ScreenType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScreenTypeController extends Controller
{
    public function index()
    {
        return view('admin.details.screen-type.index');
    }

    public function showAllScreenTypes(Request $request)
    {
        if ($request->ajax()) {
            $data = ScreenType::select('*');
            return datatables()::of($data)
                ->addColumn("publisher_email", function ($row) {
                    return $row->user->email;
                })
                ->editColumn("created_at", function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    if (can($row->user_id)) {

                        $btns = '<a href="screen-types/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                        $btns .= "<a href='javascript:void(0)' onclick='deleteScreenType(this)'>
                                <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                            </a>

                            <form action='screen-types/$row->id' method='POST' style='display: none'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                
                            </form>";
                        return $btns;
                    }
                    return "";
                })
                ->setRowId(function ($screenType) {
                    return $screenType->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(ScreenType $screenType)
    {
        $this->authorize('update', $screenType);

        return view("admin.details.screen-type.edit")->with("screenType", $screenType);
    }

    public function update(AddScreenTypeRequest $request, ScreenType $screenType)
    {
        $this->authorize('update', $screenType);

        try {
            DB::transaction(function () use ($request, $screenType) {
                $screenType->update([
                    "name" => $request->input(('name')),
                ]);
            });
            return redirect()->route('admin.screen-types.index');
        } catch (\Exception $e) {
            Log::error("error while storing screenType", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.screen-types.index');
        }
    }

    public function destroy(ScreenType $screenType)
    {
        $this->authorize('update', $screenType);

        $screenType->delete();
        return redirect()->route('admin.screen-types.index');
    }
}
