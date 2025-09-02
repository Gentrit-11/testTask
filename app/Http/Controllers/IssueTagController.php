<?php

    namespace App\Http\Controllers;

    use App\Models\Issue;
    use App\Models\Tag;

    class IssueTagController extends Controller
    {
        public function attach(Issue $issue, Tag $tag)
        {
            $issue->tags()->syncWithoutDetaching([$tag->id]);
            return response()->json([
                'ok'   => true,
                'tags' => $issue->tags()->orderBy('name')->get(['id','name','color']),
            ]);
        }

        public function detach(Issue $issue, Tag $tag)
        {
            $issue->tags()->detach($tag->id);
            return response()->json([
                'ok'   => true,
                'tags' => $issue->tags()->orderBy('name')->get(['id','name','color']),
            ]);
        }
    }
