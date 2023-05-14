<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProcessorRequest;
use App\Models\Processor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessorController extends Controller
{
    public function index()
    {
        return view('admin.details.processor.index');
    }

    public function showAllProcessors(Request $request)
    {
        if ($request->ajax()) {
            $data = Processor::select('*');
            return datatables()::of($data)
                ->addColumn("publisher_email", function ($row) {
                    return $row->user->email;
                })
                ->editColumn("created_at", function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    if (can($row->user_id)) {

                        $btns = '<a href="processors/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                        $btns .= "<a href='javascript:void(0)' onclick='deleteProcessor(this)'>
                                <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                            </a>

                            <form action='processors/$row->id' method='POST' style='display: none'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                
                            </form>";
                        return $btns;
                    }
                    return "";
                })
                ->setRowId(function ($processor) {
                    return $processor->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(Processor $processor)
    {
        $this->authorize('update', $processor);

        return view("admin.details.processor.edit")->with("processor", $processor);
    }

    public function update(AddProcessorRequest $request, Processor $processor)
    {
        $this->authorize('update', $processor);

        try {
            DB::transaction(function () use ($request, $processor) {
                $processor->update([
                    "name" => $request->input(('name')),
                ]);
            });
            return redirect()->route('admin.processors.index');
        } catch (\Exception $e) {
            Log::error("error while storing processor", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.processors.index');
        }
    }

    public function destroy(Processor $processor)
    {
        $this->authorize('delete', $processor);

        $processor->delete();
        return redirect()->route('admin.processors.index');
    }
}
