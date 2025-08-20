<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_number', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('program', 'like', "%{$search}%")
                ->orWhere('section', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('program')->orderBy('section')->get();

        return view('admin.transactions.index', compact('users'));
    }


    public function show($id)
    {
        $student = \App\Models\User::with('transactions')->findOrFail($id);

        return view('admin.transactions.show', compact('student'));
    }
}
