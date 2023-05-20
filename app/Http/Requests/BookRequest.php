<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize():bool{
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules():array{
    return [
      'title' => 'required|max:1000',
      'author' => 'required|max:5000',
      'description' => 'max:2000',
      'img' => 'mimes:jpeg,jpg,png|max:2048',
      'xlsx' => 'mimes:xlsx|max:2048'
    ];
  }
}