<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddRefreshRateRequest;
use App\Models\RefreshRate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RefreshRateController extends Controller
{
    public function index()
    {
        return view('admin.details.refresh-rate.index');
    }

    public function showAllRefreshRate(Request $request)
    {
        if ($request->ajax()) {
            $data = RefreshRate::select('*');
            return datatables()::of($data)
                ->addColumn("publisher_email", function ($row) {
                    return $row->user->email;
                })
                ->editColumn("created_at", function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    if (can($row->user_id)) {

                        $btns = '<a href="refresh-rate/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                        $btns .= "<a href='javascript:void(0)' onclick='deleteRefreshRate(this)'>
                                <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                            </a>

                            <form action='refresh-rate/$row->id' method='POST' style='display: none'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                
                            </form>";
                        return $btns;
                    }
                    return "";
                })
                ->setRowId(function ($RefreshRate) {
                    return $RefreshRate->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(RefreshRate $refreshRate)
    {
        $this->authorize('update', $refreshRate);

        return view("admin.details.refresh-rate.edit")->with("refreshRate", $refreshRate);
    }

    public function update(AddRefreshRateRequest $request, RefreshRate $refreshRate)
    {
        $this->authorize('update', $refreshRate);

        try {
            DB::transaction(function () use ($request, $refreshRate) {
                $refreshRate->update([
                    "name" => $request->input(('name')),
                ]);
            });
            return redirect()->route('admin.refresh-rate.index');
        } catch (\Exception $e) {
            Log::error("error while storing Refresh Rate", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.refresh-rate.index');
        }
    }

    public function destroy(RefreshRate $refreshRate)
    {
        $this->authorize('delete', $refreshRate);

        $refreshRate->delete();
        return redirect()->route('admin.refresh-rate.index');
    }
}
