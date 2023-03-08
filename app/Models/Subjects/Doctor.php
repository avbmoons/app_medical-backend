<?php
declare(strict_types=1);

namespace App\Models\Subjects;

use App\Models\DoctorReview;
use App\Models\Documents\Receipt;
use App\Models\Documents\SickList;
use App\Models\Meeting;
use App\Models\Speciality;
use App\Models\Subjects\Organizations\EducationOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id;
 * @property array $working_mode
 * @property string $access_token
 * @property string $refresh_token
 * @property boolean $is_online
 * @property array $clinic_ids
 * @property string $name
 * @property string $surname
 * @property EducationOrganization $educationOrganization
 * @property Clinic[] $clinics
 * @property Speciality $speciality
 * @property DoctorReview[] $reviews
 * @property SickList[] $sickLists
 * @property Meeting[] $meetings
 */
class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'working_mode',
        'refresh_token',
        'access_token',
        'is_online',
        'name',
        'surname',
    ];

    function receipts(): HasMany
    {
        return $this->hasMany(Receipt::class);
    }

    function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class);
    }

    function educationOrganization(): BelongsTo
    {
        return $this->belongsTo(EducationOrganization::class);
    }

    function clinics(): BelongsToMany
    {
        return $this->belongsToMany(Clinic::class);
    }
    function reviews(): HasMany
    {
        return $this->hasMany(DoctorReview::class);
    }
    function sickLists(): HasMany
    {
        return $this->hasMany(SickList::class);
    }
    function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }


    protected $casts = [
      'working_mode' => 'array',
    ];
    public $timestamps = true;
}
