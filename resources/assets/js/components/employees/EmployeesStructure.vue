<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Структура</div>
            <div class="panel-body">
                <div id="app">
                    <div v-for="node in structure">
                    <tree :tree-data="node"></tree>
                    </div>
        </div>
            </div>
        </div>
    </div>
</template>

<script>
import Tree from './Tree.vue';

    export default {
        data: function () {
            return {
                structure: [], 
            }
        },
        components: {
            Tree
        },
        props: {
            treeData: Object
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/structure')
                .then(function (resp) {
                    app.structure = resp.data.heads;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load structure");
                });           
        },
    }
</script>
