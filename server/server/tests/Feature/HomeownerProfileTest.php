<?php

use App\Models\User;
use App\Models\HomeownerProfile;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user, 'api');
});

test('can list homeowner profiles', function () {
    HomeownerProfile::factory()->count(3)->create();
    
    $response = $this->getJson('/api/v1/homeowner_profiles');
    
    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => ['user_id', 'preferred_zip', 'city']
            ],
            'success'
        ]);
});

test('can show homeowner profile', function () {
    $profile = HomeownerProfile::factory()->create();
    
    $response = $this->getJson("/api/v1/homeowner_profiles/{$profile->user_id}");
    
    $response->assertOk()
        ->assertJson(['success' => true]);
});

test('can create homeowner profile', function () {
    $data = [
        'user_id' => $this->user->id,
        'preferred_zip' => '12345',
        'city' => 'Test City'
    ];
    
    $response = $this->postJson('/api/v1/homeowner_profiles', $data);
    
    $response->assertCreated()
        ->assertJson(['success' => true]);
});

test('can update homeowner profile', function () {
    $profile = HomeownerProfile::factory()->create();
    
    $response = $this->putJson("/api/v1/homeowner_profiles/{$profile->user_id}", [
        'city' => 'Updated City'
    ]);
    
    $response->assertOk()
        ->assertJson(['success' => true]);
});

test('can delete homeowner profile', function () {
    $profile = HomeownerProfile::factory()->create();
    
    $response = $this->deleteJson("/api/v1/homeowner_profiles/{$profile->user_id}");
    
    $response->assertOk()
        ->assertJson(['success' => true]);
});