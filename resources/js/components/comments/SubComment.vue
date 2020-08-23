<template>
    <div class="media">
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

            <div class="comment-on"
                 v-if="!leaveComment"
                 v-on:click="()=> this.leaveComment = true"
            >
                <strong>Leave comment</strong>
            </div>

            <LeaveSubComment
                v-if="leaveComment"
                v-bind:cbCloseAddComment="closeAddComment"
                v-bind:cbGetSubComments="getSubComments"
                v-bind:mainId="main_id"
                v-bind:parentId="id"
            />

            <div class="comment-footer">
                {{created_at}}
            </div>

            <SubComment v-if="comments"
                        v-for="comment in comments" :key="comment.id"
                        v-bind="comment"
                        v-bind:getSubComments="getSubComments"
            />
        </div>
    </div>
</template>

<script>
    import LeaveSubComment from "./LeaveSubComment";
    import {updateComment} from "../../actions/comment";
    export default {
        name: "SubComment",
        components: {LeaveSubComment},
        props: {
            id: Number,
            message: String,
            created_at: String,
            main_id: Number,
            comments: {
                type: Array,
                required: false
            },
            getSubComments: Function
        },
        data() {
            return {
                editMode: false,
                text: this.message,
                leaveComment: false
            }
        },
        methods: {
            edit: function () {
                this.editMode = true
            },
            save: async function () {
                let comment = await updateComment(this.id, this.text);
                if (comment) this.editMode = false
            },
            closeAddComment: function () {
                this.leaveComment = false
            },
            remove: function () {
                fetch(`/api/comment/${this.id}`, {
                    method: 'DELETE'
                }).then(response => {
                    if (response.status === 204) this.getSubComments()
                });
            }
        }
    }
</script>

<style scoped>

</style>
