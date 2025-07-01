<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;



class AdminController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with('category')->CategorySearch($request->category_id)->GenderSearch($request->gender)->KeywordSearch($request->keyword)->DateSearch($request->date)->paginate(7);

        $categories = Category::all();

        return view('admin',compact('contacts', 'categories'));
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        Contact::findOrFail($id)->delete();

        return redirect('/admin');
    }

    public function export(Request $request)
    {
        $contacts = Contact::with('category')
        ->CategorySearch($request->category_id)
        ->GenderSearch($request->gender)
        ->KeywordSearch($request->keyword)
        ->DateSearch($request->date)
        ->get();

    $headers = [
        "Content-Type"        => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=contacts.csv",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0",
    ];

    $callback = function () use ($contacts) {
        $file = fopen('php://output', 'w');

        fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

        fputcsv($file, ['姓', '名', '性別', 'メールアドレス', 'お問い合わせの種類', '登録日']);

        foreach ($contacts as $contact) {
            fputcsv($file, [
                $contact->last_name,
                $contact->first_name,
                $contact->gender === '1' ? '男性' : ($contact->gender === '2' ? '女性' : 'その他'),
                $contact->email,
                optional($contact->category)->content,
                $contact->created_at->format('Y-m-d'),
            ]);
        }

        fclose($file);
    };

        return Response::stream($callback, 200, $headers);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
