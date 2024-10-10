<?php

namespace App\Http\Requests\Tasks;

use App\Core\DTOs\Tasks\TaskDTO;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TaskRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string'],
            'due_date' => ['required','date_format:Y-m-d'],
            'category_id' => ['required',],
            'user_id' => ['required',],
            'project_id' => ['required',]
        ];
    }
    /**
     * Get the validation errors that may accure in the request.
     *
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 400));
    }

    /**
     * Link the DTO with the request.
     *
     */

    public function toDto(): TaskDTO
    {
        return new TaskDTO(
            $this->title,
            $this->description,
            $this->status,
            Carbon::parse($this->input('due_date')),
            $this->category_id,
            $this->user_id,
            $this->project_id,
        );
    }
}
