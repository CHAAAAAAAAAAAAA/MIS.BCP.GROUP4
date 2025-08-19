<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'section',
        'schedule',
        'dob',
        'gender',
        'address',
        'phone',
        'program',
        'year_level',
        'semester',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dashboard()
    {
        $studentCount = User::where('section', 'student')->count();
        $teacherCount = User::where('section', 'teacher')->count();
        $adminCount   = User::where('section', 'admin')->count();
        $allpersonCount = User::count();

        return view('dashboard', compact(
            'studentCount',
            'teacherCount',
            'adminCount',
            'allpersonCount'
        ));
    }

    public function getScheduleAttribute()
    {
        $times = ['8:00 AM - 10:00 AM', '10:30 AM - 12:30 PM', '1:00 PM - 3:00 PM', '3:30 PM - 5:30 PM'];
        $days = ['Monday & Wednesday', 'Tuesday & Thursday', 'Wednesday & Friday', 'Monday to Friday'];

        // Use email to make it consistent per user
        $seed = crc32($this->email);
        srand($seed);

        return $days[array_rand($days)] . ' | ' . $times[array_rand($times)];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->student_number = self::generateStudentNumber($user->created_at);
        });
    }

    public static function generateStudentNumber($created_at)
    {
        $date = now()->format('Ymd'); // Example: 20250416 (for April 16, 2025)
        $randomDigits = rand(1000, 9999); // Random 4-digit number
        return "s{$date}-{$randomDigits}";
    }


    
}
