<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {

        $tel = $request->input('tel1') . $request->input('tel2') . $request->input('tel3');
        $request->merge(['tel' => $tel]);

        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail',
        ]);

        $category = Category::find($contact['category_id']);
        $category_content = optional($category)->content;

        return view('confirm', compact('contact', 'category_content'));
    }

    public function edit(Request $request)
    {

        $tel = $request->input('tel');
        if (preg_match('/^(\d{2,4})(\d{4})(\d{4})$/', $tel, $matches)) {
        $request->merge([
            'tel1' => $matches[1],
            'tel2' => $matches[2],
            'tel3' => $matches[3],
        ]);
        }
        return redirect('/')->withInput($request->all());
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
            'category_id',
            'user_id'
        ]);

        $contact['user_id'] = Auth::id();

        Contact::create($contact);
        return redirect()->route('thanks');
    }

}