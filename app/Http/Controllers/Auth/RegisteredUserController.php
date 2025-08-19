<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Arr;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'program' => ['required', 'string'],
            'year_level' => ['required', 'string'],
            'semester' => ['required', 'string'],
        ]);
        

        // Define possible sections
        $sections = ['3101', '3102', '4101', '4102'];
        $randomSection = Arr::random($sections); // Assign a random section

        // Define all weekdays
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        // Define possible time slots
        $times = ['8:00 AM - 10:00 AM', '10:30 AM - 12:30 PM', '1:00 PM - 3:00 PM', '3:30 PM - 5:30 PM'];

        // Generate 3 unique schedules
        $finalSchedules = [];
        while (count($finalSchedules) < 3) {
            $selectedDays = Arr::random($weekdays, 3); // Pick 3 unique days
            $schedule = [];

            foreach ($selectedDays as $day) {
                $schedule[] = "$day | " . Arr::random($times);
            }

            // Sort for consistency to help avoid duplicates
            sort($schedule);

            // Prevent duplicate schedules
            if (!in_array($schedule, $finalSchedules)) {
                $finalSchedules[] = $schedule;
            }
        }

        // Store the schedules as a **compact JSON string**
        $formattedSchedules = array_map(fn($s) => implode(", ", $s), $finalSchedules);

        // Create the user with assigned section and schedules
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'section' => $randomSection,
            'schedule' => json_encode($formattedSchedules, JSON_UNESCAPED_UNICODE),
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'program' => $request->program,
            'year_level' => $request->year_level,
            'semester' => $request->semester,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    

}
