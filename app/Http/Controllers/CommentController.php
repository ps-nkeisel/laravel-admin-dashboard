<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Exception;

class CommentController extends Controller
{
    /**
     * Display a listing of the comments.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $comments = Comment::paginate(25);

        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new comment.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('comments.create');
    }

    /**
     * Store a new comment in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            Comment::create($data);

            return redirect()->route('comments.index')
                ->with('success_message', 'Comment was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified comment.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified comment.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);


        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $comment = Comment::findOrFail($id);
            $comment->update($data);

            return redirect()->route('comments.index')
                ->with('success_message', 'Comment was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified comment from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return redirect()->route('comments.index')
                ->with('success_message', 'Comment was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'active' => 'nullable|boolean',
            'archive' => 'nullable|boolean',
            'assignto' => 'required|numeric|min:-2147483648|max:2147483647',
            'created_ip' => 'nullable|string|min:0|max:45',
            'created_user' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'idcondition' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'idcountry' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'idinnoculation' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'idtransitvisa' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'idversionbefore' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'idversionnext' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'idvisa' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'linkresource' => 'nullable|string|min:0|max:2000',
            'updated_ip' => 'nullable|string|min:0|max:45',
            'updated_user' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'version' => 'nullable|numeric|min:-2147483648|max:2147483647',
        ];

        $data = $request->validate($rules);

        $data['active'] = $request->has('active');
        $data['archive'] = $request->has('archive');

        return $data;
    }

}
