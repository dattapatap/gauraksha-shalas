<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $content = PrivacyPolicy::first();
        return view('backend.privacy-policy.index', compact('content'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'privacy' => ['required']
        ]);

        $privacy = PrivacyPolicy::findOrFail($id);

        $privacy->content = $request->privacy;
        $privacy->save();

        toastr('Privacy Policy updated successfully!', 'success');

        return redirect()->back();

    }
}
