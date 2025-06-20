<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    // Add this method to the class
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?: $this->name)
        ]);
    }
    public function authorize(): bool
    {
        return true; // Change to your authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $categoryId = $this->route('category')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($categoryId)
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($categoryId)
            ],
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($categoryId) {
                    // Prevent category from being its own parent
                    if ($value == $categoryId) {
                        $fail('A category cannot be its own parent.');
                    }
                }
            ],
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'parent_id.exists' => 'The selected parent category does not exist.',
            'name.unique' => 'This category name is already in use.',
            'slug.unique' => 'This category slug is already in use.'
        ];
    }
}
