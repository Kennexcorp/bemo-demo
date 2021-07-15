<template>
  <div>
    <header>
      <h1>Cards and Column</h1>
    </header>
    <div>
      <column></column>
    </div>
    <!-- <board/> -->
    <div id="export">
      <a href="/api/dump_database" class="btn">Export DB</a>
    </div>
  </div>
</template>

<script>
import Board from "./components/Board.vue";
import Column from "./components/Column.vue";
export default {
  components: {
    Column,
    Board,
  },
  methods: {
    dumpDatabase() {
      axios
        .get("/api/dump_database")
        .then((res) => {
          //   console.log(res.data);
          this.columns = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss">
html {
	margin: 0;
	min-height: 100vh;
	display: flex;
	flex-direction: column;
}
body {
	margin: 0;
	min-height: 100vh;
	display: flex;
	flex-direction: column;
}
#export {
	position: fixed;
	bottom: 95;
	right: 0;
	padding: 10px;
}
header {
	width: 100%;
	background-color: #b57737;
	display: flex;
	justify-content: center;
	align-items: center;
	h1 {
		margin: 0;
		padding: 5px 0;
		font-family: "Pacifico";
		font-size: 35px;
		color: #e8ede2;
	}
}
main {
	display: flex;
	flex-direction: column;
	padding: 25px;
	background-color: #e89847;
	flex: 1;
}
.new-list {
	margin: 10px;
	margin-bottom: 20px;
	form {
		input {
			font-size: 20px;
			padding: 10px;
			border-radius: 3px;
			border: none;
			&:focus {
				outline: none;
			}
		}
	}
}
.all-lists {
	display: flex;
}
.list-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 10px;
}
.list {
	margin: 10px;
	background-color: #e2e4e6;
	border-radius: 3px;
	width: 300px;
	height: 100%;
	box-sizing: border-box;
	h2 {
		margin: 0;
	}
}
ul {
	list-style: none;
	display: flex;
	flex-direction: column;
	padding: 0;
	margin: 0;
	h2 {
		align-self: center;
	}
}
.item {
	display: flex;
	justify-content: space-between;
	padding: 5px;
	padding-bottom: 8px;
	max-width: 300px;
	margin: 5px 10px;
	border-radius: 3px;
	background-color: white;
	border-bottom: 1px solid #d1d1d1;
	box-sizing: border-box;
	position: relative;
	&:hover {
		background-color: #c6c8c9;
	}
	li {
		font-size: 20px;
	}
}
.btn {
	margin: 0 1px;
	background-color: inherit;
	border: none;
	border-radius: 3px;
	padding: 3px 5px;
	font-family: "Slabo 27px";
	font-size: 15px;
	box-sizing: border-box;
	&:hover {
		cursor: pointer;
	}
}
.edit-btn {
	position: absolute;
	top: 3px;
	right: 3px;
	&:hover {
		background-color: #b4b6b8;
	}
	i {
		color: #5a5b5c;
	}
}
.tools {
	padding-top: 10px 0;
	form {
		margin: 5px 10px;
		display: flex;
		input {
			width: 100%;
			font-size: 20px;
			border: none;
			resize: none;
			border-radius: 3px;
			padding: 5px;
			box-sizing: border-box;
			&:focus {
				outline: none;
			}
		}
	}
}
.add-btn {
	font-size: 25px;
	padding: 5px 15px;
	box-sizing: border-box;
	background-color: #56a23f;
	color: white;
	margin-left: 5px;
	&:hover {
		background-color: #4c8f38;
	}
}
.list-btn {
	font-size: 25px;
	padding: 5px 15px;
	box-sizing: border-box;
	background-color: #56a23f;
	color: white;
	font-size: 25px;
	padding: 5px;
	box-sizing: border-box;
	background-color: #7f0fc9;
	color: white;
	&:hover {
		background-color: #4c8f38;
		background-color: #7f0fc9;
	}
}
.del-btn {
	font-size: 25px;
	padding: 5px;
	box-sizing: border-box;
	background-color: #7f0fc9;
	color: white;
	margin: 1px;
	&:hover {
		background-color: #7f0fc9;
	}
}

</style>
