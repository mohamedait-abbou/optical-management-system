<?php

use App\Models\Customer;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);

    $user = User::factory()->create([
        'name' => 'Test Admin',
        'email' => 'admin@test.com',
    ]);
    $user->assignRole('Admin');

    $this->actingAs($user);
});

it('can list customers', function () {
    Customer::factory()->count(3)->create();

    $response = $this->get(route('customers.index'));

    $response->assertOk();
    $response->assertViewHas('customers');
});

it('can show the create form', function () {
    $response = $this->get(route('customers.create'));

    $response->assertOk();
});

it('can store a customer', function () {
    $data = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'cin' => 'AB123456',
        'phone' => '0612345678',
        'email' => 'john@example.com',
        'address' => '123 Main St',
        'birth_date' => '1990-01-15',
        'gender' => 'M',
        'notes' => 'Test notes',
    ];

    $response = $this->post(route('customers.store'), $data);

    $response->assertRedirect(route('customers.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('customers', [
        'email' => 'john@example.com',
        'cin' => 'AB123456',
    ]);
});

it('can store a customer with Male gender value', function () {
    $data = [
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'phone' => '0698765432',
        'gender' => 'Male',
    ];

    $this->post(route('customers.store'), $data);

    $this->assertDatabaseHas('customers', [
        'first_name' => 'Jane',
        'gender' => 'M',
    ]);
});

it('can store from reservation quick-add modal', function () {
    $data = [
        'first_name' => 'Quick',
        'last_name' => 'Add',
        'phone' => '0600000000',
        'redirect_to_reservation' => '1',
    ];

    $response = $this->post(route('customers.store'), $data);

    $response->assertRedirect();
    $response->assertSessionHas('new_customer_id');
});

it('can show a customer', function () {
    $customer = Customer::factory()->create();

    $response = $this->get(route('customers.show', $customer));

    $response->assertOk();
    $response->assertSee($customer->first_name);
});

it('can show customer card via AJAX', function () {
    $customer = Customer::factory()->create();

    $response = $this->get(route('customers.card', $customer), [
        'X-Requested-With' => 'XMLHttpRequest',
    ]);

    $response->assertOk();
    $response->assertJsonStructure(['title', 'html']);
});

it('can show the edit form', function () {
    $customer = Customer::factory()->create();

    $response = $this->get(route('customers.edit', $customer));

    $response->assertOk();
});

it('can update a customer', function () {
    $customer = Customer::factory()->create([
        'first_name' => 'Old',
        'last_name' => 'Name',
    ]);

    $response = $this->put(route('customers.update', $customer), [
        'first_name' => 'New',
        'last_name' => 'Name',
        'phone' => '0611111111',
    ]);

    $response->assertRedirect(route('customers.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('customers', [
        'id' => $customer->id,
        'first_name' => 'New',
    ]);
});

it('can delete a customer', function () {
    $customer = Customer::factory()->create();

    $response = $this->delete(route('customers.destroy', $customer));

    $response->assertRedirect(route('customers.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
});

it('can search customers', function () {
    Customer::factory()->create(['first_name' => 'UniqueName', 'last_name' => 'SearchTest']);
    Customer::factory()->count(5)->create();

    $response = $this->get(route('customers.index', ['search' => 'UniqueName']));

    $response->assertOk();
    $response->assertSee('UniqueName');
});

it('can search customers by CIN', function () {
    Customer::factory()->create(['cin' => 'ZZ999999']);

    $response = $this->get(route('customers.index', ['search' => 'ZZ999999']));

    $response->assertOk();
    $response->assertSee('ZZ999999');
});

it('can search customers by phone', function () {
    Customer::factory()->create(['phone' => '0777777777']);

    $response = $this->get(route('customers.index', ['search' => '0777777777']));

    $response->assertOk();
    $response->assertSee('0777777777');
});

it('requires authentication', function () {
    auth()->logout();

    $this->get(route('customers.index'))->assertRedirect(route('login'));
    $this->get(route('customers.create'))->assertRedirect(route('login'));
    $this->post(route('customers.store'), [])->assertRedirect(route('login'));
});
