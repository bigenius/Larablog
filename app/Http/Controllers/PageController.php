<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Requests;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.list', ['pages' => $pages]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $page = new Page([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        $page->save();
        return redirect()->route('lb-admin.page.index')->with(['info' => 'Page created!', 'status' => 'success' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::where('slug',$slug)->firstOrFail();
        return view('page.show', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::withTrashed()
            ->where('id', $id)
            ->get()->first();
        return view('admin.page.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $page = Page::find($id);
        $page->slug = null;
        $page->title = $request->title;
        $page->body = $request->body;

        $page->save();

        return redirect()->back()->with(['info' => 'Page updated!', 'status' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect()->route('lb-admin.page.index')->with(['info' => 'Page deleted!', 'status' => 'success' ]);
    }


    public function deleted()
    {
        $pages = Page::onlyTrashed()->orderBy('deleted_at')->get();

        return view('admin.page.deleted', ['pages' => $pages]);
    }

    public function restore($id)
    {
        Page::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('lb-admin.page.index')->with(['info' => 'Page restored!', 'status' => 'success' ]);
    }

    public function previewSlug(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);
        $slug = SlugService::createSlug(Page::class, 'slug', $request->title);
        return \Response::json($slug);

    }

}
