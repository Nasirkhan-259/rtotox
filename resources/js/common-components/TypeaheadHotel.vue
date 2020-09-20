<template>
    <div class="Typeahead">
        <i class="fa fa-spinner fa-spin" v-if="loading"></i>
        <template v-else>
<!--            <i class="fa fa-search" v-show="isEmpty"></i>-->
<!--            <i class="fa fa-times" v-show="isDirty" @click="reset"></i>-->
        </template>

        <!-- the input field -->
        <input type="text"
               class="Typeahead__input"
               placeholder="Search location"
               autocomplete="off"
               v-model="query"
               @keydown.down="down"
               @keydown.up="up"
               @keydown.enter="hit"
               @keydown.esc="reset"
               @blur="reset"
               @input="update"/>

        <!-- the list -->
        <ul v-show="hasItems">
            <li v-for="(item, $item) in items" :class="activeClass($item)" @mousedown="hit" @mousemove="setActive($item)">
                <span class="name" v-text="item.name+', '+item.COUNTRY"></span>
                <span class="screen-name" v-text="item.name"></span>
            </li>
        </ul>
    </div>
</template>

<script>
    import VueTypeahead from 'vue-typeahead'

    export default {
        extends: VueTypeahead, // vue@1.0.22+
        // mixins: [VueTypeahead], // vue@1.0.21-

        props: ["HotelSearchQuery", "PropertyName"],

        data () {
            return {
                // The source url
                // (required)
                src: base_url+'hotels/locations',

                // The data that would be sent by request
                // (optional)
                data: {},

                // Limit the number of items which is shown at the list
                // (optional)
                limit: 5,

                // The minimum character length needed before triggering
                // (optional)
                minChars: 3,

                // Highlight the first item in the list
                // (optional)
                selectFirst: true,

                // Override the default value (`q`) of query parameter name
                // Use a falsy value for RESTful query
                // (optional)
                queryParamName: 'q'
            }
        },

        methods: {
            // The callback function which is triggered when the user hits on an item
            // (required)
            onHit (item) {
                this.query =  item.name +" - "+ item.COUNTRY;
                this.HotelSearchQuery['Destination'] = item.id;
                this.reset();
            },

            reset() {
                this.items = [];
                this.loading = false;
            },

            // The callback function which is triggered when the response data are received
            // (optional)
            prepareResponseData (data) {
                return data
            }
        }
    }
</script>

<style scoped>
    .Typeahead {
        position: relative;
        width: 100%;
    }
    .Typeahead__input {
        width: 100%;
        font-size: 14px;
        color: #2c3e50;
        line-height: 1.42857143;
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        font-weight: 300;
        padding: 12px;
        border: none;
        border-radius: 4px;
        letter-spacing: 1px;
        box-sizing: border-box;
    }
    .Typeahead__input:focus {
        border-color: #4fc08d;
        outline: 0;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px #4fc08d;
    }
    .fa-times {
        cursor: pointer;
    }
    i {
        float: right;
        position: relative;
        top: 30px;
        right: 29px;
        opacity: 0.4;
    }
    ul {
        position: absolute;
        padding: 0;
        margin-top: 3px;
        min-width: 112%;
        background-color: #fff;
        list-style: none;
        border-radius: 4px;
        box-shadow: 0 0 10px rgba(0,0,0, 0.25);
        z-index: 1000;
        left: -27px;
    }
    li {
        padding: 10px 16px;
        border-bottom: 1px solid #ccc;
        cursor: pointer;
    }
    li:first-child {
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }
    li:last-child {
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        border-bottom: 0;
    }
    li:hover {
        background-color: #393939;
    }
    span {
        display: block;
    }
    .active {
        background-color: #393939 !important;
        color: white;
    }
    .name {
        font-weight: 700;
        font-size: 16px;
    }
    .screen-name {
        font-size: 14px;
        font-style: italic;
    }
</style>