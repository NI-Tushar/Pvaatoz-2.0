<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'image',
        'proffered_education',
        'proffered_country',
        'user_type',
        'password',

        'gender',
        'present_address',
        'present_city',
        'present_country',
        'date_of_birth',
        'nationality',
        'passport_or_nid',
        'passport_issue_date',
        'passport_expiry_date',
        'experience',

        'assessment_price',
        'assessment_duration',
        'balance',

        'is_verified',
        'completion_percentage',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Append computed attributes
    protected $appends = ['profile_completion', 'missing_fields'];

    // Profile completion percentage
    public function getProfileCompletionAttribute()
    {
        $requiredFields = $this->getRequiredFields();
        $filledCount = $this->countFilledFields($requiredFields);
        $totalFields = count($requiredFields);

        $percentage = $totalFields > 0 ? (int)round(($filledCount / $totalFields) * 100) : 0;

        // Update the database column
        if ($this->completion_percentage != $percentage) {
            $this->updateQuietly(['completion_percentage' => $percentage]);
        }

        return $percentage;
    }

    // Missing fields list
    public function getMissingFieldsAttribute()
    {
        $requiredFields = $this->getRequiredFields();
        $missing = [];

        foreach ($requiredFields as $field) {
            if ($field === 'qualifications' && !$this->qualifications()->exists()) {
                $missing[] = 'qualifications';
            } elseif ($field === 'studentInfo' && !$this->studentInfo()->exists()) {
                $missing[] = 'studentInfo';
            } elseif ($field === 'image' && (!$this->image || $this->image === 'img-preview.png')) {
                $missing[] = 'profile_picture';
            } elseif (empty($this->$field)) {
                $missing[] = str_replace('_', ' ', $field); // Format field names nicely
            }
        }

        return $missing;
    }

    // Helper: Get required fields based on user type
    protected function getRequiredFields()
    {
        if ($this->user_type === 'Consultant') {
            return [
                'name',
                'phone',
                'gender',
                'present_address',
                'present_city',
                'present_country',
                'date_of_birth',
                'nationality',
                'passport_or_nid',
                'passport_issue_date',
                'passport_expiry_date',
                'image', // Profile picture (non-default)
                'qualifications' // At least 1 entry in consultants_qualifications
            ];
        }

        if ($this->user_type === 'Student') {
            return [
                'name',
                'phone',
                'gender',
                'present_address',
                'present_city',
                'present_country',
                'date_of_birth',
                'nationality',
                'passport_or_nid',
                'passport_issue_date',
                'passport_expiry_date',
                'studentInfo',
                'image',
            ];
        }

        return []; // Fallback (e.g., for admin users)
    }

    // Helper: Count filled fields
    protected function countFilledFields($fields)
    {
        $count = 0;

        foreach ($fields as $field) {
            if ($field === 'qualifications') {
                if ($this->qualifications()->exists()) $count++;
            } elseif ($field === 'studentInfo') {
                if ($this->studentInfo()->exists()) $count++;
            } elseif ($field === 'image') {
                if ($this->image && $this->image !== 'img-preview.png') $count++;
            } elseif (!empty($this->$field)) {
                $count++;
            }
        }

        return $count;
    }
}

