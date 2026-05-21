<?php

namespace Tests\Feature;

use App\Models\Guest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationRsvpTest extends TestCase
{
    use RefreshDatabase;

    public function test_invited_guest_can_rsvp_and_update_status()
    {
        // 1. Create a guest in DB
        $guest = Guest::create([
            'nama' => 'Budi Santoso',
            'status_hadir' => 'PENDING',
            'ucapan' => null,
            'plusone' => 1,
            'link_undangan' => 'http://localhost?to=budi-santoso'
        ]);

        // 2. Submit RSVP with guest_id to update
        $response = $this->post(route('undangan.rsvp'), [
            'guest_id' => $guest->id,
            'nama' => 'Budi Santoso',
            'hadir' => 'HADIR',
            'ucapan' => 'Selamat menempuh hidup baru!',
            'plusone' => 3,
        ]);

        // 3. Assert success JSON response
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'nama' => 'Budi Santoso',
            'status_hadir' => 'HADIR',
            'ucapan' => 'Selamat menempuh hidup baru!',
        ]);

        // 4. Assert guest was updated in the DB
        $guest->refresh();
        $this->assertEquals('HADIR', $guest->status_hadir);
        $this->assertEquals('Selamat menempuh hidup baru!', $guest->ucapan);
        $this->assertEquals(3, $guest->plusone);
    }

    public function test_non_invited_guest_creates_new_guest_record()
    {
        // 1. Submit RSVP for a new guest (no guest_id)
        $response = $this->post(route('undangan.rsvp'), [
            'nama' => 'Rian Wijaya',
            'hadir' => 'TIDAK',
            'ucapan' => 'Maaf tidak bisa hadir, selamat ya!',
            'plusone' => 2,
        ]);

        // 2. Assert success JSON response
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'nama' => 'Rian Wijaya',
            'status_hadir' => 'TIDAK',
            'ucapan' => 'Maaf tidak bisa hadir, selamat ya!',
        ]);

        // 3. Assert new guest was created in DB
        $this->assertDatabaseHas('guests', [
            'nama' => 'Rian Wijaya',
            'status_hadir' => 'TIDAK',
            'ucapan' => 'Maaf tidak bisa hadir, selamat ya!',
            'plusone' => 2,
        ]);
    }
}
