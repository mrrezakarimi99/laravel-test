<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Modules\Policy\Models\Policy;
use Tests\TestCase;

class PolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testPaginatingGetAllPolicies()
    {
        Policy::factory(10)->create();

        $response = $this->getJson('/api/v1/policies');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
            'links' => [
                'first',
                'last',
                'next',
                'prev',
            ],
            'meta'  => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);
    }

    /** @test */
    function test_store_policy_is_success()
    {
        $response = $this->postJson('/api/v1/policies', [
            'title'                    => '##title##',
            'acknowledgement_required' => true,
            'file'                     => UploadedFile::fake()->image('test.png', '100', '111'),
        ]);
        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data' => [
                'title',
                'acknowledgement_required',
                'file',
                'file_type',
                'is_trashed',
                'date_uploaded'
            ]
        ]);

        $policy = Policy::query()->first();

        $this->assertEquals('##title##', $policy->title);
    }

    /** @test */
    function test_store_policy_validation_failed()
    {
        $response = $this->postJson('/api/v1/policies', [
            'title'                    => '##title##',
            'acknowledgement_required' => true,
        ]);
        $response->assertJsonValidationErrors(['file']);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    /** @test */
    function test_index_policy()
    {
        $json = $this->get('/api/v1/policies')->json();

        $this->assertEmpty($json['data']);

        Policy::factory(10)->create();

        $response = $this->get('/api/v1/policies');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'acknowledgement_required',
                    'file',
                    'file_type',
                    'is_trashed',
                    'date_uploaded',
                ]
            ],
            'links' => [
                'first',
                'last',
                'next',
                'prev',
            ],
            'meta'  => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);
    }

    /** @test */
    function test_trash_policy_is_success()
    {
        $policy = Policy::factory(1)->create();
        $firstId = $policy->first()->id;
        $response = $this->get("/api/v1/policies/$firstId/trash");
        $response->assertSuccessful();
        $response->assertExactJson([
            'message' => 'policy move to trash'
        ]);
    }

    /** @test */
    function test_delete_policy_is_success()
    {
        $policy = Policy::factory(1)->create();
        $firstId = $policy->first()->id;
        $response = $this->delete("/api/v1/policies/$firstId");
        $response->assertSuccessful();
        $response->assertExactJson([
            'message' => 'policy was deleted'
        ]);
    }

}
