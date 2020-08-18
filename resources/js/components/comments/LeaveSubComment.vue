<template>
    <div>
    <textarea

        v-model="text"
        class="form-control"
        rows="1"
        v-on:blur="addComment"
    ></textarea>
    </div>
</template>

<script>
import {createComment} from "../../actions/comment";

export default {
    name: "LeaveSubComment",
    props: {
        cbCloseAddComment: Function,
        cbGetSubComments: Function,
        mainId: Number,
        parentId: Number
    },
    data () {
        return {
            text: ''
        }
    },
    methods: {
        addComment: async function () {
            this.leaveComment = false;

            if (this.text) {
                let comment = await createComment({
                            message: this.text,
                            main_id: this.mainId,
                            post_id: this.$route.params.id,
                            parent_id: this.parentId
                        });

                if (comment.id) {
                    this.text = '';
                    this.cbGetSubComments();
                }
            }

            this.cbCloseAddComment()
        },
    }
}
</script>

<style scoped>

</style>
