<template>
    <div>
        <modal v-if="showModal" :src="src" @close="showModal = false">
        </modal>
        <portfolio_item v-if="showItem" :item="childItem"></portfolio_item>
        <div v-if="!showItem" style="width: 100%"  :style="{direction: direction}">
            <div class="lpm_col_md_12">
                <div id="gallery">
                    <div>
                        <transition-group name="listPort" tag="div">
                            <button :key="0" class=" lpm_btn filter lpm_btn-primary lpm_float_right lpm_margin_left_1"  @click="filterData(-1)" data-filter="all">همه</button>
                            <button v-for="filter in filters" v-if="filter.portfolios.length>0" :key="filter.id" :data-filter="'.category-'+filter.id" @click="filterData(filter.id)" class="lpm_btn filter lpm_btn-primary lpm_float_right lpm_margin_left_1 listPort">{{filter.title}}</button>
                        </transition-group>
                    </div>
                    <div style="clear:both"></div>
                    <transition-group name="list_item" tag="div">
                        <div class="mix lpm_float_right" v-for="portfolio in filteredPort" :key="portfolio.id" :data-my-order="portfolio.order" style="display: inline-block;">
                            <div class="width_50" style="position: relative">
                                <a class="lpm_pointer fa-lps-search-plus_a" @click="showModalFunc(portfolio)" :data-src="portfolio.url">
                                    <i class="lps-icon fa-lps-search-plus"></i>
                                </a>
                                <a href="#" @click="setShowItem(portfolio)" class="lpm_pointer fa-lps-link_a" :class="showPortfolioItem">
                                    <i class="lps-icon fa-lps-link"></i>
                                </a>
                            </div>
                            <div class="thumb_zoom"><img style="width: 220px;height: 146px" :src="portfolio.url" class="img-responsive"> </div>
                        </div>
                    </transition-group>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    window.axios = require('axios');
    import modal from './components/modal'
    import portfolio_item from './components/portfolio_item'
    export default {
        name: "laravel_portfolio",
        props:['lang_id','direction'],
        mounted() {
            this.getPortfolio();
        },
        data: function () {
            return {
                items:[],
                filters:[],
                showModal:false,
                src:'',
                tag_id:-1,
                showItem:false,
                childItem:[]
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
            }
        },
        methods: {
            getPortfolio:function () {
                axios.post("/LPM/Portfolio/getPortfolioFromVue", {lang_id: this.lang_id}).then(response => {
                    this.$nextTick(() =>{
                        this.items = response.data.portfolios;
                        this.filters = response.data.filters;
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
        }
    }
</script>

<style scoped>
    @import  './assets/css/custom.css';
    @import  './assets/fonts/icon/style.css';

</style>