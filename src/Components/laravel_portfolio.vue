<template>
    <div>
        <modal v-if="showModal" :src="src" @close="showModal = false">
        </modal>
        <portfolio_item v-if="showItem" :item="childItem"></portfolio_item>
        <div v-if="!showItem" class="lpm_container" :style="{direction: direction}">
            <div class="lpm_col-md-12">
                <div id="gallery">
                    <div>
                        <button class=" lpm_btn filter lpm_btn-primary lpm_float_right lpm_margin_left_1"  @click="filterData(-1)" data-filter="all">همه</button>
                        <button v-for="filter in filters" v-if="filter.portfolios.length>0" :data-filter="'.category-'+filter.id" @click="filterData(filter.id)" class="lpm_btn filter lpm_btn-primary lpm_float_right lpm_margin_left_1">{{filter.title}}</button>
                    </div>
                    <div style="clear:both"></div>
                    <div class="mix lpm_float_right" v-for="portfolio in filteredPort" :key="portfolio.id" :data-my-order="portfolio.order" style="display: inline-block;">
                        <div class="lpm_col-md-3 lpm_col-sm-6 lpm_col-xs-6">
                            <a class="lpm_pointer" @click="showModalFunc(portfolio)" :data-src="portfolio.url"><i class="fa fa-search-plus"></i></a>
                            <a href="#" @click="setShowItem(portfolio)" class="lpm_pointer" :class="showPortfolioItem"><i class="fa fa-link"></i></a>
                        </div>
                        <div class="thumb_zoom"><img style="width: 220px;height: 146px" :src="portfolio.url" class="img-responsive"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from './lib/axios/index.js'
    import modal from './modal'
    import portfolio_item from './portfolio_item'
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

</style>