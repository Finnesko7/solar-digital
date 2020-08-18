<template>
    <div>
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">

                <div class="form-group">
                    <textarea class="form-control" rows="2" v-model="text"></textarea>
                </div>
                <button class="btn btn-primary" v-on:click="addComment">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
import {createComment} from "../../actions/comment";

export default {
    name: "LeaveComment",
    props: {
        callbackGetComments: Function
    },
    methods: {
        addComment: async function () {
            let comment = await createComment({
                message: this.text,
                post_id: this.$route.params.id,
                main: 1
            });

            if (comment.id) {
                this.text = '';
                this.callbackGetComments();
            }
        }
    },
    data() {
        return {
            text: ''
        }
    }
}
</script>

<style scoped>

</style>
