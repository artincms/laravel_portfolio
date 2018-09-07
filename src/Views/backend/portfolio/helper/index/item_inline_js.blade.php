<script>
    window['portfolio_item_columns'] = [
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
            width: '12%',
            data: 'order',
            name: 'order',
            title: 'ترتیب',
            searchable: false,
            mRender: function (data, type, full) {
                var order = PortfolioItemGridData.order();
                if (order[0][0] == 2) {
                    if (order[0][1] == 'desc') {
                        var result = '';
                        result += '' +
                            '<div class="input-group mb-3">' +
                            '   <div class="input-group-prepend ">' +
                            '       <button type="button" style="float: right;border-radius: 0px;" class="btn btn-outline-secondary reorder_portfolio_item_form_grid_data bg-info-400" ' +
                            '           data-order_type="increase" ' +
                            '           data-item_id="' + full.id + '"' +
                            '           data-portfolio_id="' + full.portfolio_id + '" >' +
                            '           <i class="fas fa-level-up-alt"></i>'  +
                            '       </button>' +
                            '   </div>' +
                            '   <input type="text" class="form-control text-center" style="width:30% " disabled value="'+full.order+'">' +
                            '    <div class="input-group-append">' +
                            '       <button type="button" style="border-radius: 0px;" class="btn btn-outline-secondary reorder_portfolio_item_form_grid_data bg-info-800" ' +
                            '           data-order_type="decrease"' +
                            '           data-item_id="' + full.id + '"' +
                            '           data-portfolio_id="' + full.portfolio_id + '" >' +
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
                            '       <button type="button" style="float: right;border-radius: 0px;" class="btn btn-outline-secondary reorder_portfolio_item_form_grid_data bg-info-400" ' +
                            '           data-order_type="decrease" ' +
                            '           data-item_id="' + full.id + '"' +
                            '           data-portfolio_id="' + full.portfolio_id + '">' +
                            '           <i class="fas fa-level-up-alt"></i>'  +
                            '       </button>' +
                            '   </div>' +
                            '   <input type="text" class="form-control text-center" style="width:30% " disabled value="'+full.order+'">' +
                            '    <div class="input-group-append">' +
                            '       <button type="button" style="border-radius: 0px;" class="btn btn-outline-secondary reorder_portfolio_item_form_grid_data bg-info-800" ' +
                            '           data-order_type="increase"' +
                            '           data-item_id="' + full.id + '"' +
                            '           data-portfolio_id="' + full.portfolio_id + '">' +
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
            width: '20%',
            data: 'title',
            name: 'title',
            title: 'عنوان',
        },
        {
            width: '25%',
            data: 'description',
            name: 'description',
            title: 'توضیحات',
            mRender: function (data, type, full) {
                if(full.description)
                {
                    return '<div class="text_over_flow pointer td_description" onclick="hide_text_over_flow(this)">'+full.description+'</div>'
                }
                else
                {
                    return '' ;
                }
            }
        },
        {
            width: '25%',
            data: 'is_active',
            name: 'is_active',
            title: 'وضعیت',
            mRender: function (data, type, full) {
                var ch = '';
                if (parseInt(full.is_active))
                    ch = 'checked';
                else
                    ch = '';
                return '<input class="styled " id="change_item_is_active_' + full.id + '" type="checkbox" name="special" data-item_id="' + full.id + '"  onchange="change_is_active_item(this)"' + ch + '>'
            }
        },
        {
            width: '20%',
            searchable: false,
            sortable: false,
            title: 'عملیات',
            mRender: function (data, type, full) {
                return '' +
                        '<div class="gallerty_menu float-right" onclick="set_fixed_dropdown_menu(this)" data-toggle="dropdowns">' +
                        '<span>' +
                        '   <em class="fas fa-caret-down"></em>' +
                        '   <i class="fas fa-bars"></i> ' +
                        '</span>' +
                        '  <div class="dropdown_gallery hidden">' +
                        '    <a class="btn_related_portfolio pointer gallery_menu-item" data-item_id="' + full.id + '" data-title="' + full.title + ' " data-lang_id="' + full.lang_id + '">' +
                        '       <i class="fa fa-edit"></i><span class="ml-2">نمونه کارهای مرتبط</span>' +
                        '   </a>' +
                        '   <a class="btn_edit_portfolio_item pointer gallery_menu-item" data-item_id="' + full.id + '" data-title="' + full.title + '">' +
                        '       <i class="fa fa-edit"></i><span class="ml-2">ویرایش</span>' +
                        '   </a>' +
                        '    <a class="btn_trash_portfolio_item pointer gallery_menu-item" data-item_id="' + full.id + '" data-title="' + full.title + ' ">' +
                        '       <i class="fa fa-trash"></i><span class="ml-2">حذف</span>' +
                        '   </a>'
                    '  </div>' +
                    '</div>';
            }
        }
    ];
    var create_portfolio_item_constraints = {
        title: {
            presence: {message: '^<strong>عنوان فرم ضروری است.</strong>'}
        },
        order: {
            numericality: {
                onlyInteger: true,
                message: '^<strong>ترتیب نامعتبر است .</strong>'
            }
        }
    };
    $(document).off("click", ".show_portfolio_item");
    $(document).on("click", ".show_portfolio_item", function () {
        var item_id = $(this).data('item_id');
        var lang_id = $(this).data('lang_id');
        var title = $(this).data('title');
        $('a[href="#manage_tab_item"]').click();
        $('.manage_portfolio_item_tab').removeClass('hidden');
        var html = '' +
            '<div class="space-20"></div>' +
            '<table id="PortfolioItemGridData" class="table" width="100%"></table>';
        $('.span_manage_portfolio_item_tab').html('آیتم : ' + title);
        $('#manage_tab_portfolio_item').html(html);
        datatable_load_item(item_id);
        $(document).off("click", "#add_portfolio_item_tab");
        $(document).on("click", "#add_portfolio_item_tab", function () {
            get_portfolio_item(item_id,lang_id);
        });

        function get_portfolio_item(item_id,lang_id) {
            $('#add_portfolio_picture').append(generate_loader_html('لطفا منتظر بمانید...'));
            $.ajax({
                type: "POST",
                url: '{{ route('LPM.getAddPortfolioItemForm')}}',
                dataType: "json",
                data: {
                    item_id: item_id,
                    lang_id: lang_id,
                },
                success: function (result) {
                    $('#edit_portfolio .total_loader').remove();
                    if (result.status == true) {
                        $('#add_portfolio_item').html(result.portfolio_add_item);
                        var frm_portfolio_add_item = document.querySelector("#frm_create_portfolio_item");
                        init_validatejs(frm_portfolio_add_item, create_portfolio_item_constraints, ajax_func_add_portfolio_item);

                        function ajax_func_add_portfolio_item(formElement) {
                            var formData = new FormData(formElement);
                            $.ajax({
                                type: "POST",
                                url: '{{ route('LPM.createPortfolioItem')}}',
                                dataType: "json",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (data) {
                                    $('#frm_create_portfolio_item .total_loader').remove();
                                    if (data.success) {
                                        menotify('success', data.title, data.message);
                                        PortfolioItemGridData.ajax.reload(null, false);
                                        $('a[href="#manage_tab_portfolio_item"]').click();
                                    }
                                    else {
                                        showMessages(data.message, 'form_message_box', 'error', formElement);
                                        showErrors(formElement, data.errors);
                                    }
                                }
                            });
                        }
                    }
                }
            });
        }
        //--------------filter------------------------------------------------------------------
        $(document).off('change', '.filter_item_is_active');
        $(document).on('change', '.filter_item_is_active', datatable_reload_item_fun);
        init_doAfterStopTyping('.filter_item_title', datatable_reload_item_fun);
        function datatable_reload_item_fun() {
            var filter_item_is_active = $('.filter_item_is_active').val();
            var filter_item_title = $('.filter_item_title').val();
            PortfolioItemGridData.destroy();
            $('#PortfolioItemGridData').empty();
            datatable_load_item(item_id, filter_item_is_active,filter_item_title);
        }
    });

    /*___________________________________________________close manage_____________________________________________________________________*/
    $(document).off("click", ".cancel_manage_portfolio_item");
    $(document).on("click", ".cancel_manage_portfolio_item", function () {
        $('a[href="#manage_tab"]').click();
        $('.manage_portfolio_item_tab').addClass('hidden');
        //$('#edit_portfolio').html('');
    });

    /*___________________________________________________change is_active_____________________________________________________________________*/
    function change_is_active_item(input) {
        console.log();
        var checked = input.checked;
        var id = input.id;
        var item_id = $(input).data('item_id');
        var parameters = {is_active: checked, item_id: item_id};
        yesNoAlert('تغییر وضعیت نمونه کار', 'از تغییر وضعیت نمونه کار مطمئن هستید ؟', 'warning', 'بله، وضعیت نمونه کار را تغییر بده!', 'لغو', set_item_is_active, parameters, remove_checked_item, parameters);
    }

    function set_item_is_active(params) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{!!  route('LPM.setItemStatus') !!}',
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

    function remove_checked_item(params) {
        var $this = $('#change_item_is_active_' + params.item_id);
        if (params.is_active) {
            $this.prop('checked', false);
        }
        else {
            $this.prop('checked', true);
        }
    }

    /*___________________________________________________add item_____________________________________________________________________*/

    function showitemFile(res) {
        $('#show_area_medium_item_file').html(res.itemFile.view.medium);
        $('#warning_picture').addClass('hidden');
    }

    function showVideoMp4File(res) {
        $('#show_area_medium_video_mp4_file').html(res.videoMp4itemFile.view.medium);
        $('#warning_video_mp4').addClass('hidden');
    }

    function showVideoWebmFile(res) {
        $('#show_area_medium_video_webm_file').html(res.videoWebmFile.view.medium);
        $('#warning_video_webm').addClass('hidden');
    }

    function showVideoOggFile(res) {
        $('#show_area_medium_video_ogg_file').html(res.videoOggFile.view.medium);
        $('#warning_video_ogg').addClass('hidden');
    }

    function showAudioOggFile(res) {
        $('#show_area_medium_audio_ogg_file').html(res.audioOggFile.view.medium);
        $('#warning_audio_ogg').addClass('hidden');
    }

    function showAudioMp3File(res) {
        $('#show_area_medium_audio_mp3_file').html(res.audioMp3File.view.medium);
        $('#warning_audio_mp3').addClass('hidden');
    }

    function showAudioWavFile(res) {
        $('#show_area_medium_audio_wav_file').html(res.audioWavFile.view.medium);
        $('#warning_audio_wav').addClass('hidden');
    }

    /*___________________________________________________Edit portfolio Item_____________________________________________________________________*/
    $(document).off("click", ".btn_edit_portfolio_item ");
    $(document).on("click", ".btn_edit_portfolio_item ", function () {
        var item_id = $(this).data('item_id');
        var title = $(this).data('title');
        $('.span_edit_portfolio_item_tab').html('ویرایش آیتم: ' + title);
        get_edit_portfolio_item_form(item_id);
    });

    function get_edit_portfolio_item_form(item_id) {
        $('#edit_portfolio_item').children().remove();
        $('#edit_portfolio_item').append(generate_loader_html('لطفا منتظر بمانید...'));
        $.ajax({
            type: "POST",
            url: '{{ route('LPM.getEditPortfolioItemForm')}}',
            dataType: "json",
            data: {
                item_id: item_id
            },
            success: function (result) {
                $('#edit_portfolio_item .total_loader').remove();
                if (result.success == true) {
                    $('#edit_portfolio_item').append(result.portfolio_item_edit_view);
                    $('.edit_portfolio_item_tab').removeClass('hidden');
                    $('a[href="#edit_portfolio_item"]').click();

                    var edit_portfolio_item_form_id = document.querySelector("#frm_edit_portfolio_item");
                    init_validatejs(edit_portfolio_item_form_id, create_portfolio_item_constraints, ajax_func_edit_portfolio_item);
                }
                else {

                }
            }
        });
    }

    function ajax_func_edit_portfolio_item(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LPM.editPortfolioItem')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#frm_edit_portfolio .total_loader').remove();
                if (data.status == -1) {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
                else {
                    menotify('success', data.title, data.message);
                    PortfolioItemGridData.ajax.reload(null, false);
                    $('a[href="#manage_tab_portfolio_item"]').click();
                    $('.edit_portfolio_item_tab').addClass('hidden');
                    $('#edit_portfolio_item').html('');
                }
            }
        });
    }

    /*___________________________________________________cancel edit portfolio item button_____________________________________________________________________*/
    $(document).off("click", ".cancel_edit_portfolio_item_tab");
    $(document).on("click", ".cancel_edit_portfolio_item_tab", function () {
        $('a[href="#manage_tab_portfolio_item"]').click();
        $('.edit_portfolio_item_tab').addClass('hidden');
        $('#edit_portfolio_item').html('');
    });

    /*___________________________________________________Trash portfolio Item_____________________________________________________________________*/
    $(document).off("click", ".btn_trash_portfolio_item");
    $(document).on("click", ".btn_trash_portfolio_item", function () {
        var item_id = $(this).data('item_id');
        var title = $(this).data('title');
        desc = 'بله نمونه کار( ' + title + ' ) را حذف کن !';
        var parameters = {item_id: item_id};
        yesNoAlert('حذف نمونه کار', 'از حذف نمونه کار مطمئن هستید ؟', 'warning', desc, 'لغو', trash_portfolio_item, parameters);
    });

    function trash_portfolio_item(params) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{!!  route('LPM.trashPortfolioItem') !!}',
            data: params,
            success: function (data) {
                if (data.status == -1) {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
                else {
                    menotify('success', data.title, data.message);
                    PortfolioItemGridData.ajax.reload(null, false);
                }
            }
        });
    }

    /*___________________________________________________change type_____________________________________________________________________*/
    $(document).off("change", 'input[type=radio][name=type]');
    $(document).on("change", 'input[type=radio][name=type]', function () {
        show_input_file(this.value);
    });

    function show_input_file(value) {
        if (value == 2) {
            $('#form_group_video').removeClass('hidden');
            $('#form_group_picture').addClass('hidden');
            $('#form_group_audio').addClass('hidden');
        }
        else if (value == 1) {
            $('#form_group_video').addClass('hidden');
            $('#form_group_picture').addClass('hidden');
            $('#form_group_audio').removeClass('hidden');
        }
        else {
            $('#form_group_video').addClass('hidden');
            $('#form_group_picture').removeClass('hidden');
            $('#form_group_audio').addClass('hidden');
        }
    }

    $(window).click(function(e) {
        if(!$(e.target).closest(".td_description").length >0)
        {
            $('.td_description').addClass('text_over_flow dd');
        }
    });
    function hide_text_over_flow(el)
    {
       $(el).toggleClass('text_over_flow')
    }
    /*___________________________________________________DataTable_____________________________________________________________________*/

    function datatable_load_item(item_id,filter_item_is_active,filter_item_title) {
        item_id = item_id || false;
        filter_item_is_active = filter_item_is_active || false;
        filter_item_title = filter_item_title || '';
        var fixedColumn = {
            leftColumns: 2,
            rightColumns: 2
        };
        data =
            {
                filter_item_is_active: filter_item_is_active,
                filter_item_title: filter_item_title,
                item_id: item_id,
            };
        dataTablesGrid('#PortfolioItemGridData', 'PortfolioItemGridData', '{{ route('LPM.getPortfolioItem') }}', portfolio_item_columns, data);
    }

    //-----------------------------------------------------related project------------------------------------------------//
    window['portfolio_related_grid_columns'] = [
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
            title: 'عنوان'
        },
        {
            width: '20%',
            data: 'description',
            name: 'description',
            title: 'توضیحات',
            mRender: function (data, type, full) {
                return '<div class="text_over_flow">'+full.description+'</div>'
            }
        },
        {
            width: '15%',
            data: 'lang_name',
            name: 'lang_name',
            title: 'زبان'
        },
        {
            width: '15%',
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
            width: '7%',
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
                    '    <a class="btn_trash_portfolio_related pointer gallery_menu-item" data-item_id="' + full.id + '" data-title="' + full.title + ' ">' +
                    '       <i class="fa fa-trash"></i><span class="ml-2">حذف</span>' +
                    '   </a>'
                '  </div>' +
                '</div>';

            }
        }
    ];
    $(document).off("click", ".btn_related_portfolio");
    $(document).on("click", ".btn_related_portfolio", function () {
        var item_id = $(this).data('item_id');
        var title = $(this).data('title');
        var lang_id = $(this).data('lang_id');
        $('.span_manage_portfolio_related_item_tab').html('نمونه کارهای مرتبط : ' + title);
        $('.manage_portfolio_related_item_tab').removeClass('hidden');
        $('a[href="#manage_tab_related_item"]').click();
        $('.input_related_portfolio').val(item_id);
        $('.portfolio_manager_related_parrent_div').html('<table id="PortfolioManagerRelatedGridData" class="table " width="100%"></table>');
        data = {
            item_id: item_id
        };
        var getPortfolioRelatedRoute = '{{ route('LPM.getPortfolioRelatedItem') }}';
        dataTablesGrid('#PortfolioManagerRelatedGridData', 'PortfolioManagerRelatedGridData', getPortfolioRelatedRoute, portfolio_related_grid_columns, data);

        init_select2_ajax('#selectPortfolioRelated', '{{route('LPM.autoCompletePortfolio')}}', true, true, false, false, lang_id);

        //-----------------------------------------save related portfolio-------------------------------------------------------//


        var create_portfolio_related_constraints = {};
        var edit_portfolio_form_related_id = document.querySelector("#frm_edit_portfolio_related");
        init_validatejs(edit_portfolio_form_related_id, create_portfolio_related_constraints, ajax_func_edit_portfolio_related);

        function ajax_func_edit_portfolio_related(formElement) {
            var formData = new FormData(formElement);
            $.ajax({
                type: "POST",
                url: '{{ route('LPM.addRelatedPortfolio')}}',
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#frm_edit_portfolio_related .total_loader').remove();
                    if (data.success) {
                        menotify('success', data.title, data.message);
                        PortfolioManagerRelatedGridData.ajax.reload(null, false);
                        var form_element = $("#frm_edit_portfolio_related");
                        form_element.find('select').val('').trigger('change');
                    }
                    else {
                        showMessages(data.message, 'form_message_box', 'error', formElement);
                        showErrors(formElement, data.errors);
                    }
                }
            });
        }
    });
    //------------------------------------------cancel button-----------------------------------------------------//
    $(document).off("click", ".cancel_manage_portfolio_related_item");
    $(document).on("click", ".cancel_manage_portfolio_related_item", function () {
        $('a[href="#manage_tab_portfolio_item"]').click();
        $('.manage_portfolio_related_item_tab').addClass('hidden');
        $('.portfolio_manager_related_parrent_div').html('');
    });

</script>