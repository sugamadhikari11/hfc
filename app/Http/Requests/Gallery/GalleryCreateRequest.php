<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class GalleryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:galleries,slug',
            'files_field' => 'nullable|array',
            'files_field.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'others_field' => 'nullable|array',
            'category_id' => 'nullable|exists:gallery_categories,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The gallery title is required.',
            'title.max' => 'The gallery title may not be greater than 255 characters.',
            'slug.unique' => 'This slug has already been taken.',
            'files_field.*.mimes' => 'Only jpeg, png, jpg, gif, svg files are allowed.',
            'files_field.*.max' => 'Each file may not be greater than 2MB.',
            'category_id.exists' => 'The selected category is invalid.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->title && !$this->slug) {
            $this->merge([
                'slug' => \Str::slug($this->title),
            ]);
        }
    }
}