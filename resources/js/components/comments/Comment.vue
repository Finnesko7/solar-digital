<template>
    <div class="media" v-if="!deleted">
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
            <p v-if="!editMode">{{ text }}</p>
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
                        v-bind:getSubComments="getSubComments"
            />

            <div class="comment-on"
                 v-if="!leaveComment"
                 v-on:click="()=> this.leaveComment = true"
            >
                <strong>Leave comment</strong>
            </div>
                <LeaveSubComment
                    v-if="leaveComment"
                    v-bind:mainId="id"
                    v-bind:cbCloseAddComment="closeAddComment"
                    v-bind:cbGetSubComments="getSubComments"
                    v-bind:parentId="id"
                />

            <div class="comment-footer" v-if="!showSubComments">
                <div>
                    {{ created_at }}
                </div>
                <div class="see-all-comments" v-if="count" v-on:click="getSubComments">
                    See all comments ({{ count }})
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import SubComment from "./SubComment";
import LeaveSubComment from "./LeaveSubComment";

export default {
    name: "Comment",
    components: {LeaveSubComment, SubComment},
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
            text: this.message,
            leaveComment: false
        }
    },
    methods: {
        remove: function () {
            if (this.count > 0) {
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
        },
        closeAddComment: function () {
            this.leaveComment = false
        }
    }
}
</script>

<style scoped>

</style>
