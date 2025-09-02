<?php

    namespace App\Http\Controllers;

    use App\Models\Tag;
    use App\Http\Requests\TagStoreRequest;

    class TagController extends Controller
    {
        public function index()
        {
            $tags = Tag::orderBy('name')->paginate(20);
            return view('tags.index', compact('tags'));
        }

        public function store(TagStoreRequest $request)
        {
            Tag::create($request->validated());
            return back()->with('success','Tag created.');
        }

        public function destroy(Tag $tag)
        {
            $tag->delete();
            return back()->with('success','Tag deleted.');
        }
    }
