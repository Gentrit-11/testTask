<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class CommentStoreRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'author_name' => ['required','string','max:100'],
                'body'        => ['required','string','min:3'],
            ];
        }
    }
