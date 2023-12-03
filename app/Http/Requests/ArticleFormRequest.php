<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->isAuthor() || $this->user()->isEditor()){
            return true;
        }
        return false;
    }

        /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->isMethod('post')){

            return $this->requiredRules();
        } else {
            return $this->requiredRules();
        }
    }

    public function messages()
    {
        if(request()->isMethod('post')){

            return $this->customizedMessages();
        } else {
            return $this->customizedMessages();
        }
    }

    public function requiredRules()
    {
        $requiredRules = [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'content' => 'required|string',
            'caption' => 'required',
            'keywords' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg,bmp|max:2048',
            'category_id'   => 'required|exists:categories,id',
            'tags'   => 'required|exists:tags,id',
        ];

        return $requiredRules;
    }

    public function customizedMessages()
    {
        $customized_messages = [
                'title.required' => 'The article title is required',
                'description.required' => 'The article description is required',
                'content.required' => 'The article content is required',
                'caption.required' => 'The article caption is required',
                'keywords.required' => 'The keywords related to the article are required',
                'image.required' => 'The featured image is required',
                'category_id.required'   => 'The category the article belongs to is required',
                'tags.required'   => 'The tags the article belongs to are required',
        ];

        return $customized_messages;
    }

    public function getValidRequest()
    {
        return [
            'author_id' => $this->input('author_id'),
            'category_id' => $this->input('category'),
            'slug' => $this->input('slug'),
            'title' => $this->input('title'),
            'subtitle' => $this->input('subtitle'),
            'content' => $this->input('content'),
            'article_image' => $this->input('article_image'),
            'meta_keywords' => $this->input('meta_keywords'),
            'meta_description' => $this->input('meta_description'),
            'is_published' => $this->input('is_published') ?? false,
            'published_at' => $this->input('published_at'),
        ];
    }
}
