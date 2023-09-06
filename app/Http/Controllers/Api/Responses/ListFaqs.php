<?php

namespace App\Http\Controllers\Api\Responses;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;

use App\Models\Faqs;

class ListFaqs extends DataInterface
{
    public int $id;
    public string $title;
    public string $body;
    public string $video;

    /**
     * @param Faqs $faqs
     * @param string $language
     */

    public function __construct(Faqs $faqs, string $language)

    {
        $this->id = $faqs->id;
        $this->title = $language=='en'?$faqs->title_en:$faqs->title_ar;
        $this->body = $language=='en'?$faqs->body_en:$faqs->body_ar;
    }
}
