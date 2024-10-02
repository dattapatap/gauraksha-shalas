<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipping = ShippingRule::paginate(10);
        return view('backend.shipping-rule.index',compact('shipping'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'min_cost' => ['required', 'integer', 'min:100'],
            'shipping_cost' => ['required', 'integer', 'min:0'],
            'status' => ['required']
        ]);

        $shipping = new ShippingRule();
        $shipping->shipping_cost = $request->shipping_cost;
        $shipping->min_cost = $request->min_cost;
        $shipping->status = $request->status;
        $shipping->save();

        toastr('Created Successfully', 'success', 'Success');

        return redirect()->route('admin.shipping.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shipping = ShippingRule::findOrFail($id);
        return view('backend.shipping-rule.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'min_cost' => ['required', 'integer', 'min:100'],
            'shipping_cost' =>['required', 'integer', 'min:0'],
            'status' => ['required']
        ]);

        $shipping = ShippingRule::findOrFail($id);
        $shipping->min_cost = $request->min_cost;
        $shipping->shipping_cost = $request->shipping_cost;
        $shipping->status = $request->status;
        $shipping->save();

        toastr('Updated Successfully', 'success', 'Success');

        return redirect()->route('admin.shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipping = ShippingRule::findOrFail($id);
        $shipping->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $shipping = ShippingRule::findOrFail($request->id);
        $shipping->status = $request->status == 'true' ? 1 : 0;
        $shipping->save();

        return response(['message' => 'Status has been updated!']);
    }
}
