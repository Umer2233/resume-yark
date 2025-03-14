<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';
    protected $fillable = [
        'user_id',
        'position_id',
        'title_id',
        'name',
        'middle_initial',
        'address_display',
        'email',
        'address',
        'phone',
        'profile',
        'website',
        'headline_type',
        'hide_headline',
        'headline_endorsement_id',
        'employment_date',
        'employment_locat',
        'employment_desc',
        'employment_emp',
        'education_date',
        'education_location',
        'education_emphas',
        'expand_experienc',
        'type_assessment',
        'chronological_scor',
        'type',
        'last_step',
        'template_id',
        'color_id',
        'font_id',
        'heading_font_size',
        'subheading_font_s',
        'body_font_size',
        'top_bottom_margi',
        'left_right_margin',
        'heading_spacing',
        'subheading_spacin',
        'body_text_spacing',
        'indent_spacing',
        'employment_emphasis',
        'education_emphasis',
        'resumereview',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function resumeSetting()
    {
        return $this->hasOne(ResumeSetting::class, 'resume_id', 'id');
    }
    public function job_descriptions()
    {
        return $this->hasMany(JobDescription::class, 'resume_id', 'id');
    }
    // public function resumeSkill()
    // {
    //     return $this->hasMany(ResumeSetting::class, 'resume_id', 'id');
    // }

    public function resumeSkill()
    {
        return $this->belongsToMany(Skills::class, 'user_skills', 'resume_id', 'skill_id')->withPivot('is_active')->orderBy('user_skills.order','asc');
    }

     public function font()
    {
        return $this->belongsTo(Font::class, 'font_id', 'id');
    }
    public function resumeSections()
    {

        return $this->hasMany(ResumeSection::class, 'resume_id')->orderBy('order');
    }
      public function resumeExperience()
    {

        return $this->hasMany(ResumeExperience::class, 'resume_id')->orderBy('order');
    }

    public function color()
    {

        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function template()
    {

        return $this->belongsTo(Template::class, 'template_id', 'id');
    }

    public function resumeSorting()
    {

        return $this->hasMany(ResumeSorting::class, 'resume_id');
    }

    public function resumeQualificationStatement()
    {
        return $this->hasOne(QualificationStatement::class, 'resume_id');
    }
}