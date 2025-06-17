<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminDashboardController extends Controller
{

    public function index()
    {
        $reports = Report::get();
        $totalInspections = Report::count();
        $pendingCount = Report::where('status', 'pending')->count();
        $forwardCount = Report::where('status', 'sent')->count();
        $replyPendingCount = Report::whereIn('status', ['pending', 'sent'])->count();
        return view('admin.dashboard', compact('reports','totalInspections','pendingCount','forwardCount','replyPendingCount'));
    }

    public function onemonth()
    {
        return view('admin.report.1month');
    }

    public function secondmonth()
    {
        return view('admin.report.3month');
    }

    public function thirdmonth()
    {
        return view('admin.report.6month');
    }

    // public function send($id)
    // {
    //     $post = Report::findOrFail($id);

    //     // Only update if not already approved
    //     if ($post->status !== 'approved') {
    //         $post->status = 'approved';
    //         $post->save(); // or $post->update();
    //     }

    //     return redirect()->back()->with('success', 'Report marked as approved!');
    // }

    public function send($id)
    {
        $post = Report::findOrFail($id);

        if ($post->status === 'sent') {
            $post->status = 'approved';
            $post->save();

            return redirect()->back()->with('success', 'Report approved successfully!');
        }

        return redirect()->back()->with('info', 'Report must be in sent status to approve.');
    }

    public function downloadReport($id)
    {
        $report = Report::findOrFail($id);

        $pdf = Pdf::loadView('admin.pdf.report', compact('report'));

        return $pdf->download('report_' . $report->id . '.pdf');
    }

}
