<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $loanDuration = Setting::getValue('loan_duration', 7);
        
        return view('admin.settings', compact('loanDuration'));
    }

    public function update(Request $request)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'loan_duration' => 'required|integer|min:1|max:365',
        ]);

        Setting::updateOrCreate(
            ['key' => 'loan_duration'],
            ['value' => $validated['loan_duration']]
        );

        return back()->with('success', 'Pengaturan perpustakaan berhasil diperbarui!');
    }
}
