<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddColorRequest;
use App\Models\Color;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
    public function index()
    {
        return view('admin.details.color.index');
    }

    public function showAllColors(Request $request)
    {
        if ($request->ajax()) {
            $data = Color::select('*');
            return datatables()::of($data)
                ->addColumn("publisher_email", function ($row) {
                    return $row->user->email;
                })
                ->editColumn("created_at", function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    if (can($row->user_id)) {

                        $btns = '<a href="colors/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                        $btns .= "<a href='javascript:void(0)' onclick='deleteColor(this)'>
                                <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                            </a>

                            <form action='colors/$row->id' method='POST' style='display: none'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                
                            </form>";
                        return $btns;
                    }
                    return "";
                })
                ->setRowId(function ($color) {
                    return $color->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(Color $color)
    {
        $this->authorize('update', $color);

        return view("admin.details.color.edit")->with("color", $color);
    }

    public function update(AddColorRequest $request, Color $color)
    {
        $this->authorize('update', $color);

        try {
            DB::transaction(function () use ($request, $color) {
                $color->update([
                    "name" => $request->input(('name')),
                ]);
            });
            return redirect()->route('admin.colors.index');
        } catch (\Exception $e) {
            Log::error("error while editing color", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.colors.index');
        }
    }

    public function destroy(Color $color)
    {
        $this->authorize('delete', $color);
        $color->delete();
        return redirect()->route('admin.colors.index');
    }
}
