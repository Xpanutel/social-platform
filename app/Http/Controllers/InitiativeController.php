<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Initiative;
use Illuminate\Http\Request;

class InitiativeController extends Controller
{
    // Получить список всех инициатив
    public function index()
    {
        $initiatives = Initiative::all();
        return response()->json($initiatives);
    }

    // Получить детали одной инициативы
    public function show($id)
    {
        $initiative = Initiative::findOrFail($id);
        return response()->json($initiative);
    }

    // Поддержать инициативу
    public function support($id)
    {
        $initiative = Initiative::findOrFail($id);
        $initiative->increment('supporters');
        return response()->json([
            'message' => 'Инициатива успешно поддержана',
            'supporters' => $initiative->supporters
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'author' => 'required|string|max:255',
        ]);

        $initiative = Initiative::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'author' => $request->author,
            'supporters' => 0, // По умолчанию 0
        ]);

        return response()->json($initiative, 201);
    }
}
