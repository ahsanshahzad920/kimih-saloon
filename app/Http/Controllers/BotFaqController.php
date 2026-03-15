<?php

namespace App\Http\Controllers;

use App\Models\BotFaq;
use App\Models\User;
use Illuminate\Http\Request;

class BotFaqController extends Controller
{
    public function index()
    {
        $faqs = BotFaq::all();
        return view('admin.bot-faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.bot-faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        BotFaq::create($request->all());

        return redirect()->route('bot-faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function show(BotFaq $faq)
    {
        // return view('faqs.show', compact('faq'));
    }

    public function edit(string $id)
    {
        $faq = BotFaq::find($id);
        return view('admin.bot-faqs.edit', compact('faq'));
    }

    public function update(Request $request, string $id)
    {
        $faq = BotFaq::find($id);
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->update($request->all());

        return redirect()->route('bot-faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(string $id)
    {
        $faq = BotFaq::find($id);
        $faq->delete();

        return response()->json(['status' => true, 'message' => 'Faqs deleted successfully.']);
    }

    public function getAnswer(Request $request)
    {
        $userMessage = strtolower($request->input('message'));
        $reply = BotFaq::where('question', $userMessage)->first('answer');

        $adminUsers = User::role('admin')->get(['email', 'phone', 'address']);

        $adminContactInfo = $adminUsers->map(function ($user) {
            return "<div class='fw-bold'>Get in Touch: </div><br> <div>Phone: {$user->phone}</div> <div>Email: {$user->email}</di> <div>Address: {$user->address}</div>";
        })->implode('; ');


        if ($reply)
            return response()->json(['answer' => $reply]);
        else {
            $reply = ['answer' => $adminContactInfo];
            return response()->json(['answer' => $reply]);
        }
    }
}
