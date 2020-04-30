<?php

declare(strict_types=1);

namespace Directus\Requests;

use Directus\Database\Models\Folder;
use Illuminate\Foundation\Http\FormRequest;

class FolderRequest extends FormRequest
{
    /**
     * @var array<string>
     */
    private $fieldRules = [
        'name' => 'required|string|unique:'.Folder::class.',name,NULL,id,parent_id',
        'parent_id' => 'nullable|exists:'.Folder::class.',id',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = $this->fieldRules;

        if ($this->method() === 'PATCH') {
            $key = $this->route('key');
            $rules['name'] = 'string|unique:'.Folder::class.',name,'.$key.',id,parent_id';
        }

        $parent_id = $this->input('parent_id', 'NULL');
        $rules['name'] .= ','.$parent_id;

        return $rules;
    }

    public function messages(): array
    {
        return [];
    }
}
