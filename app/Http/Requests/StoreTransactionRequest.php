<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->role->role == 'customer';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "service_type" => "required|in:door to door,office collection,rush,city delivery,city pickup",
            "customer_id" => "required|integer",
            "receiver_name" => "required|string",
            "receiver_phone" => "required|string|min:8",
            "whatsapp_status" => "required|in:offline,online",
            "fragile" => "required|in:yes,no",
            "electronics" => "required|in:yes,no",
            "location" => "required|string",
            "district" => "required|string",
            "payment_term" => "required|string"
        ];
    }
}
