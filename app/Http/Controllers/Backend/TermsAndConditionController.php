<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        $content = TermsAndCondition::first();
        return view('backend.terms.index', compact('content'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'terms' => ['required']
        ]);

        $terms = TermsAndCondition::findOrFail($id);

        $terms->content = $request->terms;
        $terms->save();

        toastr('Terms and conditions updated successfully!', 'success');

        return redirect()->back();

    }
}
