<?php

    namespace App\Http\Controllers;

    use App\Models\Issue;
    use App\Http\Requests\CommentStoreRequest;

    class CommentController extends Controller
    {
        public function index(Issue $issue)
        {
            $comments = $issue->comments()->latest()->paginate(5);

            return response()->json([
                'data' => $comments->through(fn($c)=>[
                    'id'=>$c->id,
                    'author_name'=>$c->author_name,
                    'body'=>$c->body,
                    'created_at'=>$c->created_at->toDateTimeString(),
                ]),
                'meta' => [
                    'current_page'=>$comments->currentPage(),
                    'last_page'=>$comments->lastPage(),
                    'next_page_url'=>$comments->nextPageUrl(),
                    'prev_page_url'=>$comments->previousPageUrl(),
                ],
            ]);
        }

        public function store(Issue $issue, CommentStoreRequest $request)
        {
            $c = $issue->comments()->create($request->validated());

            return response()->json([
                'ok'=>true,
                'comment'=>[
                    'id'=>$c->id,
                    'author_name'=>$c->author_name,
                    'body'=>$c->body,
                    'created_at'=>$c->created_at->toDateTimeString(),
                ]
            ], 201);
        }
    }
