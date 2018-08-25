<?php
if (!function_exists('LPM_ConvertNumbersEntoFa'))
{
    function LPM_ConvertNumbersEntoFa($matches)
    {
        $farsi_array = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $english_array = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($english_array, $farsi_array, $matches);
    }
}
if (!function_exists('LPM_ConvertNumbersFatoEn'))
{
    function LPM_ConvertNumbersFatoEn($matches)
    {
        $farsi_array = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $english_array = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($farsi_array, $english_array, $matches);
    }
}
if (!function_exists('faq_sampleLang'))
{
    function faq_sampleLang()
    {
        $lang = [
            [
                'id'=>1,
                'text'=>'Persian'
            ] ,
            [
                'id'=>2,
                'text'=>'English'
            ] ,
            [
                'id'=>3,
                'text'=>'Spanish'
            ] ,
            [
                'id'=>4,
                'text'=>'Italian'
            ] ,  [
                'id'=>5,
                'text'=>'French'
            ] ,
            [
                'id'=>6,
                'text'=>'Russian'
            ] ,
            [
                'id'=>7,
                'text'=>'Arabic'
            ]
        ];

        return $lang ;
    }
}
if (!function_exists('createPortfolio'))
{
    function createPortfolio($lang_id,$route_name)
    {
        $items = \ArtinCMS\LPM\Model\Portfilio::with('tags')->where('lang_id',$lang_id)->
        where('is_active','1')->
        orderBy('order','asc')->get();
        $filters = \ArtinCMS\LTS\Models\Tag::with('portfolios')->where('lang_id',$lang_id)->get();
        $result= view("laravel_portfolio::frontend.portfolio", compact('items','filters','route_name'))->render();
        return $result ;
    }
}

if (!function_exists('createPortfolioItem'))
{
    function createPortfolioItem($item_id,$route_name)
    {
        $item = \ArtinCMS\LPM\Model\Portfilio::with('tags','files')->find(LFM_GetDecodeId($item_id));
        $images=[];
        if ($item->encode_file_id)
        {
            $images[] = LFM_GenerateDownloadLink('ID',LFM_GetDecodeId($item->encode_file_id));
        }
        foreach ($item->files as $file)
        {
            $images[] = LFM_GenerateDownloadLink('ID',$file->id);
        }
        $relatedItems = \ArtinCMS\LPM\Model\PortfilioSimilar::with('portfolio')->where('item_id',LFM_GetDecodeId($item_id))->get();
        $result= view("laravel_portfolio::frontend.portfolioItem", compact('item','images','relatedItems','route_name'))->render();
        return $result ;
    }
}



