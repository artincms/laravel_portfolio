<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).off("click", ".backToportfolio");
        $(document).on("click", ".backToportfolio", function () {
            location.reload();
            // var lang_id = $(this).data('lang_id');
            // showPortfolio(lang_id);
        });

        function showPortfolio(lang_id)
        {
            $.ajax({
                type: "POST",
                url: '{!!  route('LPM.getPortfolioAjax') !!}',
            dataType: "json",
            data: {lang_id:lang_id},
            success: function (data) {
                if (data.success == true) {
                    $('.showPortfolio').html(data.html);
                }
            }
        });
        }

        $(document).off("click", ".showPortfolioItem");
        $(document).on("click", ".showPortfolioItem", function (e) {
            e.preventDefault();
            var item_id = $(this).data('item_id');
            var lang_id = $(this).data('lang_id');
            showPortfolioItem(item_id,lang_id);
        });

        function showPortfolioItem(item_id,lang_id)
        {
            $.ajax({
                type: "POST",
                url: '{!!  route('LPM.getPortfolioItemAjax') !!}',
            dataType: "json",
            data: {item_id:item_id,lang_id:lang_id},
            success: function (data) {
                if (data.success == true) {
                    $('.showPortfolio').html(data.html);
                }
            }
        });
        }
    });



</script>