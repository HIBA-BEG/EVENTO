<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function view()
    {
        $categories = Category::all();
        return view('admin.home', compact('categories'));
    }
    public function create(Request $request)
    {
        try {
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
            ]);

            $user = Auth::user();

            Category::create([
                'title' => $request->title,
                'user_id' => $user->id,
            ]);
            return redirect()->route('admin.home');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
            ]);
            $category  = Category::findOrFail($request->categoryID);

            $category->update([
                'title' => $request->title,
            ]);

            return redirect()->route('admin.home', compact('category'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.home');
    }
}
