<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     *  $table->id();
     *    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
     *    $table->string('title');
     *    $table->text('description')->nullable();
     *    $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
     *    $table->boolean('is_completed')->default(false);
     *    $table->softDeletes();
     *    $table->timestamps();
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'is_completed' => 'required|boolean',

        ];
    }
}
