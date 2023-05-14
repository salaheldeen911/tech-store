<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddNetworkRequest;
use App\Models\Network;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NetworkController extends Controller
{
    public function index()
    {
        return view('admin.details.network.index');
    }

    public function showAllNetworks(Request $request)
    {
        if ($request->ajax()) {
            $data = Network::select('*')->with('user');
            return datatables()::of($data)
                ->addColumn("publisher_email", function ($row) {
                    return $row->user->email;
                })
                ->editColumn("created_at", function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    if (can($row->user_id)) {
                        $btns = '<a href="networks/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                        $btns .= "<a href='javascript:void(0)' onclick='deleteNetwork(this)'>
                                <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                            </a>

                            <form action='networks/$row->id' method='POST' style='display: none'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                
                            </form>";
                        return $btns;
                    }
                    return "";
                })
                ->setRowId(function ($network) {
                    return $network->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(Network $network)
    {
        $this->authorize('update', $network);

        return view("admin.details.network.edit")->with("network", $network);
    }

    public function update(AddNetworkRequest $request, Network $network)
    {
        $this->authorize('update', $network);

        try {
            DB::transaction(function () use ($request, $network) {
                $network->update([
                    "name" => $request->input(('name')),
                ]);
            });
            return redirect()->route('admin.networks.index');
        } catch (\Exception $e) {
            Log::error("error while storing network", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return redirect()->route('admin.networks.index');
        }
    }

    public function destroy(Network $network)
    {
        $this->authorize('delete', $network);

        $network->delete();
        return redirect()->route('admin.networks.index');
    }
}
