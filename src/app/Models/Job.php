<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;


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
}
