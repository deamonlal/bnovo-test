<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_store_guest(): void
    {
        $data = [
            'name' => fake()->name,
            'surname' => fake()->lastName,
            'email' => fake()->email,
            'phone' => fake()->e164PhoneNumber,
            'country' => fake()->country,
        ];
        $response = $this->post('api/v1/guest', $data);
        $response->assertStatus(201);

        $guestData = $response->json()['data'];

        $expectedFields = array_keys($data);
        $filteredGuestArray = array_intersect_key($guestData, array_flip($expectedFields));

        $this->assertEqualsCanonicalizing($data, $filteredGuestArray);
    }

    public function test_store_guest_without_country_and_email(): void
    {
        $data = [
            'name' => fake()->name,
            'surname' => fake()->lastName,
            'phone' => fake()->e164PhoneNumber,
        ];
        $response = $this->post('api/v1/guest', $data);
        $response->assertStatus(201);

        $data['country'] = $response->json()['data']['country'];

        $guestData = $response->json()['data'];

        $expectedFields = array_keys($data);
        $filteredGuestArray = array_intersect_key($guestData, array_flip($expectedFields));

        $this->assertEqualsCanonicalizing($data, $filteredGuestArray);
    }

    /**
     * @depends test_store_guest
     */
    public function test_delete_guest(): void
    {
        $data = $this->createGuest();

        $guestId = $data['id'];
        $response = $this->delete('api/v1/guest/' . $guestId);
        $response->assertStatus(200);

        $response->assertJson([
            'status' => true,
            'message' => 'The guest was deleted successfully'
        ]);
    }

    /**
     * @depends test_store_guest
     */
    public function test_update_guest(): void
    {
        $data = $this->createGuest();

        $data['name'] .= '!';
        $data['surname'] .= '!';
        $data2 = [
            'name' => $data['name'],
            'surname' => $data['surname'],
        ];

        $guestId = $data['id'];
        $response = $this->put('api/v1/guest/' . $guestId, $data2);
        $response->assertStatus(200);

        $guestData = $response->json()['data'];

        $expectedFields = array_keys($data);
        $filteredGuestArray = array_intersect_key($guestData, array_flip($expectedFields));

        $this->assertEqualsCanonicalizing($data, $filteredGuestArray);
    }

    /**
     * @depends test_store_guest
     */
    public function test_show_guest(): void
    {
        $guestData = $this->createGuest();

        $response = $this->get('api/v1/guest/' . $guestData['id']);
        $response->assertStatus(200);

        $response->assertJson([
            'status' => true,
            'data' => $guestData
        ]);
    }

    /**
     * @depends test_store_guest
     */
    public function test_index_guest(): void
    {
        $this->createGuest();

        $response = $this->get('api/v1/guest/?limit=10&offset=0');
        $response->assertStatus(200);

        $this->assertCount(1, $response->json()['data']);
    }

    private function createGuest(): array
    {
        $data = [
            'name' => fake()->name,
            'surname' => fake()->lastName,
            'email' => fake()->email,
            'phone' => fake()->e164PhoneNumber,
            'country' => fake()->country,
        ];
        $response = $this->post('api/v1/guest', $data);
        return $response['data'];
    }
}
