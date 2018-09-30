<?php

namespace ArtinCMS\LPM\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $hidden = ['default_img'];
    protected $appends = ['encode_id','encode_file_id','url','type'];
    protected $table = 'lpm_categories';
    use softDeletes;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            if ($query->order == null)
            {
                $query->order = self::where('parent_id', '=', $query->parent_id)->max('order') + 1;
            }
        });
    }

    public function getEncodeIdAttribute()
    {
        return LFM_getEncodeId($this->id);
    }
    public function getTypeAttribute()
    {
        return 'category';
    }

    public function getEncodeFileIdAttribute()
    {
        return LFM_getEncodeId($this->default_img);
    }
    public function getUrlAttribute()
    {
        return LFM_GenerateDownloadLink('ID',$this->default_img);
    }

    public function user()
    {
        return $this->belongsTo(config('laravel_portfolio.user_model'), 'created_by');
    }

    public function tags()
    {
        return $this->morphToMany('ArtinCMS\LTS\Models\Tag' , 'taggable','lts_taggables','taggable_id','tag_id')->withPivot('type')->withTimestamps() ;
    }

    public function parent()
    {
        return $this->hasOne('ArtinCMS\LPM\Model\Category', 'id', 'parent_id');
    }

}
