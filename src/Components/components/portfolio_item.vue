<template>
    <div style="    margin-top: 30px;">
        <div class="">
            <div class="lpm_col-md-12" style="position:relative">
                <transition name="descFade"  :duration="{ enter: 500, leave: 800 }">
                    <div class="lpm_col-md-6">
                        <h2 id="single_portfolio_title"><label>{{item.title}}</label></h2>
                        <div  v-html="item.description"></div>
                    </div>
                </transition>
                <div class="lpm_col-md-6">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <vue-flux :options="fluxOptions" :images="fluxImages" :transitions="fluxTransitions"  ref="slider">
                            </vue-flux>
                        </div>
                    </div>
                    <button @click="$parent.getPortfolio(item.category_id)" class="lpm_btm btn_item_return">{{t('return')}}</button>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="lpm_col_md_12 margin_top" style="margin-top: 5%;">
                <div class="text_center">
                    <h3 class="lpm_border-success">
                        <span class="heading_border" style="color:#0c0c0c!important;">
                           {{t('related_project')}}
                        </span>
                    </h3>
                </div>
                <div v-for="port in item.portfolio_similars" class="lpm_project_images">
                    <div class="pointer" @click="changePort(port.encode_id)"><img :src="'/LFM/DownloadFile/ID/'+port.encode_file_id+'/small/404.png/100/410/225'" class="img-fluid" style="width: 250px;height:169px"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueFlux from './vue-flux/VueFlux.vue';
    import Transitions from './vue-flux/transitions/index.js';
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
        methods: {
            changePort:function (encode_id) {
                axios.post("/LPM/getPort", {item_id:encode_id}).then(response => {
                    this.$nextTick(() =>{
                        this.$parent.setShowItem(response.data.item);
                    })
                });
            }
        }
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
    .descFade-enter-active, .descFade-leave-active {
        transition: all 300ms ease-out
    }
    .descFade-enter, .descFade-leave-to /* .list-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: translateX(0px);
        transition-duration: 3s;
    }

</style>