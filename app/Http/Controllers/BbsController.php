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
        $s = "Объявления\n\n";
        foreach ($bbs as $bb) {
            $s .= $bb->title . "\n";
            $s .= $bb->price . "\n";
            $s .= "\n";
        }
        $context = ['bbs' => Bb::latest()->get()];

//        return response($s)->header('Content-Type', 'text/plain');
        return view('index', $context);
    }

    public function detail(Bb $bb): View
    {
        $s = "$bb->title \n\n";
        $s .= "$bb->content \n";
        $s .= "$bb->price руб. \n";

//        return response($s)->header('Content-Type', 'text/plain');
        return view('detail', ['bb' => $bb]);
    }
}
