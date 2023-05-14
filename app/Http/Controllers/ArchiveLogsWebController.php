<?php

namespace App\Http\Controllers;

use App\Models\ModelArchiveEmail;
use App\Models\ModelArchiveLogRow;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ArchiveLogsWebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getArchiveEmails(): View
    {
        Gate::authorize('read-logs');

        $context = [
            'title' => __('messages.titles.getArchiveEmails'),
        ];
        $emails = ModelArchiveEmail::orderByDesc('dateTime')->paginate(30);
        $context['emails'] = $emails;

        return \view('emails-table', $context);
    }

    public function getArchiveLogRows(): View
    {
        Gate::authorize('read-logs');

        $context = [
            'title' => __('messages.titles.getArchiveLogRows'),
        ];
        $logRows = ModelArchiveLogRow::orderByDesc('dateTime')->paginate(100);
        $context['logRows'] = $logRows;

        return \view('log-rows-table', $context);
    }
}
