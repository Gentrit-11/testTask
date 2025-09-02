<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ProjectUpdateRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'name'        => ['required','string','max:255'],
                'description' => ['nullable','string'],
                'start_date'  => ['nullable','date'],
                'deadline'    => ['nullable','date','after_or_equal:start_date'],
            ];
        }
    }
