<?php

namespace App\Models\ExitSurvey;

use App\Models\College\College;
use App\Models\Course\Course;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ExitSurvey extends Model
{
    protected $fillable=[
        'user_id',
        'college_id',
        'course_id',
        'professional_ethics_rating',
        'professional_ethics_rating_score',
        'communication_skills_rating',
        'communication_skills_rating_score',
        'theory_prac_application_rating',
        'theory_prac_application_rating_score',
        'current_field_trends_rating',
        'current_field_trends_rating_score',
        'written_communication_rating',
        'written_communication_rating_score',
        'critical_thinking_rating',
        'critical_thinking_rating_score',
        'team_member_functionality_rating',
        'team_member_functionality_rating_score',
        'independent_learner_rating',
        'independent_learner_rating_score',
        'further_education_career_rating',
        'further_education_career_rating_score',
        'strong_leadership_skills_rating',
        'strong_leadership_skills_rating_score',
        'acceptance_at_institution_rating',
        'acceptance_at_institution_rating_score',
        'faculty_support_rating',
        'faculty_support_rating_score',
        'return_for_social_activities_rating',
        'return_for_social_activities_rating_score',
        'employment_preparation_rating',
        'employment_preparation_rating_score',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }
}
