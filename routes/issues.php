<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\IssueController;
    use App\Http\Controllers\IssueTagController;
    use App\Http\Controllers\CommentController;

    Route::resource('issues', IssueController::class);

    Route::post('issues/{issue}/tags/{tag}',   [IssueTagController::class,'attach'])->name('issues.tags.attach');
    Route::delete('issues/{issue}/tags/{tag}', [IssueTagController::class,'detach'])->name('issues.tags.detach');

    Route::get('issues/{issue}/comments',  [CommentController::class,'index'])->name('issues.comments.index');
    Route::post('issues/{issue}/comments', [CommentController::class,'store'])->name('issues.comments.store');
