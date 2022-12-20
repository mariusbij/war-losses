<?php

namespace App\Http\Requests;

use App\Services\EquipmentService\Enums\SideCountry;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Tags\Tag;

class ReportNewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'side_country' => 'required',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'source_url' => 'required|url',
            'tags' => 'required|array',
            'latitude' => 'required_with:longitude|numeric|nullable',
            'longitude' => 'required_with:latitude|numeric|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'side_country.required' => 'A side country is required',
            'category_id.required' => 'A category is required',
            'category_id.exists' => "A category doesn't exist",
            'date' => 'A date is required',
            'source_url.required' => 'A valid url is required',
            'tags.required' => 'At least one tag must be selected',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->validateSideCountry()) {
                $validator->errors()->add('side_country', "Incorrect side country provided");
            }
            if (!$this->validateTags()) {
                $validator->errors()->add('tags', "Incorrect tags provided");
            }
            if (!$this->validateIfDestroyedOnly()) {
                $validator->errors()->add('tags', "If equipment is destroyed it can't have any other tags.");
            }
        });
    }

    public function validateIfDestroyedOnly(): bool
    {
        $tags = $this->request->all('tags');
        $isDestroyed = in_array('destroyed', $tags);

        if ($isDestroyed && count($tags) > 1) {
            return false;
        }
        return true;
    }

    public function validateTags(): bool
    {
        $tags = Tag::all()->pluck('name');
        $requestTags = collect($this->request->all('tags'));
        $diff = $requestTags->diff($tags);

        if ($diff->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function validateSideCountry(): bool
    {
        $sideCountries = collect([
            SideCountry::Ukraine->value,
            SideCountry::Russia->value
        ]);

        return $sideCountries->contains($this->request->get('side_country'));
    }
}
