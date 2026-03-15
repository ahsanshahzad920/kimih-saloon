<?php

namespace App\Http\Controllers;

use App\Models\BotFaq;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqsController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.cms.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.cms.faqs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $data['user_id'] = Auth::id();

        FAQ::create($data);
        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function show(FAQ $faq)
    {
    }

    public function edit(Faq $faq)
    {
        return view('admin.cms.faqs.edit', compact('faq'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->update($request->all());
        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return response()->json(['status' => true, 'message' => 'Faqs deleted successfully.']);
    }

    public function frontFaqs()
    {
        $faqs = Faq::all();
        $botFaqs = BotFaq::pluck('question');

        return view('user.faqs', compact('faqs', 'botFaqs'));
    }
}
