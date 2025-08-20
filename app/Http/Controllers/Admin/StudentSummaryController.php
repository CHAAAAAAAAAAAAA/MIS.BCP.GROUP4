<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentSummaryController extends Controller
{
    public function downloadPdf($id)
    {
        $student = User::findOrFail($id);

        // Gumamit ng hiwalay na blade para sa PDF (para clean)
        $pdf = Pdf::loadView('admin.students.summary-pdf', compact('student'));

        return $pdf->download("student_{$student->id}_summary.pdf");
    }


}


