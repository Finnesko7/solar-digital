<template>
    <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0">Author 2</h5>

            <div class="comment-buttons">
                <button class="btn btn-light btn-sm" v-on:click="edit">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="btn badge-danger btn-sm" v-on:click="">
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

            <div class="comment-footer">
                {{created_at}}
            </div>

            <SubComment v-if="comments"
                        v-for="comment in comments" :key="comment.id"
                        v-bind="comment"
            />
        </div>
    </div>
</template>

<script>
    export default {
        name: "SubComment",
        props: {
            id: Number,
            message: String,
            created_at: String,
            comments: {
                type: Array,
                required: false
            }
        },
        data() {
            return {
                editMode: false,
                text: this.message
            }
        },
        methods: {
            edit: function () {
                this.editMode = true
            },
            save: function () {
                console.log("Save data ...")
                this.editMode = false;
            }
        }
    }
</script>

<style scoped>

</style>
