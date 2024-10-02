<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ReturnAndRefund;
use Illuminate\Http\Request;

class ReturnAndRefundController extends Controller
{
    public function index()
    {
        $content = ReturnAndRefund::first();
        return view('backend.returns-and-refunds.index', compact('content'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'return' => ['required']
        ]);

        $return = ReturnAndRefund::findOrFail($id);

        $return->content = $request->return;
        $return->save();

        toastr('Return and Refund updated successfully!', 'success');

        return redirect()->back();

    }
}
