<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class TeamCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'member_type_id' => 'required|exists:member_types,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:teams,email',
        'gender' => 'required|in:male,female,other',
        'phone' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
        'address' => 'nullable|string|max:255',
        'facebook' => 'nullable|url',
        'instagram' => 'nullable|url',
        'twitter' => 'nullable|url',
        'linkedin' => 'nullable|url',
        'github' => 'nullable|url',
        'youtube' => 'nullable|url',
        'website' => 'nullable|url',
        'birthday' => 'nullable|date|before:today',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ];
}

}
