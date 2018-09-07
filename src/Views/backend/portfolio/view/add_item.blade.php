<div class="space-20"></div>
<form id="frm_create_portfolio_item" class="form-horizontal" name="frm_create_portfolio">
   <input type="hidden" name="lang_id" value="{{$lang_id}}">
   <input type="hidden" name="category_id" value="{{$category_id}}">
    <div class="form-group row fg_title">
        <label class="col-sm-2 control-label col-form-label label_post" for="title">
            <span class="more_info"></span>
            <span class="label_title">عنوان</span>
        </label>
        <div class="col-sm-6">
            <input name="title" class="form-control" id="portfolio_title" tab="1">
        </div>
        <div class="col-sm-4 messages"></div>
    </div>
    <div class="form-group row fg_title">
        <label class="col-sm-2 control-label col-form-label label_post" for="title">
            <span class="more_info"></span>
            <span class="label_title">انتخاب تگ</span>
        </label>
        <div class="col-sm-6">
            <select class="form-control" multiple id="showSelectTagItem" name="tag[]">
            </select>
        </div>
        <div class="col-sm-4 messages"></div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-sm-12 col-md-3 control-label col-form-label label_post" for="description">توضیحات</label>
        <div class="col-6">
            <textarea class="form-control" name="description" id="portfolio_description" rows="5"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-sm-12 col-md-3 control-label col-form-label label_post" for="description">انتخاب تصویر پیش فرض</label>
        <div class="col-lg-6 col-sm-12 col-md-5">
            <div class="card bg-light mb-3" style="">
                <div class="card-header">{!! $default_img_item['button'] !!}</div>
                <div class="card-body">
                    {!! $default_img_item['modal_content'] !!}
                    <div id="show_area_medium_default_img_item"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-sm-12 col-md-3 control-label col-form-label label_post" for="description">سایر تصاویر</label>
        <div class="col-lg-6 col-sm-12 col-md-5">
            <div class="card bg-light mb-3" style="">
                <div class="card-header">{!! $portfolioFile['button'] !!}</div>
                <div class="card-body">
                    {!! $portfolioFile['modal_content'] !!}
                    <div id="show_area_medium_other_img"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfixed"></div>
    <div class="col-12">
        <button type="submit" class="float-right btn btn-success ml-2 add_submit_buttons"><i class="fa fa-save margin_left_8"></i>ذخیره</button>
        <button type="button" class="float-right btn bg-secondary color_white cancel_add_port_item"><i class="fa fa-times margin_left_8"></i>انصراف</button>
    </div>
</form>

<script>
    function showDefaultImageItem(res) {
        $('#show_area_medium_default_img_item').html(res.DefaultImgItem.view.medium);
    }
    function showportfolioFile(res) {
        $('#show_area_medium_other_img').html(res.PortfolioFile.view.medium);
    }
    $('#portfolio_description').summernote({
        height: 150,
    });
    $(document).off("click", ".cancel_add_port_item");
    $(document).on("click", ".cancel_add_port_item", function () {
        clear_form_elements('#frm_create_portfolio');
        $('a[href="#manage_tab_portfolio_item"]').click();
    });
    init_select2_ajax('#showSelectTagItem', '{{route('LTS.autoCompleteTag')}}', true,true);

</script>