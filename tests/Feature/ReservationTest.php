<?php

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);

    $user = User::factory()->create(['name' => 'Test Admin']);
    $user->assignRole('Admin');

    $this->actingAs($user);
});

it('can list reservations', function () {
    Reservation::factory()->count(3)->create();

    $response = $this->get(route('reservations.index'));

    $response->assertOk();
    $response->assertViewHas('reservations');
});

it('can show the create form', function () {
    Customer::factory()->count(3)->create();

    $response = $this->get(route('reservations.create'));

    $response->assertOk();
});

it('can store a reservation', function () {
    $customer = Customer::factory()->create();

    $data = [
        'customer_id' => $customer->id,
        'reservation_date' => '2026-08-15',
        'reservation_time' => '10:30',
        'reason' => 'Examen de la vue',
        'status' => 'pending',
        'notes' => 'Test notes',
    ];

    $response = $this->post(route('reservations.store'), $data);

    $response->assertRedirect(route('reservations.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('reservations', [
        'customer_id' => $customer->id,
        'reservation_date' => '2026-08-15 00:00:00',
    ]);
});

it('can store a reservation with required fields only', function () {
    $customer = Customer::factory()->create();

    $response = $this->post(route('reservations.store'), [
        'customer_id' => $customer->id,
        'reservation_date' => '2026-08-20',
        'reservation_time' => '14:00',
        'status' => 'confirmed',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('reservations', ['customer_id' => $customer->id]);
});

it('can show a reservation', function () {
    $reservation = Reservation::factory()->create();

    $response = $this->get(route('reservations.show', $reservation));

    $response->assertOk();
    $response->assertSee($reservation->reservation_date->format('d/m/Y'));
});

it('can show reservation card via AJAX', function () {
    $reservation = Reservation::factory()->create();

    $response = $this->get(route('reservations.card', $reservation), [
        'X-Requested-With' => 'XMLHttpRequest',
    ]);

    $response->assertOk();
    $response->assertJsonStructure(['title', 'html']);
});

it('can show the edit form', function () {
    $reservation = Reservation::factory()->create();

    $response = $this->get(route('reservations.edit', $reservation));

    $response->assertOk();
});

it('can update a reservation', function () {
    $reservation = Reservation::factory()->create([
        'status' => 'pending',
    ]);
    $newCustomer = Customer::factory()->create();

    $response = $this->put(route('reservations.update', $reservation), [
        'customer_id' => $newCustomer->id,
        'reservation_date' => '2026-09-01',
        'reservation_time' => '09:00',
        'status' => 'confirmed',
        'reason' => 'Updated reason',
    ]);

    $response->assertRedirect(route('reservations.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('reservations', [
        'id' => $reservation->id,
        'status' => 'confirmed',
    ]);
});

it('can delete a reservation', function () {
    $reservation = Reservation::factory()->create();

    $response = $this->delete(route('reservations.destroy', $reservation));

    $response->assertRedirect(route('reservations.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('reservations', ['id' => $reservation->id]);
});

it('can search reservations by customer name', function () {
    $customer = Customer::factory()->create(['first_name' => 'SearchableName']);
    Reservation::factory()->create(['customer_id' => $customer->id]);
    Reservation::factory()->count(3)->create();

    $response = $this->get(route('reservations.index', ['search' => 'SearchableName']));

    $response->assertOk();
    $response->assertSee('SearchableName');
});

it('can search reservations by reason', function () {
    Reservation::factory()->create(['reason' => 'UniqueReasonXYZ']);

    $response = $this->get(route('reservations.index', ['search' => 'UniqueReasonXYZ']));

    $response->assertOk();
    $response->assertSee('UniqueReasonXYZ');
});

it('validates required fields when storing', function () {
    $response = $this->post(route('reservations.store'), []);

    $response->assertSessionHasErrors(['customer_id', 'reservation_date', 'reservation_time', 'status']);
});

it('requires authentication', function () {
    auth()->logout();

    $this->get(route('reservations.index'))->assertRedirect(route('login'));
    $this->get(route('reservations.create'))->assertRedirect(route('login'));
    $this->post(route('reservations.store'), [])->assertRedirect(route('login'));
});

it('does not create demo reservations when database has data', function () {
    Reservation::factory()->create();

    $this->get(route('reservations.index'));

    $this->assertDatabaseCount('reservations', 1);
});

it('can access the calendar page', function () {
    $response = $this->get(route('reservations.calendar'));

    $response->assertOk();
});
