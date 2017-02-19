<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessTenant extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'PUT':
                $id = $this->route()->getParameter('id');
                return [
                    'name' => 'required',
                    'email' => 'required|email|unique:saas_tenants,email,' . $id,
                ];
            case 'POST':
                return [
                    'name' => 'required',
                    'organisation_unique_name' => 'required|unique:saas_tenants,organisation_unique_name|unique:saas_reserved_keywords,name|regex:/^[a-zA-Z0-9]+$/',
                    'email' => 'required|email|unique:saas_tenants,email',
                ];
            default:
                break;

        }
    }
}
