<?php

namespace App\Http\Services;

use App\Models\User;
use Yajra\DataTables\DataTables;

class OrderService
{
    public function dataTable($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn("action", function ($row) {
                return $this->addColumn($row);
            })
            ->addColumn("user_email", function ($row) {
                return User::select("email")->find($row->user_id)->email;
            })
            ->setRowId(function ($product) {
                return $product->id;
            })
            ->setRowAttr([
                "align" => "center",
            ])
            ->editColumn("user_email", function ($row) {
                return User::select("email")->find($row->user_id)->email;
            })
            ->editColumn("created_at", function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->editColumn("city", function ($row) {
                return $row->address->city;
            })
            ->rawColumns(["action"])
            ->make(true);
    }

    private function addColumn($row)
    {
        $colomn = "<a href='/dashboard/orders/$row->id'>
                <span class='jsgrid-button jsgrid-edit-button ti-eye' type='button' title='Show'></span>
            </a>";
        if ($this->can($row->seller_id)) {
            $colomn .= "
                    <a href='javascript:void(0)' onclick='deleteOrder(this)'>
                            <span class='jsgrid-button jsgrid-delete-button ti-trash' type='button' title='Delete'></span>
                    </a>

                    <form action='/dashboard/orders/$row->id' method='POST' style='display: none'>
                        " . csrf_field() . "
                        " . method_field("DELETE") . "
                        
                    </form>
                ";
        }
        return $colomn;
    }

    private function can($id)
    {
        return auth()->user()->id == $id || auth()->user()->hasRole("super_admin") ? true : false;
    }
}
