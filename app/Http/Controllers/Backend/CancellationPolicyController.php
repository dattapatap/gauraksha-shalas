<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CancellationPolicy;
use Illuminate\Http\Request;

class CancellationPolicyController extends Controller
{
    public function index()
    {
        $content = CancellationPolicy::first();
        return view('backend.cancellation-policy.index', compact('content'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'cancel' => ['required']
        ]);

        $cancel = CancellationPolicy::findOrFail($id);

        $cancel->content = $request->cancel;
        $cancel->save();

        toastr('cancel and conditions updated successfully!', 'success');

        return redirect()->back();

    }
}
