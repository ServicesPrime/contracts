<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
            // Campos requeridos para tabla clients (email único excluyendo el actual)
            'name' => 'required|string|min:2|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('clients')->ignore($this->route('client'))
            ],
            'phone' => 'required|string|min:10|max:20',
            'area' => 'required|string|max:255',
            
            // Campos opcionales para tabla addresses
            'name_account' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:50',
            'zip_code' => 'nullable|string|max:10|regex:/^[0-9]{5}$/',
            'country' => 'nullable|string|max:100'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Mensajes para tabla clients
            'name.required' => 'The client name is required.',
            'name.min' => 'The client name must be at least 2 characters.',
            'name.max' => 'The client name cannot exceed 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'email.max' => 'The email address cannot exceed 255 characters.',
            'phone.required' => 'The phone number is required.',
            'phone.min' => 'The phone number must be at least 10 characters.',
            'phone.max' => 'The phone number cannot exceed 20 characters.',
            'area.required' => 'The area field is required.',
            'area.max' => 'The area cannot exceed 255 characters.',
            
            // Mensajes para tabla addresses
            'name_account.max' => 'The account name cannot exceed 255 characters.',
            'street.max' => 'The street address cannot exceed 500 characters.',
            'city.max' => 'The city name cannot exceed 100 characters.',
            'state.max' => 'The state cannot exceed 50 characters.',
            'zip_code.max' => 'The zip code cannot exceed 10 characters.',
            'zip_code.regex' => 'The zip code must be exactly 5 digits.',
            'country.max' => 'The country name cannot exceed 100 characters.'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'client name',
            'email' => 'email address',
            'phone' => 'phone number',
            'area' => 'area',
            'name_account' => 'account name',
            'street' => 'street address',
            'city' => 'city',
            'state' => 'state',
            'zip_code' => 'zip code',
            'country' => 'country'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->input('name') ? trim($this->input('name')) : null,
            'email' => $this->input('email') ? strtolower(trim($this->input('email'))) : null,
            'phone' => $this->input('phone') ? trim($this->input('phone')) : null,
            'area' => $this->input('area') ? trim($this->input('area')) : null,
            'name_account' => $this->input('name_account') ? trim($this->input('name_account')) : null,
            'street' => $this->input('street') ? trim($this->input('street')) : null,
            'city' => $this->input('city') ? trim($this->input('city')) : null,
            'state' => $this->input('state') ? trim($this->input('state')) : null,
            'zip_code' => $this->input('zip_code') ? trim($this->input('zip_code')) : null,
            'country' => $this->input('country') ? trim($this->input('country')) : null,
        ]);
    }

    /**
     * Get client data for the clients table.
     *
     * @return array
     */
    public function getClientData(): array
    {
        return $this->only(['name', 'email', 'phone', 'area']);
    }

    /**
     * Get address data for the addresses table.
     *
     * @return array
     */
    public function getAddressData(): array
    {
        return $this->only(['name_account', 'street', 'city', 'state', 'zip_code', 'country']);
    }

    /**
     * Check if request has address data.
     *
     * @return bool
     */
    public function hasAddressData(): bool
    {
        $addressFields = ['name_account', 'street', 'city', 'state', 'zip_code', 'country'];
        
        return collect($addressFields)->some(function ($field) {
            return !empty($this->input($field));
        });
    }

    /**
     * Generate full address from individual fields.
     *
     * @return string|null
     */
    public function getFullAddress(): ?string
    {
        $addressParts = array_filter([
            $this->input('street'),
            $this->input('city'),
            $this->input('state'),
            $this->input('zip_code'),
            $this->input('country')
        ]);

        return !empty($addressParts) ? implode(', ', $addressParts) : null;
    }
}