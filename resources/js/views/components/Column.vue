<template>
  <div>
      <div class="new-list">
        <form>
        <h4>Add Column</h4>
          <input type="text" name="title" placeholder="Add a Column" autocomplete="off" wrap="soft" v-model="column.title" >

          <button type="button" @click="addColumn(column)" class="btn list-btn">
            Create
          </button>
        </form>
      </div>

      <div class="all-lists">
        <div class="list" v-for="column in columns" v-bind:key="column.id" :column="column">
          <div class="list-header">
            <h2>{{ column.title }}</h2>
            <button @click="deleteColumn(column)" class="btn del-btn">x</button>
          </div>

          <ul>
            <card :column="column.id"> </card>

          </ul>

        </div>

      </div>
    <div>
      <!-- <form action="">
        <h1>Add Column</h1>
        <input v-model="column.title" type="text" />
        <button type="button" @click="addColumn(column)">Submit</button>
      </form> -->
      <!-- <ul>
        <li v-for="column in columns" v-bind:key="column.id" :column="column">
          <h3>
            {{ column.title }}
            <button @click="deleteColumn(column)">delete</button>
          </h3>
          <card :column="column.id"> </card>
        </li>
      </ul> -->
    </div>
  </div>
</template>

<script>
import Card from "./Card.vue";
export default {
  components: { Card },
  props: {
  },
  data() {
    return {
      columns: [],
      column: {
        title: "",
      },
    };
  },
  mounted() {
    this.fetchColumns();
  },
  methods: {
    fetchColumns() {
      axios
        .get("/api/columns")
        .then((res) => {
        //   console.log(res.data);
          this.columns = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    addColumn(column) {
      axios
        .post("/api/columns", column)
        .then((res) => {
          console.log(res.data);
          column = {
              title: res.data.title,
              id: res.data.id
          }
          this.columns.push(column)
          this.resetForm()
        })
        .catch((err) => {
          console.log(err);
        });
    },

    deleteColumn(column) {
      axios
        .delete(`/api/columns/${column.id}`)
        .then((res) => {
          if (res.data === "ok") {
            console.log(res);
            let index = this.columns.findIndex((item) => item.id === column.id);
            this.columns.splice(index, 1);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    resetForm() {
        this.column.title = ''
    }
  },
};
</script>

<style lang="scss" scoped>
</style>

