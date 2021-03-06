<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index()
    {
        $author = User::all();

        return view('admin.index', [
           'authors' => $author->toArray()
        ]);
    }
    public function getAuthors()
    {
        $authors = User::with('userDetail')->where('user_type', 2)->get();

        return view('admin.authors_list', [
            'authors' => $authors->toArray()
        ]);
    }
     public function showAuthor($id)
    {
        $author = User::find($id);


        return view('admin.view_author', [
            'articles' => $author->articles()->orderBy('id', 'desc')->take(10)->get(),
            'author' => $author
        ]);
    }

    public function showAllAuthorArticles(Request $request, $id)
    {
        $author = User::find($id);
        $items_per_page = $request->get('items_per_page', 5);


        return view('admin.author_articles', [
            'articles' => $author->articles()->paginate($items_per_page)
                            ->withPath(route('author.articles', ['id'=>$author->id])."?items_per_page=".strval($items_per_page)),
            'author' => $author
        ]);


    }

    public function showEditAuthor($id)
    {
        $author = User::with('userDetail')->find($id);


        return view('admin.edit_author', [
            'author' => $author->toArray()
        ]);
    }

    public function deletePopup($id)
    {
        $author = User::with('userDetail')->find($id);

        return view('admin.confirm_delete', [
            'author' => $author->toArray()
        ]);
    }

    public function deleteAuthor($id)
    {

        $author = User::find($id);
        $author->articles()->delete();
        $author->userDetail()->delete();
        $author->delete();

        return view('admin.delete', [
            'author' => $author->toArray()
        ]);
    }

    public function updateAuthor(Request $request, $id)
    {
        $input = $request->all();
        unset($input['_method']);
        unset($input['_token']);
        unset($input['Update']);
        $author = User::find($id);

        $author->userDetail()->update([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname']
        ]);

        return redirect()->route('authors.index');
    }

}
