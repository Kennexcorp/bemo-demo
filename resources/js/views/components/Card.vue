<template>
  <div>
    <modal name="my-first-modal" v-if="edit" v-bind:key="_editcard.id">
      <form action="">
        <h6>Edit card {{ _editcard }}</h6>
        <input type="text" v-model="_editcard.title" placeholder="Title" />
        <input
          v-model="_editcard.description"
          type="text"
          placeholder="Description"
        />
        <input type="hidden" v-model="_editcard.column_id" />
        <button
          type="button"
          @click="updateCard(_editcard)"
          class="btn add-btn"
        >
          Update
        </button>
      </form>
    </modal>
    <draggable
      :list="cards"
      :disabled="!enabled"
      class="list-group"
      ghost-class="ghost"
      :move="checkMove"
      @start="dragging = true"
      @end="dragging = false"
    >
      <div
        class="item"
        v-for="card in cards"
        v-bind:key="card.id"
        @click="show(card)"
        tooltip="drag to move"
      >
        <li  title="Click and drag to move">{{ card.title }}</li>

        <div>
          <button @click="deleteCard(card)">+</button>
          <div></div>
        </div>
      </div>
    </draggable>

    <rawDisplayer :value="cards" title="List" />
    <div class="tools">
      <form>
        <input type="text" v-model="card.title" placeholder="Title" />
        <input
          v-model="card.description"
          type="hidden"
          placeholder="Description"
        />
        <input type="hidden" v-model="card.column_id" />
        <button type="button" @click="addCard(card)" class="btn add-btn">
          Submit
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import draggable from "vuedraggable";
import rawDisplayer from "vuedraggable";
export default {
  props: {
    column: Number,
  },
  components: {
    draggable,
    rawDisplayer,
  },
  data() {
    return {
      enabled: true,
      card: {
        title: "",
        description: " ",
        column_id: this.column,
      },
      _editcard: {
        title: "",
        description: " ",
        column_id: this.column,
        id: Number,
      },
      cards: [],
      edit: false,
      dragging: false,
    };
  },
  computed: {
    draggingInfo() {
      //   console.log(this.cards);
    },
  },
  mounted() {
    this.getCards();
  },
  methods: {
    checkMove: function (e) {
      //   window.console.log("Future index: " + e.draggedContext.futureIndex);
      const stateOrdering = this.cards.map(function (card) {
        const data = {
          column: card.column_id,
          cardIndex: card.id,
        };
        return data;
      });

      this.saveColumnState(stateOrdering);
    },
    saveColumnState(state) {
      // columns/saveState
      axios
        .put(`/api/column/saveState`, state)
        .then((res) => {
          console.log(res.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    show(card) {
      this.edit = true;
      this._editcard = card;
      console.log(this._editcard);
      this.$modal.show("my-first-modal");
    },
    hide() {
      this.$modal.hide("my-first-modal");
    },
    getCards() {
      axios
        .get(`/api/columns/${this.column}`)
        .then((res) => {
          const _state = res.data.state;
          const _cards = res.data.cards;
          // restore state
          if (_state) {
            _state.forEach((element) => {
              _cards.forEach((card) => {
                if (element === card.id) {
                  this.cards.push(card);
                }
              });
            });
          } else {
            this.cards = _cards;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    updateCard(card) {
      console.log(card);
      axios
        .put(`/api/cards/${card.id}`, card)
        .then((res) => {
          console.log(res.data);
          card = {
            id: res.data.id,
            title: res.data.title,
            description: res.data.description,
          };
          let index = this.cards.findIndex((item) => item.id === card.id);
          this.cards[index] = card;
          this.hide();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    addCard(card) {
      console.log(card);
      axios
        .post("/api/cards", card)
        .then((res) => {
          console.log(res.data);

          card = {
            id: res.data.id,
            title: res.data.title,
            description: res.data.description,
          };
          this.cards.push(card);
          this.card.title = "";
          //   this.fetchCards();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    deleteCard(card) {
      axios
        .delete(`/api/cards/${card.id}`)
        .then((res) => {
          if (res.data === "ok") {
            console.log(res);
            let index = this.cards.findIndex((item) => item.id === card.id);
            this.cards.splice(index, 1);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style>
</style>
