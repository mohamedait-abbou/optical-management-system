<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'store_name' => Setting::get('store_name', 'Optical Store'),
            'store_address' => Setting::get('store_address', ''),
            'store_phone' => Setting::get('store_phone', ''),
            'store_email' => Setting::get('store_email', ''),
            'store_logo' => Setting::get('store_logo', ''),
            'tax_rate' => Setting::get('tax_rate', '20'),
            'currency' => Setting::get('currency', 'MAD'),
            'opening_hours' => Setting::get('opening_hours', json_encode([
                'monday' => ['start' => '09:00', 'end' => '18:00', 'open' => true],
                'tuesday' => ['start' => '09:00', 'end' => '18:00', 'open' => true],
                'wednesday' => ['start' => '09:00', 'end' => '18:00', 'open' => true],
                'thursday' => ['start' => '09:00', 'end' => '18:00', 'open' => true],
                'friday' => ['start' => '09:00', 'end' => '18:00', 'open' => true],
                'saturday' => ['start' => '10:00', 'end' => '17:00', 'open' => true],
                'sunday' => ['start' => '', 'end' => '', 'open' => false],
            ])),
            'low_stock_threshold' => Setting::get('low_stock_threshold', '10'),
            'appointment_reminder_hours' => Setting::get('appointment_reminder_hours', '24'),
            'enable_sms_notifications' => Setting::get('enable_sms_notifications', '0'),
            'enable_email_notifications' => Setting::get('enable_email_notifications', '1'),
            'sms_api_key' => Setting::get('sms_api_key', ''),
            'email_host' => Setting::get('email_host', ''),
            'email_port' => Setting::get('email_port', '587'),
            'email_username' => Setting::get('email_username', ''),
            'email_encryption' => Setting::get('email_encryption', 'tls'),
        ];

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_address' => 'nullable|string',
            'store_phone' => 'nullable|string',
            'store_email' => 'nullable|email',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'currency' => 'required|string|max:3',
            'low_stock_threshold' => 'required|integer|min:1',
            'appointment_reminder_hours' => 'required|integer|min:1',
            'enable_sms_notifications' => 'boolean',
            'enable_email_notifications' => 'boolean',
            'logo' => 'nullable|image|max:2048',
            'opening_hours' => 'nullable|array',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            Setting::set('store_logo', $path);
        }

        // Save opening hours as JSON
        if (isset($validated['opening_hours'])) {
            $validated['opening_hours'] = json_encode($validated['opening_hours']);
        }

        // Save all settings
        foreach ($validated as $key => $value) {
            if ($key !== 'opening_hours') {
                Setting::set($key, $value);
            }
        }
        
        if (isset($validated['opening_hours'])) {
            Setting::set('opening_hours', $validated['opening_hours']);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Paramètres enregistrés avec succès!');
    }
}