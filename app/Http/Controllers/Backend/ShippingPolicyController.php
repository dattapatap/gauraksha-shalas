<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingPolicy;
use Illuminate\Http\Request;

class ShippingPolicyController extends Controller
{
    public function index()
    {
        $content = ShippingPolicy::first();
        return view('backend.shipping-policy.index', compact('content'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'shipping' => ['required']
        ]);

        $shipping = ShippingPolicy::findOrFail($id);

        $shipping->content = $request->shipping;
        $shipping->save();

        toastr('Shipping Policy updated successfully!', 'success');

        return redirect()->back();

    }
}
