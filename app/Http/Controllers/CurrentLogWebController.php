<?php

namespace App\Http\Controllers;

use App\Models\ModelCurrentEmail;
use App\Models\ModelCurrentLogRow;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CurrentLogWebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCurrentEmails(): View
    {
        Gate::authorize('read-logs');

        $context = [
            'title' => __('messages.titles.getCurrentEmails'),
        ];
        $emails = ModelCurrentEmail::orderByDesc('dateTime')->paginate(30);
        $context['emails'] = $emails;

        return \view('emails-table', $context);
    }

    public function getCurrentLogRows(): View
    {
        Gate::authorize('read-logs');

        $context = [
            'title' => __('messages.titles.getCurrentLogRows'),
        ];
        $logRows = ModelCurrentLogRow::orderByDesc('dateTime')->paginate(100);
        $context['logRows'] = $logRows;

        return \view('log-rows-table', $context);
    }
}
