<template>
    <div :class="direction">
        <modal v-if="showModal" :src="src" @close="showModal = false">
        </modal>
        <portfolio_item v-if="showItem" :item="childItem"></portfolio_item>
        <div v-if="!showItem" style="width: 100%">
            <div v-if="show_header" class="lgs_gallery_header" :style="{ color: h_f_color, background: h_b_color}">
                <div style="position: relative">
                    <div class="header_gallery_image thumb_zoom">
                        <img class="img_header" :src="'/LFM/DownloadFile/ID/'+myCategory.encode_file_id+'/small/404.png/100/410/225'">
                    </div>
                    <div class="gallery_content">
                        <h1 class="header_gallery_title">{{myCategory.title}}</h1>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
                <div class="backToCat pointer" @click="getPortfolio(myCategory.parent_id)">
                    {{t('return')}}
                </div>
            </div>
            <div class="lpm_col_md_12">
                <div id="gallery">
                    <div>
                        <div>
                            <transition-group name="listPort" tag="div" v-if="filteredPort.length>0">
                                <button :key="0" class=" lpm_btn filter lpm_btn-primary lpm_float_right lpm_margin_left_1"  @click="filterData(-1)" data-filter="all">همه</button>
                                <button v-for="filter in filters" v-if="filter.portfolios.length>0 || filter.categories.length>0" :key="filter.id" :data-filter="'.category-'+filter.id" @click="filterData(filter.id)" class="lpm_btn filter lpm_btn-primary lpm_float_right lpm_margin_left_1">{{filter.title}}</button>
                            </transition-group>
                        </div>
                        <div style="clear:both"></div>
                        <div style="margin-top:10px "></div>
                        <transition-group name="list_item" class="list_item" tag="div">
                            <div class="mix lpm_float_right" v-for="portfolio in filteredPort" :key="portfolio.title" :data-my-order="portfolio.order" style="display: inline-block; margin: 10px;position:relative">
                                <div :class="{stack:portfolio.type == 'category'}">
                                    <div class="width_50" style="position: relative">
                                        <a class="lpm_pointer fa-lps-search-plus_a" @click="showModalFunc(portfolio)" :data-src="portfolio.url">
                                            <i class="lps-icon fa-lps-search-plus"></i>
                                        </a>
                                        <a v-if="portfolio.type == 'category'" href="#" @click="getPortfolio(portfolio.id)" class="lpm_pointer fa-lps-link_a" :class="showPortfolioItem">
                                            <i class="lps-icon fa-lps-link"></i>
                                        </a>
                                        <a v-else href="#" @click="setShowItem(portfolio)" class="lpm_pointer fa-lps-link_a" :class="showPortfolioItem">
                                            <i class="lps-icon fa-lps-link"></i>
                                        </a>
                                    </div>
                                    <div class="thumb_zoom" style="width:220px;height:146px"><img style="width: 220px;height: 146px" :src="portfolio.url" class="img-responsive"> </div>
                                </div>
                            </div>
                        </transition-group>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    window.axios = require('axios');
    import modal from './components/modal'
    import portfolio_item from './components/portfolio_item'
    import VueTranslate from 'vue-translate-plugin'
    Vue.use(VueTranslate);
    export default {
        name: "laravel_portfolio",
        props: {
            category_id: {
                type: Number,
                default() {
                    return 0;
                },
            },
            lang_id: {
                type: Number,
                default() {
                    return 0;
                },
            },
            rtl: {
                type: Boolean,
                default() {
                    return true;
                },
            },
        },
        mounted() {
            this.getPortfolio(this.category_id);
        },
        data: function () {
            return {
                items:[],
                categories:[],
                myCategory:[],
                filters:[],
                showModal:false,
                show_header:false,
                src:'',
                tag_id:-1,
                showItem:false,
                childItem:[],
                h_b_color:'#000000',
                h_f_color:'#ffffff'
            }
        },
        computed: {
            filteredPort: function() {
                let vm = this;

                if(vm.tag_id === -1) {
                    return vm.items;
                } else {
                    return vm.items.filter(function(item) {
                        if(item.tags.length>0)
                        {
                            let data = item.tags.find(function (obj) {
                                if(obj.id == vm.tag_id)
                                {
                                    return item ;
                                }
                            });
                            return data;
                        }
                    });
                }
            },
            direction:function () {
                console.log(this.rtl , typeof this.rtl);
                if (this.rtl)
                {
                    return 'rtl';
                }
                else
                {
                    return 'ltr';
                }

            }
        },
        methods: {
            getPortfolio:function (cat_id) {
                axios.post("/LPM/getPortfolioFromVue", {lang_id: this.lang_id,category_id:cat_id}).then(response => {
                    this.$nextTick(() =>{
                        this.showItem = false;
                        this.categories = response.data.categories;
                        this.myCategory = response.data.myCategory;
                        this.items = response.data.data;
                        this.filters = response.data.filters;
                        this.h_f_color = response.data.h_f_color;
                        this.h_b_color = response.data.h_b_color;
                        if(cat_id !=0)
                        {
                            this.show_header = true;
                        }
                        else
                        {
                            this.show_header = false;

                        }
                        if (response.data.lang =='fa')
                        {
                            this.$translate.setLang("fa");
                        }
                        else
                        {
                            this.$translate.setLang("en");
                        }
                    })
                });
            },
            setShowItem:function (e) {
              this.showItem = true;
              this.childItem=e;

            },
            showPortfolioItem:function () {

            },
            showModalFunc:function (e) {
                this.src = e.url
                this.showModal=true ;
            },
            filterData:function (id) {
                this.tag_id=id;
            }
        },
        components: {
            modal,portfolio_item
        },
        locales: {
            en: {
                'title' : 'Title :',
                'portfolio' : 'Portfolio',
                'return' : 'Return',
                'related_project' : 'Related Project'
            },
            fa: {
                'title' : 'عنوان :',
                'portfolio' : 'نمونه کار ها',
                'return' : 'بازگشت',
                'related_project' : 'پروژه های مرتبط'
            }
        }
    }
</script>

<style scoped>
    @import  './assets/css/custom.css';
    @import  './assets/fonts/icon/style.css';

</style>