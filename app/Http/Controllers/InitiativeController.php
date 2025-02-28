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
}
