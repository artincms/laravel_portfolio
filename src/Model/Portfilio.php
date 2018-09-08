<?php

namespace ArtinCMS\LPM\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfilio extends Model
{
    protected $hidden = ['default_img'];
    protected $appends = ['encode_id','encode_file_id','url','type'];
    protected $table = 'lpm_portfolio';
    use softDeletes;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            if ($query->order == null)
            {
                $query->order = self::where('lang_id', '=', $query->lang_id)->max('order') + 1;
            }
        });
    }

    public function getEncodeIdAttribute()
    {
        return LFM_getEncodeId($this->id);
    }

    public function getTypeAttribute()
    {
        return 'image';
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
        return $this->belongsTo(config('laravel_portfolio.userModel'), 'created_by');
    }

    public function portfolioSimilars()
    {
        return $this->hasMany('ArtinCMS\LPM\Model\PortfilioSimilar','item_id','id');
    }

    public function tags()
    {
        return $this->morphToMany('ArtinCMS\LTS\Models\Tag' , 'taggable','lts_taggables','taggable_id','tag_id')->withPivot('type')->withTimestamps() ;
    }

    public function parent()
    {
        return $this->hasOne('ArtinCMS\LGS\Model\Gallery', 'id', 'category_id');
    }
    public function files()
    {
        return $this->morphToMany('ArtinCMS\LFM\Models\File' , 'fileable','lfm_fileables','fileable_id','file_id')->withPivot('type')->withTimestamps() ;
    }

}
