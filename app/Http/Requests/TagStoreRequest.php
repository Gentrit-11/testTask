<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class TagStoreRequest extends FormRequest
    {
        public function authorize(): bool { return true; }

        public function rules(): array
        {
            return [
                'name'  => ['required','string','max:50','unique:tags,name'],
                'color' => ['nullable','string','max:20'],
            ];
        }
    }
