<?php

namespace App\Models\Response;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Tests\Fixtures\Controller\NullableController;

class GetPetResponse extends Model
{
    protected $connection = null;

    protected $fillable = [
        'id',
        'category',
        'name',
        'photoUrls',
        'tags',
        'status',
    ];

    protected $casts = [
        'category' => 'array',
        'photoUrls' => 'array',
        'tags' => 'array',
    ];

    /**
     * @param array $data
     * @return self
     */
    public static function createFromApiResponse(array $data)
    {
        $instance = new self();
        $instance->id = $data['id'];
        $instance->category = $data['category'] ?? Null;
        $instance->name = $data['name'] ?? Null;
        $instance->photoUrls = $data['photoUrls'] ?? Null;
        $instance->tags = $data['tags'] ?? Null;
        $instance->status = $data['status'] ?? Null;

        return $instance;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category['name'] ?? 'Unknown';
    }
}
