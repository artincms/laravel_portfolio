<script>
    //get portfolio
    window['portfolio_grid_columns'] = [
        {
            width: '5%',
            data: 'id',
            title: 'ردیف',
            searchable: false,
            sortable: false,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'id',
            name: 'id',
            title: 'آی دی',
            visible: false
        },
        {
            width: '20%',
            data: 'title',
            name: 'title',
            title: 'عنوان',
            mRender: function (data, type, full) {
                var img = full.default_img;
                if (typeof img === 'undefined' || img === null || img === '') {
                    var img_item = '<img class="span_image_container" id="" src="{{ route('LFM.DownloadFile',['ID',''])}}/' + 0 + '/small/404.png/100/30/30?0"  data-image="{{ route('LFM.DownloadFile',['ID',''])}}/' + 0 + '/original/404.png?0"  class="img-rounded img-preview">';
                }
                else {
                    var img_item = '<img class="span_image_container" id="" src="{{ route('LFM.DownloadFile',['ID',''])}}/' + img + '/small/404.png/100/30/30?0" data-image="{{ route('LFM.DownloadFile',['ID',''])}}/' + img + '/original/404.png?0"  class="img-rounded img-preview">';
                }
                return '<div><div class="">' + img_item + '</div><a class="show_portfolio_item pointer" data-title="' + full.title + '"  data-item_id="' + full.id + '" data-lang_id="' + full.lang_id + '">' + full.title + '</a></div>';
            }
        },
        {
            width: '15%',
            data: 'order',
            name: 'order',
            title: 'ترتیب',
            searchable: false,
            mRender: function (data, type, full) {
                var order = PortfolioManagerGridData.order();
                if (order[0][0] == 3) {
                    if (order[0][1] == 'desc') {
                        var result = '';
                        result += '' +
                            '<div class="input-group mb-3">' +
                            '   <div class="input-group-prepend ">' +
                            '       <button type="button" style="float: right;border-radius: 0px;" class="btn btn-outline-secondary reorder_portfolio_form_grid_data bg-info-400" ' +
                            '           data-order_type="increase" ' +
                            '           data-item_id="' + full.id + '"' +
                            '           data-parent_id="' + full.parent_id + '" >' +
                            '           <i class="fas fa-level-up-alt"></i>'  +
                            '       </button>' +
                            '   </div>' +
                            '   <input type="text" class="form-control text-center" style="width:30% " disabled value="'+full.order+'">' +
                            '    <div class="input-group-append">' +
                            '       <button type="button" style="border-radius: 0px;" class="btn btn-outline-secondary reorder_portfolio_form_grid_data bg-info-800" ' +
                            '           data-order_type="decrease"' +
                            '           data-item_id="' + full.id + '"' +
                            '           data-parent_id="' + full.parent_id + '" >' +
                            '       <i class="fas fa-level-down-alt fa-flip-horizontal"></i>' +
                            '   </button>';
                        '   </div>' +
                        '</div>';
                        return result;
                    }
                    else {
                        var result = ''+
                            '<div class="input-group mb-3">' +
                            '   <div class="input-group-prepend ">' +
                            '       <button type="button" style="float: right;border-radius: 0px;" class="btn btn-outline-secondary reorder_portfolio_form_grid_data bg-info-400" ' +
                            '           data-order_type="decrease" ' +
                            '           data-item_id="' + full.id + '"' +
                            '           data-parent_id="' + full.parent_id + '">' +
                            '           <i class="fas fa-level-up-alt"></i>'  +
                            '       </button>' +
                            '   </div>' +
                            '   <input type="text" class="form-control text-center" style="width:30% " disabled value="'+full.order+'">' +
                            '    <div class="input-group-append">' +
                            '       <button type="button" style="border-radius: 0px;" class="btn btn-outline-secondary reorder_portfolio_form_grid_data bg-info-800" ' +
                            '           data-order_type="increase"' +
                            '           data-item_id="' + full.id + '"' +
                            '           data-parent_id="' + full.parent_id + '">' +
                            '       <i class="fas fa-level-down-alt fa-flip-horizontal"></i>' +
                            '   </button>';
                        '   </div>' +
                        '</div>';
                        return result;
                    }
                }
                else {
                    return '<span class="order_number">' + full.order + '</span>';
                }
            }
        },
        {
            width: '15%',
            data: 'lang_name',
            name: 'lang_name',
            title: 'زبان'
        },
        {
            width: '25%',
            data: 'parent_id',
            name: 'parent_id',
            title: 'مجموعه والد',
            mRender: function (data, type, full) {
                $('#portfolio_parrent_id').val(full.parent_id);
                if (full.parent != null)
                    return '<a class="show_parrent_items"  data-portfolio_id="' + full.parent_id + '">' + full.parent.title + '</a>';
                else
                    return '';
            }
        },
        {
            width: '25%',
            data: 'created_by',
            name: 'created_by',
            title: 'ایجاد شده توسط',
            mRender: function (data, type, full) {
                if (full.user && full.user.name) {
                    return '<span>' + full.user.name + '<span>';
                }
                else
                    return '<span><span>';
            }
        },
        {
            width: '5%',
            data: 'is_active',
            name: 'is_active',
            title: 'وضعیت',
            mRender: function (data, type, full) {
                var ch = '';
                if (parseInt(full.is_active))
                    ch = 'checked';
                else
                    ch = '';
                return '<input class="styled " id="' + full.id + '" type="checkbox" name="special" data-item_id="' + full.id + '"  onchange="change_is_active_portfolio(this)"' + ch + '>'
            }
        },
        {
            width: '10%',
            searchable: false,
            sortable: false,
            data: 'action', name: 'action', 'title': 'عملیات',
            mRender: function (data, type, full) {
                return '' +
                    '<div class="gallerty_menu float-right pointer" onclick="set_fixed_dropdown_menu(this)" data-toggle="dropdowns">' +
                    '<span>' +
                    '   <em class="fas fa-caret-down"></em>' +
                    '   <i class="fas fa-bars"></i> ' +
                    '</span>' +
                    '  <div class="dropdown_gallery hidden">' +
                    '   <a class="show_portfolio_item pointer gallery_menu-item" data-item_id="' + full.id + '" data-lang_id="' + full.lang_id + '" data-title="' + full.title + '">' +
                    '       <i class="fa fa-eye"></i><span class="ml-2">افزودن نمونه کارها</span>' +
                    '   </a>' +
                    '   <a class="btn_edit_portfolio pointer gallery_menu-item" data-item_id="' + full.id + '" data-title="' + full.title + '">' +
                    '       <i class="fa fa-edit"></i><span class="ml-2">ویرایش</span>' +
                    '   </a>' +
                    '    <a class="btn_trash_portfolio pointer gallery_menu-item" data-item_id="' + full.id + '" data-title="' + full.title + ' ">' +
                    '       <i class="fa fa-trash"></i><span class="ml-2">حذف</span>' +
                    '   </a>'
                '  </div>' +
                '</div>';

            }
        }
    ];
    $(document).ready(function () {
        //dataTablesGrid('#PortfolioManagerGridData', 'PortfolioManagerGridData', getPortfolioRoute, portfolio_grid_columns, null, null, true, null, null, 1, 'desc', false, fixedColumn);
        datatable_load_fun();
        // $(document).off('change', '.filter_is_active');
        // $(document).on('change', '.filter_is_active', datatable_reload_fun);
        // $('.filter_parrent ').on("select2:select", datatable_reload_fun);
        // init_doAfterStopTyping('.filter_title', datatable_reload_fun);
        // function datatable_reload_fun() {
        //     var filter_is_active = $('.filter_is_active').val();
        //     var filter_parrent_id = $('.filter_parrent').val();
        //     var filter_title = $('.filter_title').val();
        //     PortfolioManagerGridData.destroy();
        //     $('#PortfolioManagerGridData').empty();
        //     datatable_load_fun(filter_parrent_id, filter_title,filter_is_active);
        // }
        $('#portfolio_parrent').on("select2:select", change_lang_field);
        function change_lang_field() {
            var parent_id = $('#portfolio_parrent').val();
            if(parent_id !=0)
            {
                $('#showLangCategory').hide();
            }
            else
            {
                $('#showLangCategory').show();
            }
            console.log(parent);
        }
    });




    /*________________________________________________________________________________________________________________________*/

    function showDefaultImg(res) {
        $('#show_area_medium_default_img').html(res.defaultImg.view.medium);
    }

    /*___________________________________________________Add Portfolio_____________________________________________________________________*/
    $(document).off("click", ".cancel_add_close_btn");
    $(document).on("click", ".cancel_add_close_btn", function () {
        clear_form_elements('#frm_create_portfolio');
        $('a[href="#manage_tab"]').click();
    });
    var create_portfolio_constraints = {
        title: {
            presence: {message: '^<strong>عنوان فرم ضروی است.</strong>'}
        },
        order: {
            numericality: {
                onlyInteger: true,
                message: '^<strong>ترتیب نامعتبر است .</strong>'
            }
        }
    };
    var create_portfolio_form_id = document.querySelector("#frm_create_portfolio");
    init_validatejs(create_portfolio_form_id, create_portfolio_constraints, ajax_func_create_portfolio);

    function ajax_func_create_portfolio(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LPM.savePortfolio')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#frm_create_portfolio .total_loader').remove();
                if (data.success) {
                    clear_form_elements('#frm_create_portfolio');
                    menotify('success', data.title, data.message);
                    PortfolioManagerGridData.ajax.reload(null, false);
                    $('a[href="#manage_tab"]').click();
                    $('#show_area_medium_default_img').html('');
                    defaultImg_available = 1;
                    var form_element = $("#frm_create_portfolio");
                    form_element.find('select').val('').trigger('change');
                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
            }
        });
    }

    /*___________________________________________________Add portfolio_____________________________________________________________________*/
    $(document).off("click", ".btn_edit_portfolio");
    $(document).on("click", ".btn_edit_portfolio", function () {
        var item_id = $(this).data('item_id');
        var title = $(this).data('title');
        $('.span_edit_portfolio_tab').html('ویرایش : ' + title);
        get_edit_portfolio_form(item_id);
    });

    function get_edit_portfolio_form(item_id) {
        $('#edit_portfolio').children().remove();
        $('#edit_portfolio').append(generate_loader_html('لطفا منتظر بمانید...'));
        $.ajax({
            type: "POST",
            url: '{{ route('LPM.getEditPortfolioForm')}}',
            dataType: "json",
            data: {
                item_id: item_id
            },
            success: function (result) {
                $('#edit_portfolio .total_loader').remove();
                if (result.success) {
                    $('#edit_portfolio').append(result.portfolio_edit_view);
                    $('.edit_portfolio_tab').removeClass('hidden');
                    $('a[href="#edit_portfolio"]').click();

                    var edit_portfolio_form_id = document.querySelector("#frm_edit_portfolio");
                    init_validatejs(edit_portfolio_form_id, create_portfolio_constraints, ajax_func_edit_portfolio);
                }
                else {
                }
            }
        });
    }

    function ajax_func_edit_portfolio(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LPM.editPortfolio')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#frm_edit_portfolio .total_loader').remove();
                if (data.is_active == -1) {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
                else {
                    menotify('success', data.title, data.message);
                    PortfolioManagerGridData.ajax.reload(null, false);
                    $('a[href="#manage_tab"]').click();
                    $('.edit_portfolio_tab').addClass('hidden');
                    $('#edit_portfolio').html('');
                }
            }
        });
    }

    /*___________________________________________________Edit portfolio_____________________________________________________________________*/

    $(document).off("click", ".cancel_edit_portfolio");
    $(document).on("click", ".cancel_edit_portfolio", function () {
        $('a[href="#manage_tab"]').click();
        $('.edit_portfolio_tab').addClass('hidden');
        $('#edit_portfolio').html('');
    });
    /*___________________________________________________init select2_____________________________________________________________________*/
    init_select2_data('#portfolio_parrent',{!! $parrents !!});

    /*___________________________________________________Trash portfolio_____________________________________________________________________*/

    $(document).off("click", ".btn_trash_portfolio");
    $(document).on("click", ".btn_trash_portfolio", function () {
        var item_id = $(this).data('item_id');
        var title = $(this).data('title');
        desc = 'بله مجموعه( ' + title + ' ) را حذف کن !';
        var parameters = {item_id: item_id};
        yesNoAlert('حذف مجموعه', 'از حذف مجموعه مطمئن هستید ؟', 'warning', desc, 'لغو', trash_portfolio, parameters);
    });

    function trash_portfolio(params) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{!!  route('LPM.trashPortfolio') !!}',
            data: params,
            success: function (data) {
                if (data.is_active == -1) {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
                else {
                    menotify('success', data.title, data.message);
                    PortfolioManagerGridData.ajax.reload(null, false);
                }
            }
        });
    }

    /*___________________________________________________Change is_active_____________________________________________________________________*/
    function change_is_active_portfolio(input) {
        var checked = input.checked;
        var item_id = input.id;
        var parameters = {is_active: checked, item_id: item_id};
        yesNoAlert('تغییر وضعیت مجموعه', 'از تغییر وضعیت آیتم مطمئن هستید ؟', 'warning', 'بله، وضعیت آیتم را تغییر بده!', 'لغو', set_portfolio_is_active, parameters, remove_checked, parameters);
    }

    function set_portfolio_is_active(params) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{!!  route('LPM.setPortfolioStatus') !!}',
            data: params,
            success: function (result) {
                if (result.success) {
                    menotify('success', result.title, result.message);
                }
                else {

                }
            }
        });
    }

    function remove_checked(params) {
        var $this = $('#' + params.item_id);
        if (params.is_active) {
            $this.prop('checked', false);
        }
        else {
            $this.prop('checked', true);
        }
    }

    $('#LPM_showThumbImage').tooltip({
        animated: 'fade',
        placement: 'bottom',
        html: true
    });
    /*___________________________________________________Tooltip_____________________________________________________________________*/
    // $(document).on('mouseenter', '#LPM_showThumbImage', function () {
    //     var image_name = $(this).data('image');
    //     var imageTag = '<div style="position:fixed;">' + '<img src="' + image_name + '" alt="image" height="100" />' + '</div>';
    //     $(this).parent('div').append(imageTag);
    // });
    // $(document).on('mouseleave', '#LPM_showThumbImage', function () {
    //     $(this).parent('div').children('div').remove();
    // });

    /*___________________________________________________FixedColumn_____________________________________________________________________*/
    function set_fixed_dropdown_menu(e) {
        $(e).find('.dropdown_gallery').toggleClass('hidden');
        var position = $(e).offset();
        var position2 = $(e).position();
        var scrollTop = $(document).scrollTop();
        var scrollLeft = $(document).scrollLeft();
        var drop_height = $(e).find('.dropdown_gallery').height() + 16;
        if (($(window).height() - position.top) > drop_height) {
            $(e).find('.dropdown_gallery').css({'position': 'fixed', 'top': position.top - scrollTop + 16, 'left': Math.abs(position.left) + 20, 'height': 'fit-content'});
            window.addEventListener("scroll", function (event) {
                var scroll = this.scrollY;
                $(e).find('.dropdown_gallery').css('top', position.top - scroll + 16)
            });
        }
        else {
            $(e).find('.dropdown_gallery').css({'position': 'fixed', 'top': position.top - scrollTop + 16 - drop_height, 'left': Math.abs(position.left) + 20, 'height': 'fit-content'});
            window.addEventListener("scroll", function (event) {
                var scroll = this.scrollY;
                $(e).find('.dropdown_gallery').css('top', position.top - scroll + 16 - drop_height)
            });
        }
    }
    $(window).click(function(e) {
        if (!$(e.target).closest(".gallerty_menu ").length > 0) {
            $('.dropdown_gallery').addClass('hidden');
        }
    });

    /*___________________________________________________SummerNote_____________________________________________________________________*/

    var init_summernote_for_add_portfolio = false;
    $(document).off('click', '.add_portfolio_tab a');
    $(document).on('click', '.add_portfolio_tab a', function () {
        if (!init_summernote_for_add_portfolio) {
            $('#portfolio_description').summernote({
                height: 150,
            });
            init_summernote_for_add_portfolio = true;
        }
    });

    /*___________________________________________________DataTable_____________________________________________________________________*/

    function datatable_load_fun(filter_parrent_id,filter_title,filter_is_active) {
        filter_parrent_id = filter_parrent_id || false;
        filter_title = filter_title || '';
        filter_is_active = filter_is_active || false;
        var getPortfolioRoute = '{{ route('LPM.getPortfolio') }}';
        var fixedColumn = {
            leftColumns: 3,
            rightColumns: 2
        };
        data ={
                filter_parrent_id: filter_parrent_id,
                filter_title: filter_title,
                filter_is_active: filter_is_active,
            };
        dataTablesGrid('#PortfolioManagerGridData', 'PortfolioManagerGridData', getPortfolioRoute, portfolio_grid_columns,data);
        PortfolioManagerGridData.columns([3]).visible(false);
        html_td = '' ;
        if(filter_parrent_id)
        {
            PortfolioManagerGridData.columns([3]).visible(true);
            html_td = '   <td style="border: none; border-bottom: 1px lightgray solid;">' ;
        }
        // $('#PortfolioManagerGridData').find('thead').first().append
        // (
        //     '<tr role="row">' +
        //     '   <td style="border: none; border-bottom: 1px lightgray solid;">&nbsp;</td>' +
        //     '   <td style="border: none; border-bottom: 1px lightgray solid;">' +
        //     '       <input type="text" class="form-control filter_title" name="filter_title" value="' + filter_title + '" style="width: 100%;">' +
        //     '   </td>' +
        //     html_td +
        //     '   <td style="border: none; border-bottom: 1px lightgray solid;">&nbsp;</td>' +
        //     '   <td style="border: none; border-bottom: 1px lightgray solid;">' +
        //     '       <select class="form-control filter_parrent" name="filter_parrent" style="width:100px">' +
        //     '       </select>' +
        //     '   </td>' +
        //     '    <td style="border: none; border-bottom: 1px lightgray solid;">&nbsp;</td>' +
        //     '   <td style="border: none; border-bottom: 1px lightgray solid;">' +
        //     '       <select class="form-control filter_is_active" name="filter_is_active" style="width:150px">' +
        //     '           <option value="-1">انتخاب وضعیت</option>' +
        //     '           <option value="0" '+('0' === filter_is_active ? 'selected="selected"' : '')+'>غیرفعال</option>' +
        //     '           <option value="1" '+('1' === filter_is_active ? 'selected="selected"' : '')+'>فعال</option>' +
        //     '       </select>' +
        //     '   </td>' +
        //     '    <td style="border: none; border-bottom: 1px lightgray solid;">&nbsp;</td>' +
        //     '</tr>'
        // );
        init_select2_ajax('.filter_parrent', '{{route('LPM.autoCompletePortfolioParrent')}}', true);
    }

    /*-----------------------------------------------Order------------------------------------------------------*/
    $(document).off("click", '.reorder_portfolio_form_grid_data');
    $(document).on('click', '.reorder_portfolio_form_grid_data', function () {
        var $this = $(this);
        var order_type = $this.data('order_type');
        var item_id = $this.data('item_id');
        var parrent_id = $this.data('parent_id');
        reOrderPortfolioFormGridData(order_type, item_id,parrent_id);
    });

    function reOrderPortfolioFormGridData(order_type, item_id,parrent_id) {
        var result = false;
        $.ajax({
            type: "POST",
            url: '{{ route('LPM.saveOrderPortfolioForm')}}',
            dataType: "json",
            data: {item_id:item_id, order_type: order_type,parrent_id:parrent_id},
            success: function (data) {
                if (data.success == true) {
                    window.PortfolioManagerGridData.ajax.reload(null,false);
                    result = true;
                }
            }
        });
        return result;
    }
    //--------------------------------------------tag select----------------------------------------------//
    init_select2_ajax('#showSelectTag', '{{route('LTS.autoCompleteTag')}}', true,true);
    init_select2_data('#FaqSelectLang',{!! $multiLang !!});

</script>