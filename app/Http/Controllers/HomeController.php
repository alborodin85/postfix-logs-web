<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    private const BB_VALIDATOR = [
        'title' => 'required|max:50',
        'content' => 'required',
        'price' => 'required|numeric|min:1',
    ];

    private const BB_ERROR_MESSAGES = [
        'price.required' => 'Раздавать товары бесплатно нельзя',
        'required' => 'Заполните это поле',
        'max' => 'Значение не должно быть длиннее :max символов',
        'numeric' => 'Введите число',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $bbs = $user->bbs()->latest()->get();
        return view('home', ['bbs' => $bbs]);
    }

    public function showAddBbForm(): View
    {
        return view('bb_add');
    }

    public function storeDb(Request $request): Response
    {
        $validated = $request->validate(self::BB_VALIDATOR, self::BB_ERROR_MESSAGES);

        /** @var User $user */
        $user = Auth::user();
        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'price' => $validated['price'],
        ];
        $user->bbs()->create($data);
        return redirect()->route('home');
    }

    public function showEditBbForm(Bb $bb): View
    {
        return view('bb_edit', ['bb' => $bb]);
    }

    public function updateBb(Request $request, Bb $bb): Response
    {
        $validated = $request->validate(self::BB_VALIDATOR, self::BB_ERROR_MESSAGES);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'price' => $validated['price'],
        ];
        $bb->fill($data);
        $bb->save();
        return redirect()->route('home');
    }

    public function showDeleteBbForm(Bb $bb): View
    {
        return \view('bb_delete', ['bb' => $bb]);
    }

    public function destroyBb(Bb $bb): Response
    {
        $bb->delete();
        return redirect()->route('home');
    }
}
