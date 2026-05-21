<?php

namespace Tests\Feature;

use App\Models\Guest;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_export_route_redirects_unauthenticated_user_to_login()
    {
        $response = $this->get(route('guests.export'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_user_can_export_guests_to_csv()
    {
        // 1. Create an admin user/account
        $admin = Account::create([
            'email' => 'admin@gmail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'nama' => 'Administrator'
        ]);

        // 2. Create some guests
        $guest1 = Guest::create([
            'nama' => 'Budi Santoso',
            'status_hadir' => 'HADIR',
            'ucapan' => 'Selamat ya!',
            'plusone' => 1,
            'link_undangan' => 'http://localhost?to=budi-santoso'
        ]);

        $guest2 = Guest::create([
            'nama' => 'Siti Aminah',
            'status_hadir' => 'PENDING',
            'plusone' => 0,
            'link_undangan' => 'http://localhost?to=siti-aminah'
        ]);

        // 3. Act as admin (set session 'admin_logged_in' => true and 'admin_name' => admin's name)
        $response = $this->withSession([
            'admin_logged_in' => true,
            'admin_name' => $admin->nama
        ])->get(route('guests.export'));

        // 4. Assert download response
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        
        $content = $response->streamedContent();

        // 5. Assert CSV content contains headers and guest info
        $this->assertStringContainsString('ID,Nama,"Status Hadir",Ucapan,"Plus One","Link Undangan"', $content);
        $this->assertStringContainsString('"Budi Santoso",HADIR', $content);
        $this->assertStringContainsString('"Siti Aminah",PENDING', $content);
    }
}
