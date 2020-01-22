<template>
  <div class="node-tree">
    <span class="label">{{ node.name }} ({{ node.position.name }})</span>

    <ul v-if="node.children_heads && node.children_heads.length">
      <node v-for="child in node.children_heads" :node="child"></node>
    </ul>
  </div>
</template>

<script>
export default {
  name: "node",
  props: {
    node: Object
  }
};
</script>

<style>
.label {
  padding-left: 16px;
  margin: 6px 0;
  color:black;
  font-size: 100%;
}
</style>