<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBrandRequest;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.details.brand.index');
    }

    public function showAllbrands(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::select('*');
            return datatables()::of($data)
                ->addColumn("publisher_email", function ($row) {
                    return $row->user->email;
                })
                ->editColumn("created_at", function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    if (can($row->user_id)) {

                        $btns = '<a href="brands/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                        $btns .= "<a href='javascript:void(0)' onclick='deleteBrand(this)'>
                                <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                            </a>

                            <form action='brands/$row->id' method='POST' style='display: none'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                
                            </form>";
                        return $btns;
                    }
                    return "";
                })
                ->setRowId(function ($brand) {
                    return $brand->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(Brand $brand)
    {
        $this->authorize('update', $brand);

        return view("admin.details.brand.edit")->with("brand", $brand);
    }

    public function update(AddBrandRequest $request, Brand $brand)
    {
        $this->authorize('update', $brand);

        try {
            DB::transaction(function () use ($request, $brand) {
                $brand->update([
                    "name" => $request->input(('name')),
                ]);
            });
            return redirect()->route('admin.brands.index');
        } catch (\Exception $e) {
            Log::error("error while storing brand", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.brands.index');
        }
    }

    public function destroy(Brand $brand)
    {
        $this->authorize('delete', $brand);
        $brand->delete();
        return redirect()->route('admin.brands.index');
    }
}
