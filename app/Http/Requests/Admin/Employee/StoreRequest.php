<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'identity_number' =>'required|unique:employees,identity_number',
            'birthday' => 'required|date_format:Y-m-d|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'email' => 'required|email|unique:employees,email',
            //'image' => 'required|mimes:jpeg,png,jpg,gif',
        ];
    }

    public function messages (): array
    {
        return [
            'name.required' => 'Please enter Category Name',
            'name.unique' => 'This Name already exists',
            'birthday.required' => 'Please enter birth.', 
            'birthday.before_or_equal' => 'Employee must be at least 18 years old',
            'birthday.after' => 'Employees must be 18 years old or over',  
            'email.required' => 'Please enter email',  
            'email.email' => 'Invalid email',
            'email.unique' => 'This Email already exists',
            'image.required' => 'Please choose Image!',
            'image.mimes' => 'Image format is invalid. Only JPEG, PNG, JPG and GIF are allowed',
        ];
    }
}
