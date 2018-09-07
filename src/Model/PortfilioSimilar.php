<?php

namespace ArtinCMS\LPM\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PortfilioSimilar extends Model
{
    protected $table = 'lpm_portfolio_related';
    protected $hidden = ['id','item_id','related_id'];
    protected $appends = ['encode_id','encode_item_id','encode_related_id','encode_file_id'];
    use softDeletes;
    public function getEncodeIdAttribute()
    {
        return LFM_getEncodeId($this->id);
    }
    public function getEncodeItemIdAttribute()
    {
        return LFM_getEncodeId($this->item_id);
    }
    public function getEncodeRelatedIdAttribute()
    {
        return LFM_getEncodeId($this->related_id);
    }
    public function portfolio()
    {
        return $this->belongsTo('ArtinCMS\LPM\Model\Portfilio','related_id','id');
    }
    public function getEncodeFileIdAttribute()
    {
        return LFM_getEncodeId($this->portfolio->default_img);
    }

}
