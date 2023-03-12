<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use Illuminate\View\View;

class BbsController extends Controller
{
    public function index(): View
    {
        /** @var Bb[] $bbs */
        $bbs = Bb::latest()->get();
        $context = ['bbs' => $bbs];

        return view('index', $context);
    }

    public function detail(Bb $bb): View
    {
        return view('detail', ['bb' => $bb]);
    }
}
