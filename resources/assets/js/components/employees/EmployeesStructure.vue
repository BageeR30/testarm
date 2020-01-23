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
                tree: {
         name: "A cool folder",
        children: [
        {
          name: "A cool sub-folder 1",
          children: [
            { name: "A cool sub-sub-folder 1" },
            { name: "A cool sub-sub-folder 2" }
          ]
        },
        { name: "This one is not that cool" }
      ]
    
  },
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
                    console.log(app.structure);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load structure");
                });           
        },
    }
</script>
