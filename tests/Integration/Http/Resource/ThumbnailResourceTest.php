<?php

namespace Tests\Integration\Resource;

use App\Http\Resources\ThumbnailResource;
use App\Models\User;
use Helmich\JsonAssert\JsonAssertions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThumbnailResourceTest extends TestCase
{
    use RefreshDatabase;
    use jsonAssertions;

    private $loggedInUser;

    public function setUp()
    {
        parent::setUp();
        $this->loggedInUser = factory(User::class)->create()->fresh();
        auth()->login($this->loggedInUser);
    }

    /** @test */
    public function does_it_return_proper_json_format()
    {
        $resource = new ThumbnailResource($this->loggedInUser);

        self::assertJsonDocumentMatchesSchema($resource->resolve(), [
            'type' => 'object',
            'additionalProperties' => false,
            'required' => [
                'username',
                'name',
                'image_url',
            ],
            'properties' => [
                'username' => ['type' => 'string'],
                'name' => ['type' => ['string', 'null']],
                'image_url' => ['type' => ['string', 'null']],
            ],
        ]);
    }
}
