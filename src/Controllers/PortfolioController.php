<?php

namespace ArtinCMS\LPM\Controllers;


use App\Http\Controllers\Controller;
use ArtinCMS\LPM\Model\Category;
use ArtinCMS\LPM\Model\Portfilio;
use ArtinCMS\LPM\Model\PortfilioSimilar;
use ArtinCMS\LTS\Models\Tag;
use DataTables;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PortfolioController extends Controller
{
    private function reOrderPortfolioForm($lang_id)
    {
        $all = Portfilio::where('lang_id', $lang_id)->orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($all as $item)
        {
            $item->order = $i++;
            $item->save();
        }

        return $i;
    }

    public function index()
    {
        $multiLangFunc = config('laravel_portfolio.multiLang');
        $parrents = Category::with('parent')->get();
        if ($multiLangFunc)
        {
            $multiLang = json_encode($multiLangFunc());
        }
        else
        {
            $multiLang = false;
        }
        $option_default_img = ['size_file' => 2000, 'max_file_number' => 1, 'true_file_extension' => ['png', 'jpg']];
        $default_img = LFM_CreateModalFileManager('defaultImg', $option_default_img, 'insert', 'showDefaultImg', false, false, false, 'انتخاب فایل تصویر', 'btn-block', 'fa fa-folder-open font_button mr-2');
        return view('laravel_portfolio::backend.portfolio.index', compact('sliderTypes', 'multiLang', 'default_img', 'parrents'));
    }

    public function getPortfolio(Request $request)
    {
        $port = Category::with('parent', 'user');
//        if ($request->filter_title)
//        {
//            $port->where('title', 'like', '%' . $request->filter_title . '%');
//        }
//        if ($request->filter_lang_id != 'false')
//        {
//            $port->where('lang_id', (int)$request->filter_lang_id);
//        }
//        if ($request->filter_is_active == "1")
//        {
//            $port->where('is_active', '1');
//        }
//        elseif ($request->filter_is_active == "0")
//        {
//            $port->where('is_active', '0');
//        }
        $multiLangFunc = config('laravel_portfolio.multiLang');
        if ($multiLangFunc)
        {
            $multiLang = $multiLangFunc();
        }
        else
        {
            $multiLang = false;
        }
        return DataTables::eloquent($port)
            ->editColumn('id', function ($data) {
                return LFM_getEncodeId($data->id);
            })
            ->addColumn('lang_name', function ($data) use ($multiLang) {
                if ($multiLang)
                {
                    return $this->searchForId($data->lang_id, $multiLang);
                }
                else
                {
                    return '';
                }
            })
            ->editColumn('parent_id', function ($data) {
                return LFM_getEncodeId($data->parent_id);
            })
            ->editColumn('default_img', function ($data) {
                return LFM_getEncodeId($data->default_img);
            })
            ->editColumn('description', function ($data) {
                return strip_tags($data->description);
            })
            ->make(true);
    }

    public function getPortfolioItem(Request $request)
    {
        $port = Portfilio::with('user')->where('category_id',LFM_GetDecodeId($request->item_id));
        return DataTables::eloquent($port)
            ->editColumn('id', function ($data) {
                return LFM_getEncodeId($data->id);
            })
            ->editColumn('default_img', function ($data) {
                return LFM_getEncodeId($data->default_img);
            })
            ->editColumn('description', function ($data) {
                return strip_tags($data->description);
            })
            ->make(true);
    }

    public function savePortfolio(Request $request)
    {
        $port = new Category;
        $port->title = $request->title;
        $port->parent_id = $request->parent_id;
        $port->lang_id = $request->lang_id;
        if ($port->parent_id)
        {
            $parent = Category::find($port->parent_id);
            $port->lang_id = $parent->lang_id;
        }
        if (auth()->check())
        {
            $auth = auth()->id();
            $port->created_by = auth()->id();
        }
        else
        {
            $auth = 0;

        }
        $port->save();
        $res['tag'] = LTS_saveTag($port, $request->tag);
        $res['file'] = LFM_SaveSingleFile($port, 'default_img', 'defaultImg', 'default_img_options');
        $res =
            [
                'success' => true,
                'title' => "ثبت  گروه",
                'section' => 'defaultImg',
                'message' => 'گروه با موفقیت ثبت شد.'
            ];

        return $res;
    }

    public function savePortfolioItem(Request $request)
    {
        $port = new Portfilio;
        $port->title = $request->title;
        $port->category_id = LFM_GetDecodeId($request->category_id);
        $port->description = $request->description;

        if (auth()->check())
        {
            $auth = auth()->id();
            $port->created_by = auth()->id();
        }
        else
        {
            $auth = 0;

        }
        $port->lang_id = $request->lang_id;

        $port->save();
        $res['tag'] = LTS_saveTag($port, $request->tag);
        $res['file'] = LFM_SaveSingleFile($port, 'default_img', 'DefaultImgItem', 'default_img_options');
        $saveMultiFile = LFM_SaveMultiFile($port, 'PortfolioFile', 'image', 'files');
        $res =
            [
                'success' => true,
                'title' => "ثبت نمونه کار",
                'message' => 'نمونه کار با موفقیت ثبت شد.'
            ];

        return $res;
    }

    public function setPortfolioStatus(Request $request)
    {
        $item = Category::find(LFM_GetDecodeId($request->item_id));
        if ($request->is_active == "true")
        {
            $item->is_active = "1";
            $res['message'] = ' مجموعه فعال گردید';
        }
        else
        {
            $item->is_active = "0";
            $res['message'] = 'مجموعه غیر فعال شد';
        }
        $item->save();
        $res['success'] = true;
        $res['title'] = 'وضعیت مجموعه تغییر پیدا کرد .';

        return $res;
    }

    public function setPortfolioItemStatus(Request $request)
    {
        $item = Portfilio::find(LFM_GetDecodeId($request->item_id));
        if ($request->is_active == "true")
        {
            $item->is_active = "1";
            $res['message'] = ' نمونه کار فعال گردید';
        }
        else
        {
            $item->is_active = "0";
            $res['message'] = 'نمونه کار غیر فعال شد';
        }
        $item->save();
        $res['success'] = true;
        $res['title'] = 'وضعیت نمونه کار تغییر پیدا کرد .';

        return $res;
    }

    public function trashPortfolio(Request $request)
    {
        $item = Category::find(LFM_GetDecodeId($request->item_id));
        $item->delete();

        $res =
            [
                'success' => true,
                'title' => "حذف آیتم",
                'message' => 'آیتم با موفقیت حذف شد.'
            ];

        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function trashPortfolioItem(Request $request)
    {
        $item = Portfilio::find(LFM_GetDecodeId($request->item_id));
        $item->delete();

        $res =
            [
                'success' => true,
                'title' => "حذف آیتم",
                'message' => 'آیتم با موفقیت حذف شد.'
            ];

        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function trashPortfolioRelated(Request $request)
    {
        $item = PortfilioSimilar::find(LFM_GetDecodeId($request->item_id));
        $item->delete();

        $res =
            [
                'success' => true,
                'title' => "حذف آیتم",
                'message' => 'آیتم با موفقیت حذف شد.'
            ];

        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function autoCompletePortfolioLang(Request $request)
    {
        $multiLangFunc = config('laravel_portfolio.multiLang');
        $x = $request->term;
        $data = $multiLangFunc();
        if ($x['term'] != '...')
        {
            $data = $multiLangFunc()
                ->where("text", "LIKE", "%" . $x['term'] . "%");
        }
        $data = ['results' => $data];

        return response()->json($data);
    }

    public function autoCompletePortfolio(Request $request)
    {
        $lang_id = $request->selectable_id;
        $x = $request->term;
        $data = Portfilio::select("id", 'title AS text')->where('is_active', '1')->where('lang_id', $lang_id);
        if ($x['term'] != '...')
        {
            $data = Portfilio::select("id", 'title AS text')
                ->where('is_active', '1')
                ->where("title", "LIKE", "%" . $x['term'] . "%")
                ->where('lang_id', $lang_id);
        }
        $data = $data->get();
        $data = ['results' => $data];

        return response()->json($data);
    }

    public function saveOrderPortfolioForm(Request $request)
    {
        $item_id = LFM_GetDecodeId($request->item_id);
        $lang_id = $request->lang_id;
        $count = $this->reOrderPortfolioForm($lang_id);
        $port = Portfilio::find($item_id);
        $order = $port->order;
        if ($request->order_type == 'increase')
        {
            $nextItem = Portfilio::where([
                ['lang_id', $lang_id],
                ['order', $order + 1]
            ])->first();
            if ($nextItem)
            {
                $port->order = $order + 1;
                $port->save();
                //set new order
                $nextItem->order = $order;
                $nextItem->save();
            }
        }
        elseif ($request->order_type == 'decrease')
        {

            $previousItem = Portfilio::where([
                ['lang_id', $lang_id],
                ['order', $order - 1]
            ])->first();
            if ($previousItem)
            {
                $port->order = $order - 1;
                $port->save();
                //set new order
                $previousItem->order = $order;
                $previousItem->save();
            }
        }
        else
        {
            $result['error'][] = "متاسفانه با مشکل مواجه شد!";
            $result['success'] = false;

            return response()->json($result, 200)->withHeaders(['Content-Type' => 'json', 'charset' => 'utf-8']);
        }
        $result['message'][] = "با موفقیت انجام شد.";
        $result['success'] = true;

        return response()->json($result, 200)->withHeaders(['Content-Type' => 'json', 'charset' => 'utf-8']);
    }

    public function getEditPortfolioForm(Request $request)
    {
        $option_default_img = ['size_file' => 2000, 'max_file_number' => 1, 'true_file_extension' => ['png', 'jpg']];
        $portfolio = Category::find(LFM_GetDecodeId($request->item_id));
        $portfolio->encode_id = LFM_getEncodeId($portfolio->id);
        $tags = LTS_showTag($portfolio);
        $default_img = LFM_CreateModalFileManager('LoadDefaultImg', $option_default_img, 'insert', 'showDefaultEditImg', 'portfolio_edit_tab', false, false, 'انتخاب فایل تصویر', 'btn-block', 'fa fa-folder-open font_button mr-2');
        $load_default_img = LFM_loadSingleFile($portfolio, 'default_img', 'LoadDefaultImg');
        $multiLangFunc = config('laravel_portfolio.multiLang');
        if ($multiLangFunc)
        {
            $multiLang = json_encode($multiLangFunc());
            $active_lang_title = $this->searchForId($portfolio->lang_id, $multiLangFunc());
        }
        else
        {
            $multiLang = false;
            $active_lang_title = '';
        }
        $parrents = Category::with('parent')->get();
        $portfolio_form = view('laravel_portfolio::backend.portfolio.view.edit', compact('portfolio', 'tags', 'default_img', 'load_default_img', 'multiLang', 'active_lang_title', 'parrents'))->render();
        $res =
            [
                'success' => true,
                'portfolio_edit_view' => $portfolio_form
            ];
        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function getEditPortfolioItemForm(Request $request)
    {
        $option_default_img = ['size_file' => 2000, 'max_file_number' => 1, 'true_file_extension' => ['png', 'jpg']];
        $option_port_file = ['size_file' => 2000, 'max_file_number' => 2, 'true_file_extension' => ['png', 'jpg']];
        $portfolio = Portfilio::find(LFM_GetDecodeId($request->item_id));
        $portfolio->encode_id = LFM_getEncodeId($portfolio->id);
        $tags = LTS_showTag($portfolio);
        $default_img = LFM_CreateModalFileManager('LoadDefaultImgItem', $option_default_img, 'insert', 'showDefaultEditImg', 'portfolio_edit_item_tab', false, false, 'انتخاب فایل تصویر', 'btn-block', 'fa fa-folder-open font_button mr-2');
        $load_default_img_item = LFM_loadSingleFile($portfolio, 'default_img', 'LoadDefaultImgItem');
        $portfolioFile = LFM_CreateModalFileManager('editPortfolioFile', $option_port_file, 'insert', 'showEditportfolioFile', false,
            false, false, 'انتخاب فایل تصویر', 'btn-block', 'fa fa-folder-open font_button mr-2');
        $portfolioFileLoad = LFM_LoadMultiFile($portfolio, 'editPortfolioFile', 'image');
        $portfolio_form = view('laravel_portfolio::backend.portfolio.view.edit_item', compact('portfolio', 'tags', 'default_img', 'load_default_img_item', 'multiLang', 'active_lang_title', 'portfolioFileLoad', 'portfolioFile'))->render();
        $res =
            [
                'success' => true,
                'portfolio_item_edit_view' => $portfolio_form
            ];
        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function editPortfolio(Request $request)
    {
        $item = Category::find(LFM_GetDecodeId($request->item_id));
        $item->title = $request->title;
        $item->parent_id = $request->parent_id;
        $item->lang_id = $request->lang_id;
        if ($item->parent_id)
        {
            $parent = Category::find($item->parent_id);
            $item->lang_id = $parent->lang_id;
        }
        if (auth()->check())
        {
            $auth = auth()->id();
            $item->created_by = auth()->id();
        }
        else
        {
            $auth = 0;

        }
        $item->save();

        $saveDefaultFile = LFM_SaveSingleFile($item, 'default_img', 'LoadDefaultImg', 'default_img_options');
        $res['tag'] = LTS_saveTag($item, $request->tag, 'tag', 'tags', 'sync');
        $res =
            [
                'success' => true,
                'default_img' => $saveDefaultFile,
                'title' => "ثبت آیتم",
            ];

        return $res;
    }

    public function editPortfolioItem(Request $request)
    {
        $item = Portfilio::find(LFM_GetDecodeId($request->item_id));
        $item->title = $request->title;
        $item->description = $request->description;
        if (auth()->check())
        {
            $auth = auth()->id();
            $item->created_by = auth()->id();
        }
        else
        {
            $auth = 0;

        }
        $item->save();
        $saveDefaultFile = LFM_SaveSingleFile($item, 'default_img', 'LoadDefaultImgItem', 'default_img_options');
        $savePortfolioFiles = LFM_SaveMultiFile($item, 'editPortfolioFile', 'image', 'files', 'sync');
        $res['tag'] = LTS_saveTag($item, $request->tag, 'tag', 'tags', 'sync');
        $res =
            [
                'success' => true,
                'default_img' => $saveDefaultFile,
                'files' => $savePortfolioFiles,
                'title' => "ثبت آیتم",
            ];

        return $res;
    }

    public function addRelatedPortfolio(Request $request)
    {
        foreach ($request->related_id as $id)
        {
            $item = new PortfilioSimilar;
            $item->item_id = LFM_GetDecodeId($request->item_id);
            $item->related_id = $id;
            if (Auth::user())
            {
                if (isset(Auth::user()->id))
                {
                    $item->created_by = Auth::user()->id;
                }
            }
            $item->save();

        }
        $res =
            [
                'success' => true,
                'title' => "ثبت نمونه کار",
                'message' => 'نمونه کار با موفقیت ثبت شد.'
            ];

        return $res;
    }

    public function getPortfolioRelatedItem(Request $request)
    {
        $item_id = LFM_GetDecodeId($request->item_id);
        $item = PortfilioSimilar::with('portfolio')->where('item_id', $item_id);
        $multiLangFunc = config('laravel_portfolio.multiLang');
        if ($multiLangFunc)
        {
            $multiLang = $multiLangFunc();
        }
        else
        {
            $multiLang = false;
        }

        return DataTables::eloquent($item)
            ->editColumn('id', function ($data) {
                return LFM_getEncodeId($data->id);
            })
            ->addColumn('title', function ($data) {
                return $data->portfolio->title;
            })
            ->addColumn('lang_name', function ($data) use ($multiLang) {
                if ($multiLang)
                {
                    return $this->searchForId($data->portfolio->lang_id, $multiLang);
                }
                else
                {
                    return '';
                }
            })
            ->addColumn('description', function ($data) {
                return strip_tags($data->portfolio->description);
            })
            ->make(true);
    }

    public function searchForId($id, $array)
    {
        foreach ($array as $value)
        {
            if ($value['id'] == $id)
            {
                return $value['text'];
            }
        }

        return null;
    }

    public function getPortfolioAjax(Request $request)
    {
        $lang_id = $request->lang_id;

        return createPortfolio($lang_id);
    }

    public function getPortfolioItemAjax(Request $request)
    {
        $item_id = $request->item_id;
        $lang_id = $request->lang_id;

        return createPortfolioItem($item_id, $lang_id);
    }

    public function setNewTag($tag, $lang_id, $auth)
    {
        $t = new Tag;
        $t->title = $tag;
        $t->lang_id = $lang_id;
        $t->created_by = $auth;
        $t->save();
        return $t->id;
    }

    public function getAddPortfolioItemForm(Request $request)
    {
        $option_default_img = ['size_file' => 2000, 'max_file_number' => 1, 'true_file_extension' => ['png', 'jpg']];
        $option_port_file = ['size_file' => 2000, 'max_file_number' => 2, 'true_file_extension' => ['png', 'jpg']];
        $default_img_item = LFM_CreateModalFileManager('DefaultImgItem', $option_default_img, 'insert', 'showDefaultImageItem', 'portfolio_add_item_tab', false, false, 'انتخاب فایل تصویر', 'btn-block', 'fa fa-folder-open font_button mr-2');
        $portfolioFile = LFM_CreateModalFileManager('PortfolioFile', $option_port_file, 'insert', 'showportfolioFile', false,
            false, false, 'انتخاب فایل تصویر', 'btn-block', 'fa fa-folder-open font_button mr-2');
        $lang_id = $request->lang_id;
        $category_id = $request->item_id;
        $port_form = view('laravel_portfolio::backend.portfolio.view.add_item', compact('category_id','lang_id','default_img_item','portfolioFile'))->render();
        $res =
            [
                'status'           => "1",
                'status_type'      => "success",
                'portfolio_add_item' => $port_form
            ];
        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function getPortfolioFromVue(Request $request)
    {
        $lang_id = $request->lang_id;
        $category_id = $request->category_id;
        $res['categories'] = Category::where([
            ['lang_id', $lang_id],
            ['parent_id', $category_id],
        ])->get();
        $res['portfolios'] = Portfilio::with('portfolioSimilars', 'tags', 'files')->where([
            ['lang_id', $lang_id],
            ['category_id', $category_id],
        ])->get();
        if($category_id !=0)
        {
            $myCategory = Category::find($category_id);
        }
        else
        {
            $myCategory = [] ;
        }
        $res['lang'] = (string)app()->getLocale();
        $res['myCategory'] = $myCategory ;
        $res['filters'] = Tag::with(['portfolios'=>function($e) use($category_id){
            $e->where('category_id',$category_id);
        }])->where('lang_id', $lang_id)->get();
        $res['h_b_color'] = config('laravel_portfolio.header_back_color');
        $res['h_f_color'] = config('laravel_portfolio.header_font_color');
        return $res;
    }

    public function getPort (Request $request)
    {
        $item_id = LFM_GetDecodeId($request->item_id);
        $item = Portfilio::with('portfolioSimilars', 'tags', 'files')->where('id',$item_id)->first();
        if(isset($item))
        {
            $res['item'] = $item ;
        }
        else
        {
            $res['item'] = [] ;
        }
        return $res ;

    }


}
