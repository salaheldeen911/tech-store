<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddResolutionRequest;
use App\Models\Resolution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResolutionController extends Controller
{
    public function index()
    {
        return view('admin.details.resolution.index');
    }

    public function showAllResolutions(Request $request)
    {
        if ($request->ajax()) {
            $data = Resolution::select('*');
            return datatables()::of($data)
                ->addColumn("publisher_email", function ($row) {
                    return $row->user->email;
                })
                ->editColumn("created_at", function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    if (can($row->user_id)) {

                        $btns = '<a href="resolutions/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                        $btns .= "<a href='javascript:void(0)' onclick='deleteResolution(this)'>
                                <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                            </a>

                            <form action='resolutions/$row->id' method='POST' style='display: none'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                
                            </form>";
                        return $btns;
                    }
                    return "";
                })
                ->setRowId(function ($resolution) {
                    return $resolution->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(Resolution $resolution)
    {
        $this->authorize('update', $resolution);

        return view("admin.details.resolution.edit")->with("resolution", $resolution);
    }

    public function update(AddResolutionRequest $request, Resolution $resolution)
    {
        $this->authorize('update', $resolution);

        try {
            DB::transaction(function () use ($request, $resolution) {
                $resolution->update([
                    "name" => $request->input(('name')),
                ]);
            });
            return redirect()->route('admin.resolutions.index');
        } catch (\Exception $e) {
            Log::error("error while storing resolution", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.resolutions.index');
        }
    }

    public function destroy(Resolution $resolution)
    {
        $this->authorize('delete', $resolution);

        $resolution->delete();
        return redirect()->route('admin.resolutions.index');
    }
}
