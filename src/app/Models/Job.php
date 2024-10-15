<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'featured',
        'schedule',
        // other fillable attributes
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'job_tag_pivot');
    }

    public function tag(string $name)
    {
        $tag = Tag::firstOrCreate(['name' => $name]);
        $this->tags()->attach($tag);
    }

    public function setDescriptionAttribute($value)
    {
        //todo stip html&js attributes
        $this->attributes['description'] = strip_tags($value);
    }

    public function getTagNamesSeparatedByComma(){
        $tags = $this->tags();

        if(!isset($tags)){
            return '';
        }
        $tagNames = $tags->pluck('name')->toArray();

        return implode(', ', $tagNames);
    }
}
