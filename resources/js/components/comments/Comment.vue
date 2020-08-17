<template>
    <div class="media mb-4" v-if="!deleted">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0">Author</h5>

            <div class="comment-buttons">
                <button class="btn btn-light btn-sm" v-on:click="edit">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="btn badge-danger btn-sm" v-on:click="remove">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <p v-if="!editMode">{{text}}</p>
            <textarea
                v-if="editMode"
                v-model="text"
                class="form-control"
                rows="1"
                v-on:blur="save"
            ></textarea>

            <SubComment v-for="comment in subComments" :key="comment.id"
                v-if="showSubComments"
                v-bind="comment"
            />

            <div class="comment-footer" v-if="!showSubComments">
                <div>
                    {{created_at}}
                </div>
                <div class="see-all-comments" v-if="count" v-on:click="getSubComments">
                    See all comments ({{count}})
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import SubComment from "./SubComment";
export default {
    name: "Comment",
    components: {SubComment},
    props: {
        id: Number,
        message: String,
        count: Number,
        created_at: String
    },
    data() {
      return {
          deleted: false,
          subComments: [],
          showSubComments: false,
          editMode: false,
          text: this.message
      }
    },
    methods: {
        remove: function () {
            if(this.count > 0) {
                let success = confirm("This comment have a sub comments. All sub comments will be deleted");

                if (!success) return false;
            }

            fetch(`/api/comment/${this.id}`, {
                method: 'DELETE'
            }).then(response => response.json())
            .then(data => {
                if (data.success) this.deleted = true;
            })
        },
        edit: function () {
            this.editMode = true
        },
        save: function () {
            console.log("Save data ...")
            this.editMode = false;
        },
        getSubComments: function () {
            fetch(`/api/comments/sub/${this.id}`).then(response => response.json())
                .then(data => {
                    console.log("data sub comments:", data)
                    this.subComments = data;
                    this.showSubComments = true;
                })
        }
    }
}
</script>

<style scoped>

</style>
