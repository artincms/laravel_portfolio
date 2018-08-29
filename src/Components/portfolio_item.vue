<template>
    <div class="lpm_container" style="direction: rtl">
        <h2 id="single_portfolio_title"><label>{{item.title}}</label></h2>
        <div class="lpm_row">
            <div class="lpm_col-md-12">
                <div class="lpm_col-md-6" v-html="item.description"></div>
                <div class="lpm_col-md-6">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <vue-flux :options="fluxOptions" :images="fluxImages" :transitions="fluxTransitions"  ref="slider">

                            </vue-flux>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="lpm_col_md_12 margin_top" style="margin-top: 5%;">
                <div class="text_center">
                    <h3 class="lpm_border-success">
                        <span class="heading_border bg-success">
                           پروژه های مرتبط
                        </span>
                    </h3>
                </div>
                <div v-for="port in item.portfolio_similars" class="lpm_project_images">
                    <a href="#"><img src="http://demo.joshadmin.com/assets/images/gallery/3.jpg" class="img-fluid" style="width: 250px;height:169px"></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueFlux from './components/VueFlux.vue';
    import Transitions from './components/transitions/index.js';
    export default {
        name: "portfolio_item",
        props:['item'],
        components: {
            VueFlux
        },
        data: function () {
            return {
                fluxTransitions: {
                    transitionConcentric: Transitions.transitionConcentric
                },
                fluxOptions: {
                    autoplay: true,
                    showControls:true,
                    showPagination:true
                },
            }
        },
        computed: {
            fluxImages: function () {
                let images = [];
                images.push('/LFM/DownloadFile/ID/'+this.item.encode_file_id+'/small/404.png/100/410/250');
                this.item.files.forEach(function(element) {
                        images.push('/LFM/DownloadFile/ID/'+element.encode_id+'/small/404.png/100/410/250');
                    });
                    return images;
                }
        },
    }
</script>

<style scoped>
    .lpm_border-success {

        border-bottom: 2px solid #01bc8c !important;
        padding-bottom: 5px;
    }
    .text_center{
        text-align: center;
    }
    .clearfix{
        clear:both
    }
    .lpm_project_images{
        width: 254px;
        margin: 5px;
        float: right;
    }

</style>